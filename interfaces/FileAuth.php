<?php
namespace App\Interfaces;
use App\Interfaces\AuthInterface;

class FileAuth implements AuthInterface {
    private string $authFile;
    private string $sessionsFile;
    
    public function __construct($authFile, $sessionsFile){
        $this->authFile = $authFile;
        $this->sessionsFile = $sessionsFile;
    }
    
    public function checkLogin($login, $password){
        if (!file_exists($this->authFile)) {
            return json_encode(['status' => 'Ошибка', 'message' => 'Файл аутентификации не найден'], JSON_UNESCAPED_UNICODE);
        }
        
        $lines = file($this->authFile);
        $correctLoginFromFile = trim($lines[0]);
        $correctPasswordFromFile = trim($lines[1]);
        
        if ($password === $correctPasswordFromFile && $login === $correctLoginFromFile) {

            $logline = date('Y-m-d H:i:s') . '/' . $login . "\n";
            file_put_contents($this->sessionsFile, $logline, FILE_APPEND);
            $_SESSION['user'] = $login;
            $_SESSION['startTime'] = time();
            return ['status' => 'Успех', 'user' => $login];
        }
        
        return json_encode(['status' => 'Ошибка', 'message' => 'Неверные учетные данные'], JSON_UNESCAPED_UNICODE);
    }
}