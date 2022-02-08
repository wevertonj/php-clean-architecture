<?php

namespace Alura\Arquitetura\Referral\Domain;

use Alura\Arquitetura\Student\Domain\Student;

class Referral
{
    private Student $referringStudent;
    private Student $referredStudent;
    private \DateTimeImmutable $date;

    public function __construct(Student $referringStudent, Student $referredStudent)
    {
        $this->referringStudent = $referringStudent;
        $this->referredStudent = $referredStudent;

        $this->date = new \DateTimeImmutable();
    }
}
