<?php
// ── Models ───────────────────────────────────────//
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Project.php";
require_once __DIR__ . "/../models/Admin.php";         // ← ajouter

// ── Managers ─────────────────────────────────────
require_once __DIR__ . "/../managers/AbstractManager.php";
require_once __DIR__ . "/../managers/CategoryManager.php";
require_once __DIR__ . "/../managers/ProjectManager.php";
require_once __DIR__ . "/../managers/AdminManager.php";   // ← ajouter

// ── Controllers ──────────────────────────────────
require_once __DIR__ . "/../controllers/AbstractController.php";
require_once __DIR__ . "/../controllers/CategoryController.php";
require_once __DIR__ . "/../controllers/ProjectController.php";
require_once __DIR__ . "/../controllers/ContactController.php";
require_once __DIR__ . "/../controllers/AdminController.php";  // ← ajouter

// ── Services ─────────────────────────────────────
require_once __DIR__ . "/../services/Router.php";