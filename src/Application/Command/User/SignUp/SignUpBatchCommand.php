<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 11:15
 */

namespace App\Application\Command\User\SignUp;

use Webmozart\Assert\Assert;

class SignUpBatchCommand
{
    /** @var SignUpCommand[] */
    public $signUpCommands = [];

    /**
     * @param array $signUpCommands
     */
    public function __construct(array $signUpCommands)
    {
        Assert::allIsInstanceOf($signUpCommands, SignUpCommand::class);

        $this->signUpCommands = $signUpCommands;
    }
}
