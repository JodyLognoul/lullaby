<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-06
 * Time: 21:49
 */

namespace App\UI\Rest\Controller\User;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Webmozart\Assert\Assert;

class SignUpController
{
    /**
     * @Route("/users", name="user_create")
     */
    public function __invoke(Request $request)
    {
        $email = $request->get('email');
        $plainPassword = $request->get('password');

        Assert::notNull($email, "Email can\'t be null");
        Assert::notNull($plainPassword, "Password can\'t be null");

//        $commandRequest = new SignUpCommand($uuid, $email, $plainPassword);

//        $this->exec($commandRequest);
    }
}