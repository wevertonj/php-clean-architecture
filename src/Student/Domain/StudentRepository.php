<?php

namespace Alura\Arquitetura\Student\Domain;

use Alura\Arquitetura\Shared\Domain\CPF;
use Alura\Arquitetura\Student\Domain\Student;

interface StudentRepository
{

    public function add(Student $student): void;

    public function update(Student $student): void;

    public function searchByCpf(CPF $cpf): ?Student;

    /** return Student[] */
    public function findAll(): array;
}
