<?php

namespace App\Application\Command\Question\AskQuestion;

use App\Domain\Question\Model\Question;
use App\Domain\Question\Repository\QuestionRepositoryInterface;
use App\Domain\Question\ValueObject\QuestionId;
use App\Domain\User\Repository\UserRepositoryInterface;
use Exception;
use Ramsey\Uuid\Uuid;

class AskQuestionHandler
{
    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @throws Exception
     */
    public function __invoke(AskQuestionCommand $command)
    {
        $question = new Question($command->id, $this->userRepository->getConnectedUser(), $command->name, $command->text);

        $this->questionRepository->save($question);
    }

    /**
     * AskQuestionHandler constructor.
     */
    public function __construct(QuestionRepositoryInterface $questionRepository, UserRepositoryInterface $userRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->userRepository = $userRepository;
    }
}
