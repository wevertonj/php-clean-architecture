<?php

use Alura\Arquitetura\Student\Domain\Student;
use Alura\Arquitetura\Student\Infra\StudentRepositoryMemory;

require 'vendor/autoload.php';

$name = $argv[1];
$cpf = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$number = $argv[5];

$student = Student::register($name, $cpf, $email, $ddd, $number)->addPhone($ddd, $number);
$repository = new StudentRepositoryMemory();
$repository->add($student);
