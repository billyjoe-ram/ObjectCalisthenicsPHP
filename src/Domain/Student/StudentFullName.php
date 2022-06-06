<?php

namespace Alura\Calisthenics\Domain\Student;

class StudentFullName {
    private string $firstName;
    private string $lastName;
    
    public function __construct(string $firstName, string $lastName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function __toString(): string {
        return "{$this->firstName} {$this->lastName}";
    }
}