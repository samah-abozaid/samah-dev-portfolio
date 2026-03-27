<?php

class CategoryController extends AbstractController {

    private CategoryManager $categoryManager;
    private ProjectManager $projectManager;

    public function __construct() {
        $this->categoryManager = new CategoryManager();
        $this->projectManager  = new ProjectManager();
    }

    // ── Liste de toutes les catégories ────────────

    public function list(): void {
        $categories = $this->categoryManager->findAll();
        $this->render('list', ['categories' => $categories]);
    }

    // ── Liste des projets par slug de catégorie ───

    public function listBySlug(string $slug): void {

        $category = $this->categoryManager->findBySlug($slug);

        if ($category === null) {
            http_response_code(404);
            $this->render('404');
            return;
        }

        $projects = $this->projectManager->findAll();

        $this->render('list', [
            'category' => $category,
            'projects' => $projects
        ]);
    }

    // ── Détail d'une catégorie par son id ─────────

    public function show(int $id): void {

        $category = $this->categoryManager->findById($id);

        if ($category === null) {
            http_response_code(404);
            $this->render('404');
            return;
        }

      
        $this->render('show', ['category' => $category]);
        
    }
    
}