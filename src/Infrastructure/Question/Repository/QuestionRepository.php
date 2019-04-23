<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-26
 * Time: 18:43
 */

namespace App\Infrastructure\Question\Repository;


use App\Domain\Question\Model\Question;
use App\Domain\Question\Repository\QuestionRepositoryInterface;
use App\Domain\Question\ValueObject\QuestionId;
use App\Domain\Shared\Exception\InvalidUUIDException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * # /!\
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository implements QuestionRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Question::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(Question $question): void
    {
        $this->_em->persist($question);
        $this->_em->flush($question);
    }

    /**
     * @return QuestionId
     */
    public function nextIdentity(): QuestionId
    {
        try {
            return QuestionId::fromString((string) Uuid::uuid4()->toString());
        } catch (Exception | InvalidArgumentException $e) {
            throw new InvalidUUIDException();
        }
    }
}