<?php

namespace Alura\Arquitetura\Student\Domain;

use Stringable;

class Phone implements Stringable
{
    private string $ddd;
    private string $number;

    public function __construct(string $ddd, string $number)
    {
        $this->setPhone($ddd, $number);
    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->number}";
    }

    public function getDDD(): string
    {
        return $this->ddd;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    private function setPhone(string $ddd, string $number): void
    {
        $ddd = str_replace('(', '', $ddd);
        $ddd = str_replace(')', '', $ddd);
        $number = str_replace('-', '', $number);

        if (filter_var($ddd, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\d{2}$/']]) === false) {
            throw new \InvalidArgumentException('DDD inválido');
        }

        if (filter_var($number, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\d{4,5}\d{4}$/']]) === false) {
            throw new \InvalidArgumentException('Número de telefone inválido');
        }

        $this->ddd = $ddd;

        if (strlen($number) == 9) {
            $this->number = substr($number, 0, 5) . "-" . substr($number, 5);
        } else {
            $this->number = substr($number, 0, 4) . "-" . substr($number, 4);
        }
    }
}
