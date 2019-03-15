<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:44
 */

namespace App\Application\Query\User\Repository;

use App\Application\Query\User\View\UserView;

interface UserReadModelRepositoryInterface
{
    public function oneByEmail(string $email): UserView;
}