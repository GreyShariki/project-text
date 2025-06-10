<?php
namespace App\Models;
use App\Core\Database;
use PDO;
class SessionModel {
  
    public function getSessionsFromFile() {
        $path = __DIR__.'/sessions.txt';
        if (file_exists($path)) {
            return file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }        
    }
    public function getSessionsFromDb($userLogin) {
        try {
            $db = new Database();
            $conn = $db -> getConnection();
            $stmt = $conn -> prepare("
            SELECT s.start_time 
            FROM sessions s
            JOIN users u ON s.user_id = u.id
            WHERE u.login = :login
        ");
        $stmt->bindParam(':login', $userLogin);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
    public function destroySession($userLogin) {
        try {
            $db = new Database();
            $conn = $db -> getConnection();
            $stmt = $conn -> prepare("
            DELETE s
            FROM sessions s
            JOIN users u ON s.user_id = u.id
            WHERE u.login = :login
            ");
            $stmt->bindParam(":login", $userLogin);
            $stmt->execute();
            return json_encode(["status"=> "Успех", "massage"=> "Сессия завершена"]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}