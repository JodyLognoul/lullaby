<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:25
 */

namespace App\UI\Rest\Controller\User;

use App\Application\Query\User\GetByEmail\GetByEmailQuery;
use App\UI\Rest\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserQueryController extends Controller
{
    /**
     * @Route("/users/{email}", name="user_get_by_email", methods={"GET"})
     */
    public function getByEmail(Request $request): JsonResponse
    {
        $email = $request->get('email');

        $userView = $this->queryBus->dispatch(new GetByEmailQuery($email));

        return new JsonResponse($userView);
    }
}
