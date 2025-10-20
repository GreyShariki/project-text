<?php
namespace App\Controllers;

use App\Interfaces\AuthInterface;
use App\Interfaces\LogoutInterface;

class AuthController {
    private AuthInterface $auth;
    private LogoutInterface $logoutUser;

    public function __construct(AuthInterface $auth, LogoutInterface $logoutUser) {
        $this->auth = $auth;
        $this->logoutUser = $logoutUser;
    }
    
    public function authenticate(){
        $loginInput = $_POST['login'] ?? '';
        $passwordInput = $_POST['password'] ?? '';
        
        if (empty($loginInput) || empty($passwordInput)) {
            return json_encode([
                'status' => 'Ошибка', 
                'message' => 'Логин и пароль обязательны'
            ], JSON_UNESCAPED_UNICODE);
        }
        
        $result = $this->auth->checkLogin($loginInput, $passwordInput);
        return $result;
    }
    public function logout(){
        $result = $this->logoutUser->logout($_SESSION['user']);
        session_destroy();
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}