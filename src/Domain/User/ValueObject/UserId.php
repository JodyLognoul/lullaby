<?php


namespace App\Domain\User\ValueObject;


use App\Domain\Shared\ValueObject\AggregateRootId;

class UserId extends AggregateRootId
{
    public static function fromString(string $id): UserId
    {
        return new self($id);
    }
}
