<?php
namespace App\Interfaces;

use App\Core\Database;
use App\Interfaces\LogoutInterface;

class LogoutDatabase implements LogoutInterface{
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }
    public function logout($userLogin){
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn -> prepare("DELETE s FROM sessions s JOIN users u ON s.user_id = u.id WHERE u.login = :login");
            $stmt->bindParam(":login", $userLogin);
            $stmt->execute();
            return json_encode(["status"=> "Успех", "massage"=> "Сессия завершена"]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}