<?php
/**
 * Created by PhpStorm.
 * User: bartosz
 */

namespace BartoszBartniczak\Doctrine\Tests;

use BartoszBartniczak\Doctrine\Tests\Entity\TestDatetime;

class DateTimeWithMicrosecondsFunctionalTest extends FunctionalTest
{
    /**
     * @var int
     */
    private static $id;

    public function testWrite()
    {
        $object = new TestDatetime(\DateTime::createFromFormat('d-m-Y H:i:s.u', '20-01-2020 20:33:46.123789'));

        self::$entityManager->persist($object);
        self::$entityManager->flush();

        self::$id = $object->getId();

        $values = self::$entityManager->getConnection()->query('SELECT id, row_date FROM test_datetime WHERE id = ' . self::$id)->fetchAll();
        $row = $values[0];

        $this->assertSame('2020-01-20 20:33:46.123789', $row['row_date']);
    }

    public function testRead()
    {
        $testDateTime = self::$entityManager->getRepository(TestDatetime::class)->find(self::$id);
        /** @var TestDatetime $testDateTime */
        $this->assertInstanceOf(\DateTime::class, $testDateTime->getRowDate());
        $this->assertSame('2020-01-20 20:33:46.123789', $testDateTime->getRowDate()->format('Y-m-d H:i:s.u'));
    }
}
