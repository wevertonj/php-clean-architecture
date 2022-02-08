<?php

namespace Alura\Arquitetura\Referral\Infra;

use Alura\Arquitetura\Referral\App\SendReferralEmail;

class SendReferralEmailPhp implements SendReferralEmail
{
    public function send(string $referredEmail, string $referredName, string $referringName): void
    {
        $subject = "{$referringName} te recomendou o nosso curso!";
        $message = "Olá {$referredName}, {$referringName} te recomendou o nosso curso!";

        mail($referredEmail, $subject, $message);
    }
}
