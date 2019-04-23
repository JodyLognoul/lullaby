<?php

namespace App\Infrastructure\User\Repository;

use App\Domain\Shared\Exception\InvalidUUIDException;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Model\User;
use App\Domain\User\ValueObject\UserId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use Exception;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Security;
use Webmozart\Assert\Assert;

/**
 * # /!\
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface, UserLoaderInterface
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(RegistryInterface $registry, Security $security)
    {
        parent::__construct($registry, User::class);

        $this->security = $security;
    }

    public function getConnectedUser(): User
    {
        return $this->loadUserByUsername($this->security->getUser()->getUsername());
    }

    /**
     * @throws ORMException
     */
    public function save(User $user): void
    {
        $this->_em->persist($user);
    }

    /**
     * @param User[] $users
     * @throws ORMException
     */
    public function saveBatch(array $users): void
    {
        foreach ($users as $user) {
            Assert::isInstanceOf($user, User::class);
            $this->save($user);
        }
    }

    public function loadUserByUsername($email): ?User
    {
        try {
            $user = $this->createQueryBuilder('u')
                ->where('u.email = :query')
                ->setParameter('query', $email)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw new \LogicException('To many rows returned in UserRepository::loadUserByUsername()');
        }

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @throws ORMException
     */
    public function commit(): void
    {
        $this->_em->flush();
    }

    /**
     * @return UserId
     */
    public function nextIdentity(): UserId
    {
        try {
            return UserId::fromString((string) Uuid::uuid4()->toString());
        } catch (Exception | InvalidArgumentException $e) {
            throw new InvalidUUIDException();
        }
    }
}
