<?php

namespace Alura\Arquitetura\Student\Domain;

use Alura\Arquitetura\Student\Domain\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testDeveCriarUmTelefoneValido()
    {
        $phone = new Phone('11', '123456789');
        $this->assertEquals('(11) 12345-6789', $phone);
    }

    public function testDeveCriarUmTelefoneInvalido()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Número de telefone inválido');
        $phone = new Phone('11', '12345678900');
        $this->assertEquals('(11) 12345-6789', (string) $phone);
    }

    public function testDeveCriarUmTelefoneInvalidoComDDDInvalido()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('DDD inválido');
        $phone = new Phone('111', '123456789');
        $this->assertEquals('(11) 12345-6789', (string) $phone);
    }
}
