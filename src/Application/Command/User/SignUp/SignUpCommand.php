<?php

namespace App\Application\Command\User\SignUp;

use App\Application\Validation\User\SignUp as Assert;

/**
 * @Assert\SignUp
 */
class SignUpCommand
{
    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /**
     * SignUpCommand constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
