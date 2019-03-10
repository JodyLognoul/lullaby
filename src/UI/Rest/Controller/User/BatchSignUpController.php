<?php

namespace App\UI\Rest\Controller\User;

use App\Application\Command\User\SignUp\SignUpBatchCommand;
use App\Application\Command\User\SignUp\SignUpCommand;
use App\UI\Rest\Controller\Controller;
use App\UI\Rest\Response\ViolationResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Routing\Annotation\Route;

class BatchSignUpController extends Controller
{
    /**
     * @Route("/users/batch", name="user_create_batch", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var SignUpCommand[] $signUpCommands */
        $signUpCommands = $this->deserialize($request->getContent(), SignUpCommand::class . "[]");

        try {
            $this->commandBus->dispatch(new SignUpBatchCommand($signUpCommands));
        } catch (ValidationFailedException $e) {
            return new ViolationResponse($e->getViolations(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($signUpCommands);
    }
}