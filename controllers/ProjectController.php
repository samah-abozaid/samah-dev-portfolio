<?php

class ProjectController extends AbstractController {

    private ProjectManager $projectManager;

    public function __construct() {
        $this->projectManager = new ProjectManager();
    }

public function list(): void {
    $projects = $this->projectManager->findAll();
    $this->render('list', ['projects' => $projects]);
}

public function show(int $id): void {
    $project = $this->projectManager->findById($id);

    if ($project === null) {
        http_response_code(404);
        $this->render('404');
        return;
    }

    $this->render('show', ['project' => $project]);
}
}