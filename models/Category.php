<?php

class Category {

    public function __construct(
        private ?int $id,
        private string $name,
        private string $slug
    ) {}

    // ── Getters ──────────────────────────────────

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    // ── Setters ──────────────────────────────────

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setSlug(string $slug): void {
        $this->slug = $slug;
    }
}
