<?php

class CategoryManager extends AbstractManager {

    // ── Récupérer toutes les catégories ──────────

    public function findAll(): array {

        $query = $this->db->query("SELECT * FROM categories");

        $categories = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $category = new Category(
                $row['id'],
                $row['name'],
                $row['slug']
            );

            $categories[] = $category;
        }

        return $categories;
    }

    // ── Récupérer une catégorie par son id ────────

    public function findById(int $id): ?Category {

        $query = $this->db->prepare("SELECT * FROM categories WHERE id = :id");

        $query->execute(['id' => $id]);

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return new Category(
            $row['id'],
            $row['name'],
            $row['slug']
        );
    }

    // ── Récupérer une catégorie par son slug ──────

    public function findBySlug(string $slug): ?Category {

        $query = $this->db->prepare("SELECT * FROM categories WHERE slug = :slug");

        $query->execute(['slug' => $slug]);

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return new Category(
            $row['id'],
            $row['name'],
            $row['slug']
        );
    }
}
