<?php

namespace App\Application\Query\Question\View;

class QuestionView
{
    /** @var string|null*/
    public $name;

    /** @var string|null*/
    public $text;

    /** @var string|null*/
    public $id;

    public function __construct(?string $id, ?string $name, ?string $text)
    {
        $this->id = $id;
        $this->name = $name;
        $this->text = $text;
    }
}
