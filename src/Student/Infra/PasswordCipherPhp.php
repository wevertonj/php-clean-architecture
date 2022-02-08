<?php

namespace Alura\Arquitetura\Student\Infra;

use Alura\Arquitetura\Student\Domain\PasswordCipher;

class PasswordCipherPhp implements PasswordCipher
{
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function verify(string $password, string $encryptedPassword): bool
    {
        return password_verify($password, $encryptedPassword);
    }
}
