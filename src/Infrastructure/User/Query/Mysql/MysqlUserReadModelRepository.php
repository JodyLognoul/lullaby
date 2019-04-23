<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 16:16
 */

namespace App\Infrastructure\User\Query\Mysql;

use App\Application\Query\User\Repository\UserReadModelRepositoryInterface;
use App\Application\Query\User\View\UserView;
use App\Domain\Shared\Query\Exception\NotFoundException;
use App\Domain\User\Model\User;
use App\Infrastructure\Share\Bridge\Doctrine\Orm\Paginator;
use App\Infrastructure\Share\Paginator\PaginatorInterface;
use App\Infrastructure\Share\Query\Repository\MysqlRepository;
use Doctrine\ORM\NonUniqueResultException;

class MysqlUserReadModelRepository extends MysqlRepository implements UserReadModelRepositoryInterface
{
    /**
     * @throws NonUniqueResultException
     * @throws NotFoundException
     */
    public function oneByEmail(string $email): UserView
    {
        $userView = $this->em->getRepository(User::class)
            ->createQueryBuilder('User')
            ->select('NEW App\Application\Query\User\View\UserView(User.id, User.email)')
            ->where("User.email = :email")
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $userView) {
            throw new NotFoundException();
        }

        return $userView;
    }

    /**
     * @return UserView[]
     */
    public function all(): array
    {
        return $this->em->getRepository(User::class)
            ->createQueryBuilder('User')
            ->select('NEW App\Application\Query\User\View\UserView(User.uuid, User.email)')
            ->getQuery()
            ->getResult();
    }

    public function collection(int $page, int $limit): PaginatorInterface
    {
        $qb = $this->em->getRepository(User::class)
            ->createQueryBuilder('User')
            ->select('User, NEW App\Application\Query\User\View\UserView(User.uuid, User.email)')
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit)
        ;

        $doctrinePaginator = new \Doctrine\ORM\Tools\Pagination\Paginator($qb, $fetchJoinCollection = false);

        return new Paginator($doctrinePaginator);
    }
}