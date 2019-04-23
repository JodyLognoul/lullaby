<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:36
 */

namespace App\Application\Query\User\GetAll;

use App\Application\Query\Question\Repository\QuestionReadModelRepositoryInterface;

class GetAllHandler
{
    public function __invoke(GetAllQuery $query)
    {
        return $this->repository->all();
    }

    /**
     * @var QuestionReadModelRepositoryInterface
     */
    private $repository;

    public function __construct(QuestionReadModelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}