<?php

class ContactController extends AbstractController {

    public function about(): void {
        $this->render('about');
    }

    public function index(): void {
        $this->render('contact');
    }

    public function send(): void {
        $name    = htmlspecialchars($_POST['name']);
        $email   = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        mail(
            "ton-email@gmail.com",
            "Contact Portfolio - $name",
            $message,
            "From: $email"
        );

        $this->redirect('contact');
    }
}
