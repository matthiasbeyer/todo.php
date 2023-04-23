<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017-2023 Matthias Beyer
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/matthiasbeyer/todo.php
 */

use Ergebnis\License;
use Ergebnis\PhpCsFixer;

$license = License\Type\MIT::markdown(
    __DIR__ . '/LICENSE.md',
    License\Range::since(
        License\Year::fromString('2017'),
        new \DateTimeZone('UTC'),
    ),
    License\Holder::fromString('Matthias Beyer'),
    License\Url::fromString('https://github.com/matthiasbeyer/todo.php'),
);

$license->save();

$config = PhpCsFixer\Config\Factory::fromRuleSet(new PhpCsFixer\Config\RuleSet\Php80($license->header()));

$config->getFinder()
    ->exclude([
        '.build/',
        '.github/',
        '.notes/',
    ])
    ->ignoreDotFiles(false)
    ->in(__DIR__)
    ->name('.php-cs-fixer.php');

$config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php-cs-fixer.cache');

return $config;
