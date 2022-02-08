<?php

namespace Alura\Arquitetura\Shared\Domain;

use Alura\Arquitetura\Shared\Domain\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testDeveCriarUmEmailValido()
    {
        $email = new EMail('nome@example.com');
        $this->assertEquals('nome@example.com', $email);
    }

    public function testDeveCriarUmEmailInvalido()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Endereço de email inválido');
        $email = new EMail('nome@example');
        $this->assertEquals('nome@example.com', (string) $email);
    }
}
