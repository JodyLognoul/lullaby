<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:25
 */

namespace App\UI\Rest\Controller\User;

use App\Application\Query\User\GetAll\GetAllQuery;
use App\Application\Query\User\GetByEmail\GetByEmailQuery;
use App\Application\Query\User\GetCollection\GetCollectionQuery;
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

    /**
     * @Route("/users", name="user_get_all", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $userView = $this->queryBus->dispatch(new GetAllQuery());

        return new JsonResponse($userView);
    }

    /**
     * @Route("/users/collection", name="user_cget", methods={"POST"})
     */
    public function cget(Request $request): JsonResponse
    {
        $getCollectionQuery = $this->deserialize($request->getContent(), GetCollectionQuery::class);

        $collection = $this->queryBus->dispatch($getCollectionQuery);

        return new JsonResponse($this->serialize($collection), 200, [], true);
    }
}
