<?php

namespace App\Infrastructure\Question\Doctrine\Types;

use App\Domain\Question\ValueObject\QuestionId;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramsey\Uuid\Doctrine\UuidBinaryType;

class QuestionIdType extends UuidBinaryType
{
    const QUESTION_ID = 'questionId';
    
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : QuestionId::fromBytes($value);
    }

    /**
     * @param QuestionId $value
     * @return null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return  (null === $value) ? null : $value->bytes();
    }

    public function getName()
    {
        return self::QUESTION_ID;
    }
}
