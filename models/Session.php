<?php
namespace App\Models;

class Session {
    public $userLogin;
    public $createdAt;

    public function __construct($userLogin, $createdAt){
        $this->userLogin = $userLogin;
        $this->createdAt = $createdAt;
    }
    
    public function getUserlogin(){
        return $this->userLogin;
    }
    public function getSessionDate(){
        return $this->createdAt;
    }
}