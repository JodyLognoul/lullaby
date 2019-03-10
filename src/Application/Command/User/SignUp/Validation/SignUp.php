<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-09
 * Time: 15:44
 */

namespace App\Application\Command\User\SignUp\Validation;

use Symfony\Component\Validator\Constraint;

/**
 * # /!\
 *
 * @Annotation
 *
 * "The @Annotation annotation is necessary for this new constraint in order to make it available for use in classes
 * via annotations. Options for your constraint are represented as public properties on the constraint class."
 */
class SignUp extends Constraint
{
    public $message = "A user with this email address already exists.";

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}