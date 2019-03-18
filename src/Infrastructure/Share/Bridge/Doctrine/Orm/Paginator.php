<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-17
 * Time: 15:17
 */

namespace App\Infrastructure\Share\Bridge\Doctrine\Orm;

use App\Infrastructure\Share\Paginator\PaginatorInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use InvalidArgumentException;

final class Paginator implements PaginatorInterface
{
    /**
     * @var int
     */
    private $totalItems;

    protected $paginator;
    protected $iterator;
    protected $firstResult;
    protected $maxResults;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(DoctrinePaginator $paginator)
    {
        $query = $paginator->getQuery();

        if (null === ($firstResult = $query->getFirstResult()) || null === $maxResults = $query->getMaxResults()) {
            throw new InvalidArgumentException(sprintf('"%1$s::setFirstResult()" or/and "%1$s::setMaxResults()" was/were not applied to the query.', Query::class));
        }

        $this->paginator = $paginator;
        $this->firstResult = $firstResult;
        $this->maxResults = $maxResults;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentPage(): float
    {
        if (0 >= $this->maxResults) {
            return 1.;
        }

        return floor($this->firstResult / $this->maxResults) + 1.;
    }

    /**
     * {@inheritdoc}
     */
    public function getItemsPerPage(): float
    {
        return (float) $this->maxResults;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \Traversable
    {
        return $this->iterator ?? $this->iterator = $this->paginator->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return iterator_count($this->getIterator());
    }

    /**
     * {@inheritdoc}
     */
    public function getLastPage(): float
    {
        if (0 >= $this->maxResults) {
            return 1.;
        }

        return ceil($this->getTotalItems() / $this->maxResults) ?: 1.;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalItems(): float
    {
        return (float) ($this->totalItems ?? $this->totalItems = \count($this->paginator));
    }
}