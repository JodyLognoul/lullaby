<?php

namespace App\Domain\Shared\ValueObject;


class AggregateRoot
{
    /**
     * @var AggregateRootId
     */
    protected $uuid;

    protected function __construct(AggregateRootId $aggregateRootId)
    {
        $this->uuid = $aggregateRootId;
    }

    public function uuid(): AggregateRootId
    {
        return $this->uuid;
    }

    final public function equals(AggregateRootId $aggregateRootId)
    {
        return $this->uuid->equals($aggregateRootId);
    }

    public function __toString(): string
    {
        return (string) $this->uuid;
    }
}