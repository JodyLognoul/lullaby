<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:25
 */

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

class UserCommandController extends Controller
{
    /**
     * @Route("/users", name="user_create", methods={"POST"})
     */
    public function signUp(Request $request): JsonResponse
    {
        $signUpCommand = $this->deserialize($request->getContent(), SignUpCommand::class);

        //$this->userRepository->nextIdentity() todo!

        try {
            $this->commandBus->dispatch($signUpCommand);
        } catch (ValidationFailedException $e) {
            //todo ConstraintViolationListNormalizer! RFC7807 https://tools.ietf.org/html/rfc7807} le front pet le comprendre !!!
            return new ViolationResponse($e->getViolations(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($signUpCommand);
    }

    /**
     * @Route("/users/batch", name="user_create_batch", methods={"POST"})
     */
    public function signUpBatch(Request $request): JsonResponse
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