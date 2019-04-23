<?php

namespace App\Application\Command\User\SignUp;

use App\Application\Command\User\SignUp\Validation as Assert;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * /!\
 * @Assert\SignUp
 */
class SignUpCommand
{
    /** @var UuidInterface */
    public $id;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /**
     * SignUpCommand constructor.
     * @throws Exception
     */
    public function __construct(string $email, string $password)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->email = $email;
        $this->password = $password;
    }
}
