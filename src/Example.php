<?php

declare(strict_types=1);

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
