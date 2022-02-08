<?php

namespace Alura\Arquitetura\Student\Domain;

use Alura\Arquitetura\Shared\Domain\CPF;
use Alura\Arquitetura\Shared\Domain\Email;

class Student
{
    private string $name;
    private CPF $cpf;
    private Email $email;
    private array $phones = [];
    private $password;

    public static function register(string $name, string $cpf, string $email): self
    {
        return new Student($name, new CPF($cpf), new Email($email));
    }

    public function __construct(string $name, CPF $cpf, Email $email)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
    }

    public function addPhone(string $ddd, string $number): self
    {
        $this->phones[] = new Phone($ddd, $number);
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhones(): array
    {
        return $this->phones;
    }
}
