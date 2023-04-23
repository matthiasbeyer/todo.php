<?php

declare(strict_types=1);

namespace TodoPHP\Package\Test\Unit;

use TodoPHP\Package\Example;
use TodoPHP\Package\Test;
use PHPUnit\Framework;

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
