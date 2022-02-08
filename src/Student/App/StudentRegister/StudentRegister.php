<?php

namespace Alura\Arquitetura\Student\App\StudentRegister;

use Alura\Arquitetura\Student\Domain\Student;
use Alura\Arquitetura\Student\Domain\StudentNotFound;
use Alura\Arquitetura\Student\Domain\StudentRepository;

class StudentRegister
{
    private StudentRepository $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(StudentRegisterDto $studentRegisterDto): void
    {
        $student = Student::register(
            $studentRegisterDto->name,
            $studentRegisterDto->cpf,
            $studentRegisterDto->email
        );

        if (isset($studentRegisterDto->phones)) {
            foreach ($studentRegisterDto->phones as $phone) {
                $student->addPhone($phone['ddd'], $phone['number']);
            }
        }

        $this->repository->add($student);
    }
}
