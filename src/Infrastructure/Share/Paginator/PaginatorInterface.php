<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-17
 * Time: 15:11
 */

namespace App\Infrastructure\Share\Paginator;


interface PaginatorInterface extends \Traversable, \Countable, \IteratorAggregate
{
    /**
     * Gets last page.
     */
    public function getLastPage(): float;

    /**
     * Gets the number of items in the whole collection.
     */
    public function getTotalItems(): float;

    /**
     * Gets the current page number.
     */
    public function getCurrentPage(): float;

    /**
     * Gets the number of items by page.
     */
    public function getItemsPerPage(): float;
}