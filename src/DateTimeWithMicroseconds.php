<?php
/**
 * Created by PhpStorm.
 * User: bartosz
 */

namespace BartoszBartniczak\Doctrine;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

class DateTimeWithMicroseconds extends Type
{
    public const DATETIMETZ_WITH_MICROSECONDS = 'datetime_microseconds';
    const DATE_FORMAT = 'Y-m-d H:i:s.u';

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getDateTimeTzTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::DATETIMETZ_WITH_MICROSECONDS;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return bool|\DateTime|mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if($value === null){
            return null;
        }

        return \DateTime::createFromFormat(self::DATE_FORMAT, $value);
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return $value;
        }

        if ($value instanceof \DateTimeInterface) {
            return $value->format(self::DATE_FORMAT);
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', 'DateTime']);
    }

}
