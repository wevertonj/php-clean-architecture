<?php

namespace Alura\Arquitetura\Shared\Domain;

use Stringable;

class CPF implements Stringable
{
    private string $number;

    public function __construct(string $number)
    {
        $this->setNumber($number);
    }

    public function __toString(): string
    {
        return $this->number;
    }

    private function setNumber($number): void
    {
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $number)) {
            throw new \InvalidArgumentException('Número de CPF inválido');
        }

        $this->number = $number;
    }
}
