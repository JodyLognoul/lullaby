<?php

namespace App\Infrastructure\User\Doctrine\Types;

use App\Domain\User\ValueObject\UserId;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramsey\Uuid\Doctrine\UuidBinaryType;

class UserIdType extends UuidBinaryType
{
    const USER_ID = 'userId';
    
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : UserId::fromBytes($value);
    }

    /**
     * @param UserId $value
     * @return null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return  (null === $value) ? null : $value->bytes();
    }

    public function getName()
    {
        return self::USER_ID;
    }
}
