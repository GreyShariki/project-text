<?php
namespace App\Models;

use App\Core\Database;

class AuthModel{
    private $passwordInput;
    private $loginInput;

    public function __construct($passwordInput,$loginInput){
        $this->passwordInput = $passwordInput;
        $this->loginInput = $loginInput;
    }

    public function AuthWithFile(){
        $lines = file( __DIR__.'/user.txt');
        $correctPassword = trim($lines[1]);
        $correctLogin = trim($lines[0]);

        if ($this->passwordInput == $correctPassword && $this->loginInput == $correctLogin ){
            $_SESSION['user'] = $this->loginInput;
            $_SESSION['authType'] = "file";
            $logline = date('Y-m-d H:i:s') .'/'. $correctLogin . "\n";
            file_put_contents( __DIR__.'/sessions.txt', $logline, FILE_APPEND);
            return json_encode(['status'=> 'Успех', "user"=> $this -> loginInput ], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(["status"=> "Ошибка", "massage"=> "Неверное имя пользователя или пароль" ], JSON_UNESCAPED_UNICODE);
        }
    }
    public function AuthWithDatabase(){
        try {
            $db = new Database();

            $conn = $db -> getConnection();
            $stmt = $conn -> prepare("SELECT * FROM users WHERE login = :login");
            $stmt -> bindParam(':login', $this -> loginInput);
            $stmt -> execute();
            
            $user = $stmt -> fetch(\PDO::FETCH_ASSOC);
            if ($user && password_verify($this->passwordInput, $user['password'])){
                $_SESSION['authType'] = "db";
                $_SESSION['user'] = $this->loginInput;
                $stmt1 = $conn->prepare("INSERT INTO sessions (user_id) VALUES (:user_id)");
                $stmt1->execute(['user_id' => $user['id']]);

                return json_encode(['status'=> 'Успех','user'=> $this->loginInput ], JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(['status'=> 'Ошибка','massage'=> 'Неверное имя пользователя или пароль']);
            }
        } catch (\Throwable $th) {
            return json_encode(['status'=> 'Ошибка', 'massage' => $th->getMessage() ], JSON_UNESCAPED_UNICODE);
        }
    }
}
?>