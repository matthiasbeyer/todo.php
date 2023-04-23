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

namespace TodoPHP\Package;

final class Example
{
    private function __construct(private readonly string $value)
    {
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
