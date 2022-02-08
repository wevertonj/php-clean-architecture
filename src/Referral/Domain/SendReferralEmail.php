<?php

namespace Alura\Arquitetura\Referral\Domain;

interface SendReferralEmail
{
    public function send(string $referredEmail, string $referredName, string $referringName): void;
}
