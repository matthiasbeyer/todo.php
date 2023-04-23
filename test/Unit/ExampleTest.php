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

namespace TodoPHP\Package\Test\Unit;

use PHPUnit\Framework;
use TodoPHP\Package\Example;
use TodoPHP\Package\Test;

/**
 * @internal
 *
 * @covers \TodoPHP\Package\Example
 */
final class ExampleTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testFromStringReturnsExample(): void
    {
        $value = self::faker()->sentence();

        $example = Example::fromString($value);

        self::assertSame($value, $example->toString());
    }
}
