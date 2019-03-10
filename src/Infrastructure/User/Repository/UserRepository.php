<?php

namespace App\Infrastructure\User\Repository;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
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
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @throws ORMException
     */
    public function save(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush($user);
    }

    /**
     * @param User[] $users
     * @throws ORMException
     */
    public function saveBatch(array $users): void
    {
        foreach ($users as $user) {
            Assert::isInstanceOf($user, User::class);

            $this->_em->persist($user);
            $this->_em->flush($user);
        }
    }

    /**
     * @param string $email
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByUsername($email): ?User
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :query')
            ->setParameter('query', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }
}
