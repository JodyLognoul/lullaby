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
use App\Infrastructure\Share\Query\Repository\MysqlRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class MysqlUserReadModelRepository extends MysqlRepository implements UserReadModelRepositoryInterface
{
    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws NotFoundException
     */
    public function oneByEmail(string $email): UserView
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id')
            ->addScalarResult('email', 'email')
        ;

        $query = $this->em->createNativeQuery('SELECT id, email FROM user WHERE email like :email', $rsm);
        $query->setParameter(':email', $email);

        $user = $query->getOneOrNullResult();

        if (null === $user) {
            throw new NotFoundException();
        }

        return new UserView($user['id'], $user['email']);
    }
}