<?php
/**
 * Created by PhpStorm.
 * Question: jody
 * Date: 2019-03-10
 * Time: 16:16
 */

namespace App\Infrastructure\Question\Query\Mysql;

use App\Application\Query\Question\Repository\QuestionReadModelRepositoryInterface;
use App\Application\Query\Question\View\QuestionView;
use App\Domain\Question\Model\Question;
use App\Domain\Question\ValueObject\QuestionId;
use App\Domain\Shared\Query\Exception\NotFoundException;
use App\Infrastructure\Share\Bridge\Doctrine\Orm\Paginator;
use App\Infrastructure\Share\Paginator\PaginatorInterface;
use App\Infrastructure\Share\Query\Repository\MysqlRepository;
use Doctrine\ORM\NonUniqueResultException;

class MysqlQuestionReadModelRepository extends MysqlRepository implements QuestionReadModelRepositoryInterface
{

    /**
     * @return QuestionView[]
     */
    public function all(): array
    {
        return $this->em->getRepository(Question::class)
            ->createQueryBuilder('Question')
            ->select('NEW App\Application\Query\Question\View\QuestionView(Question.name, Question.text)')
            ->getQuery()
            ->getResult();
    }

    /**
     * We use Pagerfanta because it implements JsonSerializable. Doctrine\ORM\Tools\Pagination\Paginator don't!
     */
    public function collection(int $page, int $limit): PaginatorInterface
    {
        $qb = $this->em->getRepository(Question::class)
            ->createQueryBuilder('Question')
            ->select('Question, NEW App\Application\Query\Question\View\QuestionView(Question.uuid, Question.name, Question.text)')
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit)
        ;

        $doctrinePaginator = new \Doctrine\ORM\Tools\Pagination\Paginator($qb, $fetchJoinCollection = false);

        return new Paginator($doctrinePaginator);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NotFoundException
     */
    public function getById(QuestionId $questionId): QuestionView
    {
        $userView = $this->em->getRepository(Question::class)
            ->createQueryBuilder('Question')
            ->select('NEW App\Application\Query\Question\View\QuestionView(Question.uuid, Question.name, Question.text)')
            ->where("Question.uuid = :uuid")
            ->setParameter('uuid', $questionId->bytes())
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $userView) {
            throw new NotFoundException();
        }

        return $userView;
    }
}