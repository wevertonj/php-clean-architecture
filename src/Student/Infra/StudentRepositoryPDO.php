<?php

namespace Student\Infra;

use Alura\Arquitetura\Shared\Domain\CPF;
use Alura\Arquitetura\Shared\Domain\Email;
use Alura\Arquitetura\Student\Domain\Student;
use Alura\Arquitetura\Student\Domain\StudentNotFound;
use Alura\Arquitetura\Student\Domain\StudentRepository;

class StudentRepositoryPDO implements StudentRepository
{

    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Student $student): void
    {
        $sql = 'INSERT INTO alunos VALUES (:cpf, :nome, :email);';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':cpf', $student->getCpf());
        $stmt->bindValue(':nome', $student->getName());
        $stmt->bindValue(':email', $student->getEmail());
        $stmt->execute();

        $sql = 'INSERT INTO telefones (ddd, numero, cpf_aluno) VALUES (:ddd, :numero, :cpf_aluno);';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':cpf_aluno', $student->getCpf());

        foreach ($student->getPhones() as $phone) {
            $stmt->bindValue(':ddd', $phone->getDDD());
            $stmt->bindValue(':numero', $phone->getNumber());
            $stmt->execute();
        }
    }

    public function update(Student $student): void
    {
        $sql = 'UPDATE alunos SET nome = :nome, email = :email WHERE cpf = :cpf;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':cpf', $student->getCpf());
        $stmt->bindValue(':nome', $student->getName());
        $stmt->bindValue(':email', $student->getEmail());
        $stmt->execute();

        $sql = 'DELETE FROM telefones WHERE cpf_aluno = :cpf_aluno;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':cpf_aluno', $student->getCpf());
        $stmt->execute();

        $sql = 'INSERT INTO telefones (ddd, numero, cpf_aluno) VALUES (:ddd, :numero, :cpf_aluno);';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':cpf_aluno', $student->getCpf());

        foreach ($student->getPhones() as $phone) {
            $stmt->bindValue(':ddd', $phone->getDDD());
            $stmt->bindValue(':numero', $phone->getNumber());
            $stmt->execute();
        }
    }

    public function searchByCpf(CPF $cpf): Student
    {
        $sql = 'SELECT * FROM alunos WHERE cpf = :cpf;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();

        $student = $stmt->fetchObject(Student::class);

        if ($student === false) {
            throw new StudentNotFound($cpf);
        }

        $sql = 'SELECT * FROM telefones WHERE cpf_aluno = :cpf;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':cpf', (string) $cpf);
        $stmt->execute();

        $phones = $stmt->fetchAll(\PDO::FETCH_OBJ);

        foreach ($phones as $phone) {
            $student->addPhone($phone->ddd, $phone->numero);
        }

        return $student;
    }

    /** return Student[] */
    public function findAll(): array
    {
        $sql = 'SELECT * FROM alunos;';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $students = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $students = array_map(function ($student) {
            $student = new Student($student->nome, new CPF($student->cpf), new Email($student->email));

            $sql = 'SELECT * FROM telefones WHERE cpf_aluno = :cpf;';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':cpf', $student->getCpf());
            $stmt->execute();

            $phones = $stmt->fetchAll(\PDO::FETCH_OBJ);

            foreach ($phones as $phone) {
                $student->addPhone($phone->ddd, $phone->numero);
            }

            return $student;
        }, $students);

        return $students;
    }
}
