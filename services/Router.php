<?php

class Router {

    private ProjectController $projectController;
    private CategoryController $categoryController;
    private ContactController $contactController;
    private AdminController $adminController;

    public function __construct() {
        $this->projectController  = new ProjectController();
        $this->categoryController = new CategoryController();
        $this->contactController  = new ContactController();
        $this->adminController    = new AdminController();
    }

    public function handleRequest(): void {

        $route = $_GET['route'] ?? '';

        // ── Routes publiques ──────────────────────

        if ($route === '') {
            $this->projectController->list();

        } else if ($route === 'projects') {
            $this->projectController->list();

        } else if (preg_match('#^projects/(\d+)$#', $route, $matches)) {
            $this->projectController->show((int) $matches[1]);

        } else if ($route === 'categories') {
            $this->categoryController->list();

        } else if (preg_match('#^categories/([a-z0-9\-]+)$#', $route, $matches)) {
            $this->categoryController->listBySlug($matches[1]);

        } else if ($route === 'about') {
            $this->contactController->about();

        } else if ($route === 'contact') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->contactController->send();
            } else {
                $this->contactController->index();
            }

        // ── Routes admin ──────────────────────────

        } else if ($route === 'admin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->adminController->authenticate();
            } else {
                $this->adminController->login();
            }

        } else if ($route === 'admin/dashboard') {
            $this->adminController->dashboard();

        } else if ($route === 'admin') {
            $this->adminController->listProjects();

        } else if ($route === 'admin/add') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->adminController->storeProject();
            } else {
                $this->adminController->addProject();
            }

        } else if (preg_match('#^admin/edit/(\d+)$#', $route, $matches)) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->adminController->updateProject((int) $matches[1]);
            } else {
                $this->adminController->editProject((int) $matches[1]);
            }

        } else if (preg_match('#^admin/delete/(\d+)$#', $route, $matches)) {
            $this->adminController->deleteProject((int) $matches[1]);

        } else if ($route === 'admin/logout') {
            $this->adminController->logout();

        // ── 404 ───────────────────────────────────

        } else {
            http_response_code(404);
            $this->notFound();
        }
    }

    private function notFound(): void {
        require __DIR__ . '/../templates/404.phtml';
    }
}
