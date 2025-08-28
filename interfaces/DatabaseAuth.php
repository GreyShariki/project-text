<?php
namespace App\Interfaces;

use App\Core\Database;
use PDO;

class DatabaseAuth implements AuthInterface {
    private Database $db;
    
    public function __construct(Database $db) {
        $this->db = $db;
    }
    
    public function checkLogin($login, $password){
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $stmt = $conn->prepare("INSERT INTO sessions (user_id) VALUES (:user_id)");
            $stmt->execute(['user_id' => $user['id']]);
            $_SESSION['user'] = $login;
            return json_encode(['status' => 'Успех', 'user' => $login], JSON_UNESCAPED_UNICODE);
        }
        return json_encode(['status' => 'Ошибка', 'message' => 'Неверные учетные данные'],JSON_UNESCAPED_UNICODE);
    }
}