<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-26
 * Time: 18:42
 */

namespace App\Domain\Question\Repository;

use App\Domain\Question\Model\Question;
use App\Domain\Question\ValueObject\QuestionId;

interface QuestionRepositoryInterface
{
    public function save(Question $question): void;
    public function nextIdentity(): QuestionId;
}