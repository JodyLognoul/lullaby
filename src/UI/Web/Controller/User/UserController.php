<?php

namespace App\UI\Web\Controller\User;

use App\Application\Query\User\GetCollection\GetCollectionQuery;
use App\Infrastructure\Share\Bridge\Doctrine\Orm\Paginator;
use App\UI\Web\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/users", name="web_users_cget")
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        /** @var Paginator $collection */
        $collection = $this->queryBus->dispatch(new GetCollectionQuery($page, $limit));

        return $this->render('user/index.html.twig', ['collection' => $collection]);
    }
}
