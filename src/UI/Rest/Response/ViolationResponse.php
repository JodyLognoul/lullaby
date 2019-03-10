<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-09
 * Time: 16:25
 */

namespace App\UI\Rest\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ViolationResponse extends JsonResponse
{
    public function __construct(ConstraintViolationListInterface $violationList, $status = 200)
    {
        $errors = [];

        foreach ($violationList as $violation) {
            $errors[] = ['message' => $violation->getMessage()];
        }

        parent::__construct($errors, $status);
    }
}