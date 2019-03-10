<?php

namespace App\Application\Command\User\SignUp;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SignUpHandler
{
    public function __invoke(SignUpCommand $command): void
    {
        $user = new User();
        $user
            ->setEmail($command->email)
            ->setPassword($this->passwordEncoder->encodePassword($user, $command->password));

        $this->userRepository->save($user);
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
