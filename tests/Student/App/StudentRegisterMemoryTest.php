<?php

namespace Alura\Arquitetura\Student\App\StudentRegister;

use Alura\Arquitetura\Shared\Domain\CPF;
use Alura\Arquitetura\Student\App\StudentRegister\StudentRegister;
use Alura\Arquitetura\Student\App\StudentRegister\StudentRegisterDto;
use Alura\Arquitetura\Student\Infra\StudentRepositoryMemory;
use PHPUnit\Framework\TestCase;

class StudentRegisterTest extends TestCase
{
    public function testDeveMatricularAluno()
    {
        $name = 'John Doe';
        $cpf = '123.456.789-01';
        $email = 'test@example.com';

        $student = new StudentRegisterDto($name, $cpf, $email);

        $repository = new StudentRepositoryMemory();
        $service = new StudentRegister($repository);
        $service->register($student);

        $studentSearch = $repository->searchByCpf(new CPF('123.456.789-01'));

        $this->assertEquals($name, (string) $studentSearch->getName());
        $this->assertEquals($email, (string) $studentSearch->getEmail());
        $this->assertEmpty($studentSearch->getPhones());
    }


    public function testDeveMatricularAlunoComTelefone()
    {
        $name = 'John Doe';
        $cpf = '123.456.789-01';
        $email = 'test@example.com';

        $student = new StudentRegisterDto($name, $cpf, $email);
        $student->addPhone('11', '123456789');
        $student->addPhone('22', '987654321');

        $repository = new StudentRepositoryMemory();
        $service = new StudentRegister($repository);
        $service->register($student);

        $studentSearch = $repository->searchByCpf(new CPF('123.456.789-01'));

        $this->assertEquals('11', (string) $studentSearch->getPhones()[0]->getDDD());
        $this->assertEquals('12345-6789', (string) $studentSearch->getPhones()[0]->getNumber());
        $this->assertEquals('22', (string) $studentSearch->getPhones()[1]->getDDD());
        $this->assertEquals('98765-4321', (string) $studentSearch->getPhones()[1]->getNumber());
    }
}
