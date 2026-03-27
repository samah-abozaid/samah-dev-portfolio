<?php

class Admin {

    public function __construct(
        private ?int $id,
        private string $email,
        private string $password
    ) {}

    // ── Getters ──────────────────────────────────

    public function getId(): ?int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    // ── Setters ──────────────────────────────────

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
}