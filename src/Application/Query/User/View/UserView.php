<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 16:18
 */

namespace App\Application\Query\User\View;


class UserView
{
    /** @var string|null*/
    public $id;

    /** @var string */
    public $email;

    public function __construct(?string $id, ?string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}