<?php

abstract class AbstractController {

    protected function render(string $template, array $data = []): void {
        extract($data);

        // 1. on capture le contenu du template
        ob_start();
        require __DIR__ . "/../templates/" . $template . ".phtml";
        $content = ob_get_clean();

        // 2. on choisit le bon layout
        if (str_starts_with($template, 'admin/') && $template !== 'admin/login') {
            // layout admin → sidebar + nav admin
            require __DIR__ . "/../templates/admin/layout.phtml";
        } else {
            // layout public → nav publique
            require __DIR__ . "/../templates/layout.phtml";
        }
    }

    protected function redirect(string $route): void {
        header("Location: index.php?route=" . $route);
        exit();
    }
}
