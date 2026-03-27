<?php

// ── Afficher les erreurs ──────────────────────────
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ── Autoload ─────────────────────────────────────
require_once "config/autoload.php";
// $projectManager = new ProjectManager();
// $projects = $projectManager->findAll();
// var_dump($projects);
// exit();

// ── Router ───────────────────────────────────────
$router = new Router();
$router->handleRequest();