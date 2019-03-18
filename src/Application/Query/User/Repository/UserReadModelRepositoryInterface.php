<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:44
 */

namespace App\Application\Query\User\Repository;

use App\Application\Query\User\View\UserView;
use App\Infrastructure\Share\Paginator\PaginatorInterface;

interface UserReadModelRepositoryInterface
{
    public function oneByEmail(string $email): UserView;
    public function collection(int $page, int $limit): PaginatorInterface;

    /**
     * @return UserView[]
     */
    public function all(): array;

}