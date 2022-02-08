<?php

namespace Alura\Arquitetura\Student\Infra;

use Alura\Arquitetura\Student\Domain\PasswordCipher;

class PasswordCipherMd5 implements PasswordCipher
{
    public function encrypt(string $password): string
    {
        return md5($password);
    }

    public function verify(string $password, string $encryptedPassword): bool
    {
        return $this->encrypt($password) === $encryptedPassword;
    }
}
