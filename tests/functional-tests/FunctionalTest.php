<?php
/**
 * Created by PhpStorm.
 * User: bartosz
 */

namespace BartoszBartniczak\Doctrine\Tests;

use Doctrine\ORM\EntityManager;
use PHPStan\Testing\TestCase;

abstract class FunctionalTest extends TestCase
{
    /**
     * @var EntityManager
     */
    protected static $entityManager;

    protected function setUp(): void
    {
        if (! self::$entityManager instanceof EntityManager) {
            self::$entityManager = include __DIR__ . '/../entity_manager.php';
        }
        parent::setUp();
    }
}
