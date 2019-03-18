<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-15
 * Time: 15:58
 */

namespace App\Application\Query\User\GetCollection;


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