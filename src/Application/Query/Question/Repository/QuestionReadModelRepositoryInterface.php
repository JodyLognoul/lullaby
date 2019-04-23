<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 15:44
 */

namespace App\Application\Query\Question\Repository;

use App\Application\Query\Question\View\QuestionView;
use App\Domain\Question\ValueObject\QuestionId;
use App\Infrastructure\Share\Paginator\PaginatorInterface;

interface QuestionReadModelRepositoryInterface
{
    /** @return QuestionView[] */
    public function all(): array;

    public function collection(int $page, int $limit): PaginatorInterface;
    public function getById(QuestionId $questionId): QuestionView;
}