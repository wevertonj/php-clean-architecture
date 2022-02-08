<?php

namespace Alura\Arquitetura\Shared\Domain;

use Stringable;

class Email implements Stringable
{
    private string $address;

    public function __construct(string $address)
    {
        if (filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException("Endereço de email inválido");
        }
        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }
}
