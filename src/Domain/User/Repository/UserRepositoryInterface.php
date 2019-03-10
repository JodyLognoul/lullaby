<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-08
 * Time: 14:14
 */

namespace App\Domain\User\Repository;

use App\Domain\User\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function saveBatch(array $users): void;
    public function findByEmail(string $email): ?User;
}