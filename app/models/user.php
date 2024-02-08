<?php

class User implements JsonSerializable
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $role;
    private string $registration_date;

    const ADMINISTRATOR = "admin";
    const CUSTOMER = "customer";
    const EMPLOYEE = "employee";

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {

        if ($role !== self::ADMINISTRATOR && $role !== self::CUSTOMER && $role !== self::EMPLOYEE) {
            throw new InvalidArgumentException("Invalid role");
        }
        $this->role = $role;
    }

    public function getRegistrationDate(): string
    {
        return $this->registration_date;
    }

    public function setRegistrationDate(string $registration_date): void
    {
        $this->registration_date = $registration_date;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'registration_date' => $this->registration_date
        ];
    }
} 