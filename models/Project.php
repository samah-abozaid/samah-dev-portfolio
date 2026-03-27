<?php

class Project {

    public function __construct(
        private ?int $id,
        private string $title,
        private ?string $description,  // ← peut être null
        private ?string $github_url,   // ← peut être null
        private ?string $demo_url,     // ← peut être null
        private ?string $image,        // ← peut être null
        private Category $category
    ) {}

    // ── Getters ──────────────────────────────────

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getGithubUrl(): ?string {
        return $this->github_url;
    }

    public function getDemoUrl(): ?string {
        return $this->demo_url;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function getCategory(): Category {
        return $this->category;
    }

    // ── Setters ──────────────────────────────────

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function setGithubUrl(?string $github_url): void {
        $this->github_url = $github_url;
    }

    public function setDemoUrl(?string $demo_url): void {
        $this->demo_url = $demo_url;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }

    public function setCategory(Category $category): void {
        $this->category = $category;
    }
}
