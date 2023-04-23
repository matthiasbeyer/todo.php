<?php

declare(strict_types=1);

use Rector\Config;
use Rector\Core;
use Rector\PHPUnit;

return static function (Config\RectorConfig $rectorConfig): void {
    $rectorConfig->cacheDirectory(__DIR__ . '/.build/rector/');

    $rectorConfig->import(__DIR__ . '/vendor/fakerphp/faker/rector-migrate.php');

    $rectorConfig->paths([
        __DIR__ . '/src/',
        __DIR__ . '/test/',
    ]);

    $rectorConfig->phpVersion(Core\ValueObject\PhpVersion::PHP_81);

    $rectorConfig->sets([
        PHPUnit\Set\PHPUnitSetList::PHPUNIT_90,
    ]);
};
