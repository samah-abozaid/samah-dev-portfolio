<?php

class ProjectManager extends AbstractManager {

    // ── Récupérer tous les projets ────────────────

    public function findAll(): array {

        $query = $this->db->query("
            SELECT projects.*, 
                   categories.name AS category_name, 
                   categories.slug AS category_slug
            FROM projects
            JOIN categories ON projects.category_id = categories.id
        ");

        $projects = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $category = new Category(
                $row['category_id'],
                $row['category_name'],
                $row['category_slug']
            );

            $projects[] = new Project(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['github_url'],
                $row['demo_url'],
                $row['image'],
                $category
            );
        }

        return $projects;
    }

    // ── Récupérer un projet par son id ────────────

    public function findById(int $id): ?Project {

        $query = $this->db->prepare("
            SELECT projects.*, 
                   categories.name AS category_name, 
                   categories.slug AS category_slug
            FROM projects
            JOIN categories ON projects.category_id = categories.id
            WHERE projects.id = :id
        ");

        $query->execute(['id' => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        $category = new Category(
            $row['category_id'],
            $row['category_name'],
            $row['category_slug']
        );

        return new Project(
            $row['id'],
            $row['title'],
            $row['description'],
            $row['github_url'],
            $row['demo_url'],
            $row['image'],
            $category
        );
    }

    // ── Créer un projet ───────────────────────────

    public function create(
        string $title,
        ?string $description,
        ?string $github_url,
        ?string $demo_url,
        ?string $image,
        int $category_id
    ): void {

        $query = $this->db->prepare("
            INSERT INTO projects (title, description, github_url, demo_url, image, category_id)
            VALUES (:title, :description, :github_url, :demo_url, :image, :category_id)
        ");

        $query->execute([
            'title'       => $title,
            'description' => $description,
            'github_url'  => $github_url,
            'demo_url'    => $demo_url,
            'image'       => $image,
            'category_id' => $category_id
        ]);
    }
    
     // ── Modifier un projet ────────────────────────

    public function update(
        int $id,
        string $title,
        ?string $description,
        ?string $github_url,
        ?string $demo_url,
        ?string $image,
        int $category_id
    ): void {

        $query = $this->db->prepare("
            UPDATE projects 
            SET title       = :title,
                description = :description,
                github_url  = :github_url,
                demo_url    = :demo_url,
                image       = :image,
                category_id = :category_id
            WHERE id = :id
        ");

        $query->execute([
            'id'          => $id,
            'title'       => $title,
            'description' => $description,
            'github_url'  => $github_url,
            'demo_url'    => $demo_url,
            'image'       => $image,
            'category_id' => $category_id
        ]);
    }

    // ── Supprimer un projet ───────────────────────

    public function delete(int $id): void {

        $query = $this->db->prepare("DELETE FROM projects WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}