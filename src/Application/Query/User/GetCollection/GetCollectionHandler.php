<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-15
 * Time: 16:00
 */

namespace App\Application\Query\User\GetCollection;

use App\Application\Query\User\Repository\UserReadModelRepositoryInterface;


class GetCollectionHandler
{
    public function __invoke(GetCollectionQuery $query)
    {
        return $this->repository->collection($query->page, $query->limit);
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