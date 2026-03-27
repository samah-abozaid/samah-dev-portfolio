<?php

class AdminController extends AbstractController {

    private AdminManager $adminManager;

    public function __construct() {
        $this->adminManager = new AdminManager();

        // démarre la session si pas encore démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ── Afficher le formulaire login ──────────────

    public function login(): void {

        // si déjà connecté → redirect dashboard
        if (isset($_SESSION['admin'])) {
            $this->redirect('admin/dashboard');
            return;
        }

        $this->render('admin/login');
    }

    // ── Traiter le formulaire login ───────────────

    public function authenticate(): void {

        $email    = htmlspecialchars($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $admin = $this->adminManager->findByEmail($email);

        // on vérifie que l'admin existe et que le mot de passe est correct
        if ($admin === null || !password_verify($password, $admin->getPassword())) {
            $error = "Email ou mot de passe incorrect.";
            $this->render('admin/login', ['error' => $error]);
            return;
        }

        // connexion réussie → on stocke en session
        $_SESSION['admin'] = [
            'id'    => $admin->getId(),
            'email' => $admin->getEmail()
        ];

        $this->redirect('admin/dashboard');
    }

    // ── Dashboard ─────────────────────────────────

    public function dashboard(): void {
        $this->isAuthenticated();

        $projectManager = new ProjectManager();
        $projects = $projectManager->findAll();

        $this->render('admin/dashboard', ['projects' => $projects]);
    }

    // ── Liste des projets ─────────────────────────

    public function listProjects(): void {
        $this->isAuthenticated();

        $projectManager = new ProjectManager();
        $projects = $projectManager->findAll();

        $this->render('admin/list', ['projects' => $projects]);
    }

    // ── Ajouter un projet ─────────────────────────

    public function addProject(): void {
        $this->isAuthenticated();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        $this->render('admin/add', ['categories' => $categories]);
    }

    // ── Traiter l'ajout ───────────────────────────

    public function storeProject(): void {
        $this->isAuthenticated();

        $projectManager = new ProjectManager();

        $projectManager->create(
            $_POST['title'],
            $_POST['description'],
            $_POST['github_url'],
            $_POST['demo_url'],
            $_POST['image'],
            (int) $_POST['category_id']
        );

        $this->redirect('admin/projects');
    }

    // ── Modifier un projet ────────────────────────

    public function editProject(int $id): void {
        $this->isAuthenticated();

        $projectManager  = new ProjectManager();
        $categoryManager = new CategoryManager();

        $project    = $projectManager->findById($id);
        $categories = $categoryManager->findAll();

        if ($project === null) {
            http_response_code(404);
            $this->render('404');
            return;
        }

        $this->render('admin/edit', [
            'project'    => $project,
            'categories' => $categories
        ]);
    }

    // ── Traiter la modification ───────────────────

    public function updateProject(int $id): void {
        $this->isAuthenticated();

        $projectManager = new ProjectManager();

        $projectManager->update(
            $id,
            $_POST['title'],
            $_POST['description'],
            $_POST['github_url'],
            $_POST['demo_url'],
            $_POST['image'],
            (int) $_POST['category_id']
        );

        $this->redirect('admin');
    }

    // ── Supprimer un projet ───────────────────────

    public function deleteProject(int $id): void {
        $this->isAuthenticated();

        $projectManager = new ProjectManager();
        $projectManager->delete($id);

        $this->redirect('admin');
    }

    // ── Déconnexion ───────────────────────────────

    public function logout(): void {
        session_destroy();
        $this->redirect('admin');
    }

    // ── Vérifier la session ───────────────────────

    private function isAuthenticated(): void {
        if (!isset($_SESSION['admin'])) {
            $this->redirect('admin');
        }
    }
}