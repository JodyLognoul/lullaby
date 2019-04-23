<?php

namespace App\Application\Query\Question\GetById;

class GetQuestionQuery
{
    /** @var string */
    public $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }
}
