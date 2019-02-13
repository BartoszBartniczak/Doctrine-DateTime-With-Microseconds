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
    const DATETIMETZ_WITH_MICROSECONDS = 'datetime_microseconds';

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

        return \DateTime::createFromFormat($this->format(), $value);
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
            return $value->format($this->format());
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', 'DateTime']);
    }

    /**
     * @return string
     */
    protected function format():string{
        return 'd-m-Y H:i:s.u';
    }
}