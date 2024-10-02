<?php

namespace Mossdi\Stamps\Contracts;

abstract class BaseDto
{
    public final static function instance($data): static
    {
        return is_array($data)
            ? static::instanceFromArray($data)
            : static::instanceFromSoap($data);
    }

    abstract static protected function instanceFromArray($data): static;

    abstract static protected function instanceFromSoap($data): static;

    abstract public function toArray(): array;
}
