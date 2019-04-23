<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-24
 * Time: 16:28
 */

namespace App\Application\Command\Question\AskQuestion;

use App\Domain\Question\ValueObject\QuestionId;

class AskQuestionCommand
{
    /** @var string */
    public $text;

    /** @var string */
    public $name;

    /** @var QuestionId */
    public $id;

    /**
     * AskQuestionCommand constructor.
     * @param string $text
     * @param string $name
     */
    public function __construct(QuestionId $id = null, string $text = '', string $name = '')
    {
        $this->text = $text;
        $this->name = $name;
        $this->id = $id;
    }
}
