<?php


namespace App\Domain\Shared\Exception;


use InvalidArgumentException;

class InvalidUUIDException extends InvalidArgumentException
{
    /**
     * InvalidUUIDException constructor.
     */
    public function __construct()
    {
        parent::__construct("aggregator_root.exception.invalid_uuid", 400);
    }
}