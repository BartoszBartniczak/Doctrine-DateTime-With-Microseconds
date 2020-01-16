<?php
/**
 * Created by PhpStorm.
 * User: bartosz
 */

namespace BartoszBartniczak\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;

class DateTimeWithMicrosecondsTest extends TestCase
{
    /**
     * @var DateTimeWithMicroseconds
     */
    private $dateTimeWithMicroseconds;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dateTimeWithMicroseconds = new DateTimeWithMicroseconds();
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(Type::class, $this->dateTimeWithMicroseconds);
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::getName
     */
    public function testGetName()
    {
        $this->assertSame(DateTimeWithMicroseconds::DATETIMETZ_WITH_MICROSECONDS, $this->dateTimeWithMicroseconds->getName());
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::getSQLDeclaration
     */
    public function testGetSqlDeclaration()
    {
        $fieldDeclaration = ['test' => 'test'];
        $abstractPlatformMock = $this->getMockBuilder(AbstractPlatform::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'getDateTimeTzTypeDeclarationSQL',
            ])
            ->getMockForAbstractClass();
        $abstractPlatformMock->expects($this->once())
            ->method('getDateTimeTzTypeDeclarationSQL')
            ->with($fieldDeclaration)
            ->willReturn('returnedValue');
        /** @var \Doctrine\DBAL\Platforms\AbstractPlatform $abstractPlatformMock */

        $this->assertSame('returnedValue', $this->dateTimeWithMicroseconds->getSQLDeclaration($fieldDeclaration, $abstractPlatformMock));
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::convertToPHPValue
     */
    public function testConvertToPHPValue()
    {
        $platform = $this->getMockForAbstractClass(AbstractPlatform::class);

        $this->assertEquals(\DateTime::createFromFormat('Y-m-d H:i:s.u', '2020-01-15 19:40:17.692299'), $this->dateTimeWithMicroseconds->convertToPHPValue('2020-01-15 19:40:17.692299', $platform));
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::convertToPHPValue
     */
    public function testConvertToPHPValueReturnsNullIfValueIsNull()
    {
        $platform = $this->getMockForAbstractClass(AbstractPlatform::class);

        $this->assertNull($this->dateTimeWithMicroseconds->convertToPHPValue(null, $platform));
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::convertToDatabaseValue
     */
    public function testConvertToDatabaseValue()
    {
        $value = \DateTime::createFromFormat('Y-m-d H:i:s.u', '2020-01-15 19:40:17.692299');

        $platform = $this->getMockForAbstractClass(AbstractPlatform::class);
        $this->assertSame('2020-01-15 19:40:17.692299', $this->dateTimeWithMicroseconds->convertToDatabaseValue($value, $platform));
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::convertToDatabaseValue
     */
    public function testConvertToDatabaseValueReturnsNullIfValueIsNull()
    {
        $platform = $this->getMockForAbstractClass(AbstractPlatform::class);
        $this->assertNull($this->dateTimeWithMicroseconds->convertToDatabaseValue(null, $platform));
    }

    /**
     * @covers \BartoszBartniczak\Doctrine\DateTimeWithMicroseconds::convertToDatabaseValue
     */
    public function testConvertToDatabaseValueThrowsConversionExceptionIfValueIsNotDateTimeObject()
    {
        $this->expectException(ConversionException::class);
        $this->expectExceptionMessage("Could not convert PHP value 'value' of type 'string' to type 'datetime_microseconds'. Expected one of the following types: null, DateTime");

        $platform = $this->getMockForAbstractClass(AbstractPlatform::class);
        $this->dateTimeWithMicroseconds->convertToDatabaseValue('value', $platform);
    }
}
