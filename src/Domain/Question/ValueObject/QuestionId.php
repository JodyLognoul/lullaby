<?php


namespace App\Domain\Question\ValueObject;


use App\Domain\Shared\ValueObject\AggregateRootId;

class QuestionId extends AggregateRootId
{
    public static function fromString(string $id): QuestionId
    {
        return new self($id);
    }
}
