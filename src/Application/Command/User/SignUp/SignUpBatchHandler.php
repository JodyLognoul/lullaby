<?php

namespace App\Application\Command\User\SignUp;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SignUpBatchHandler
{
    public function __invoke(SignUpBatchCommand $command): void
    {
        $users = [];

        foreach ($command->signUpCommands as $signUpCommand) {
            $user = new User();
            $user
                ->setEmail($signUpCommand->email)
                ->setPassword($this->passwordEncoder->encodePassword($user, $signUpCommand->password));
            $users[] = $user;
        }

        $this->userRepository->saveBatch($users);
    }

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }
}
