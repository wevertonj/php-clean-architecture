<?php

namespace Alura\Arquitetura\Shared\Domain;

use Alura\Arquitetura\Shared\Domain\CPF;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    public function testDeveCriarUmCPFValido()
    {
        $cpf = new CPF('123.456.789-10');
        $this->assertEquals('123.456.789-10', $cpf);
    }

    public function testDeveCriarUmCPFInvalido()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Número de CPF inválido');
        $cpf = new CPF('sdf.ksj.sjd-10');
        $this->assertEquals('123.456.789-10', (string) $cpf);
    }
}
