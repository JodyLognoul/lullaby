<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:36
 */

namespace App\Application\Query\User\GetByEmail;


use App\Application\Query\User\Repository\UserReadModelRepositoryInterface;

class GetByEmailHandler
{
    public function __invoke(GetByEmailQuery $query)
    {
        return $this->repository->oneByEmail($query->email);
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