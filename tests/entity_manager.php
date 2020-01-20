<?php

require_once 'vendor/autoload.php';

use BartoszBartniczak\Doctrine\DateTimeWithMicroseconds;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$paths = [__DIR__ . '/Entity'];
$isDevMode = true;

$dbParams = [
    'driver' => $_SERVER['DATABASE_DRIVER'],
    'host' => $_SERVER['DATABASE_HOST'],
    'user' => $_SERVER['DATABASE_USER'],
    'password' => $_SERVER['DATABASE_PASSWORD'],
    'dbname' => $_SERVER['DATABASE_NAME'],
    'port' => $_SERVER['DATABASE_PORT'],
];

$config = Setup::createConfiguration($isDevMode);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);
\Doctrine\DBAL\Types\Type::addType(DateTimeWithMicroseconds::DATETIME_WITH_MICROSECONDS, DateTimeWithMicroseconds::class);

return $entityManager;
