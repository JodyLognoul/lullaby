<?php

namespace App\Domain\Shared\ValueObject;

use Exception;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

/**
 * Class AggregateRootId
 * @package App\Domain\Shared\ValueObject
 * https://matthiasnoback.nl/2018/05/when-and-where-to-determine-the-id-of-an-entity/
 */
abstract class AggregateRootId
{
    /**
     * @var string
     */
    protected $uuid;

    protected function __construct(string $id)
    {
        Assert::uuid($id);

        $this->uuid = $id;
    }

    public function equals(AggregateRootId $aggregateRootId): bool
    {
        return $this->uuid === $aggregateRootId->__toString();
    }

    public function bytes(): string
    {
        return Uuid::fromString($this->uuid)->getBytes();
    }


    public static function fromBytes(string $bytes): self
    {
        return new static(Uuid::fromBytes($bytes)->toString());
    }

    public static function toBytes(string $uid): string
    {
        return (new static($uid))->bytes();
    }

    public function __toString(): string
    {
        return (string) $this->uuid;
    }
}