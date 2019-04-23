<?php
/**
 * Created by PhpStorm.
 * Question: jody
 * Date: 2019-03-15
 * Time: 16:00
 */

namespace App\Application\Query\Question\GetCollection;

use App\Application\Query\Question\Repository\QuestionReadModelRepositoryInterface;


class GetCollectionHandler
{
    public function __invoke(GetCollectionQuery $query)
    {
        return $this->repository->collection($query->page, $query->limit);
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