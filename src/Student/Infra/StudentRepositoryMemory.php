<?php

namespace Alura\Arquitetura\Student\Infra;

use Alura\Arquitetura\Shared\Domain\CPF;
use Alura\Arquitetura\Student\Domain\Student;
use Alura\Arquitetura\Student\Domain\StudentNotFound;
use Alura\Arquitetura\Student\Domain\StudentRepository;

class StudentRepositoryMemory implements StudentRepository
{
    private array $students = [];

    public function add(Student $student): void
    {

        $this->students[] = $student;
    }

    public function update(Student $student): void
    {
        foreach ($this->students as $key => $studentInMemory) {
            if ($studentInMemory->getCpf()->equals($student->getCpf())) {
                $this->students[$key] = $student;
                return;
            }
        }

        throw new StudentNotFound('Student not found');
    }

    public function searchByCpf(CPF $cpf): Student
    {
        $studentsFiltereds = array_filter($this->students, fn (Student $student) => $student->getCpf() == $cpf);

        if (count($studentsFiltereds) === 0) {
            throw new StudentNotFound('Nenhum aluno encontrado');
        }

        if (count($studentsFiltereds) > 1) {
            throw new \DomainException('Mais de um aluno encontrado com o mesmo CPF');
        }

        return $studentsFiltereds[0];
    }

    /**
     * @return Student[]
     */
    public function findAll(): array
    {
        return $this->students;
    }
}
