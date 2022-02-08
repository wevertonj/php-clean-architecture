<?php

namespace Alura\Arquitetura\Student\Domain;

class StudentNotFound extends \DomainException
{
    public function __construct(string $cpf)
    {
        parent::__construct("Aluno não encontrado com o CPF: $cpf");
    }
}
