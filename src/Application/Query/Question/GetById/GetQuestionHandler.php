<?php
/**
 * Created by PhpStorm.
 * Question: jody
 * Date: 2019-03-15
 * Time: 16:00
 */

namespace App\Application\Query\Question\GetById;

use App\Application\Query\Question\Repository\QuestionReadModelRepositoryInterface;
use App\Domain\Question\ValueObject\QuestionId;

class GetQuestionHandler
{
    public function __invoke(GetQuestionQuery $query)
    {
        return $this->repository->getById(QuestionId::fromString($query->uuid));
    }

    /**
     * @var QuestionReadModelRepositoryInterface
     */
    private $repository;

    /**
     * GetByEmailHandler constructor.
     */
    public function __construct(QuestionReadModelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
