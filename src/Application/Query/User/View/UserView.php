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
    /** @var integer */
    public $id;

    /** @var string */
    public $email;

    /**
     * UserView constructor.
     * @param int $id
     * @param string $email
     */
    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}