<?php

namespace Alura\Arquitetura\Student\App\StudentRegister;

class StudentRegisterDto
{
    public string $name;
    public string $cpf;
    public string $email;
    public array $phones = [];

    public function __construct(string $name, string $cpf, string $email)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
    }

    public function addPhone(string $ddd, string $number): self
    {
        $this->phones[] = array(
            'ddd' => $ddd,
            'number' => $number
        );
        return $this;
    }
}
