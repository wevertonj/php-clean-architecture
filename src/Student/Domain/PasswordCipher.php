<?php

namespace Alura\Arquitetura\Student\Domain;

interface PasswordCipher
{
    public function encrypt(string $password): string;

    public function verify(string $password, string $encryptedPassword): bool;
}
