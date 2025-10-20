<?php
namespace App\Models;

class User {
    public int $id;
    public string $login;
    public string $password;
    public string $created_at;
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getLogin(): string {
        return $this->login;
    }
}