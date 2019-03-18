<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:36
 */

namespace App\Application\Query\User\GetAll;

use App\Application\Query\User\Repository\UserReadModelRepositoryInterface;

class GetAllHandler
{
    public function __invoke(GetAllQuery $query)
    {
        return $this->repository->all();
    }

    /**
     * @var UserReadModelRepositoryInterface
     */
    private $repository;

    /**
     * GetByEmailHandler constructor.
     */
    public function __construct(UserReadModelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}