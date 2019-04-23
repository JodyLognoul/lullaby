<?php

namespace App\Application\Command\User\SignUp;

use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SignUpHandler
{
    public function __invoke(SignUpCommand $command): void
    {
        $user = new User($this->userRepository->nextIdentity(), $command->email);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $command->password));

        $this->userRepository->save($user);
        $this->userRepository->commit();
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
