<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-09
 * Time: 15:44
 */

namespace App\Application\Validation\User\SignUp;


use App\Application\Validation\User\SignUp\SignUp as SignUpConstraint;
use App\Application\Command\User\SignUp\SignUpCommand;
use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SignUpValidator extends ConstraintValidator
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param SignUpCommand $value The value that should be validated
     * @param SignUpConstraint|Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->userRepository->findByEmail($value->email)) {
            $this->context->buildViolation($constraint->message)
                ->atPath('foo')
                ->addViolation();
        }
    }
}