<?php

class AdminManager extends AbstractManager {

    // ── Trouver un admin par email ────────────────

    public function findByEmail(string $email): ?Admin {

        $query = $this->db->prepare("SELECT * FROM admin WHERE email = :email");

        $query->execute(['email' => $email]);

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return new Admin(
            $row['id'],
            $row['email'],
            $row['password']
        );
    }
}