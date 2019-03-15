<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:35
 */

namespace App\Application\Query\User\GetByEmail;


class GetByEmailQuery
{
    /** @var string */
    public $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}