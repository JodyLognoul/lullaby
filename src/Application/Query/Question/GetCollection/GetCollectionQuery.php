<?php

namespace App\Application\Query\Question\GetCollection;

class GetCollectionQuery
{
    /** @var integer */
    public $page;

    /** @var integer */
    public $limit;

    public function __construct(int $page, int $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }
}