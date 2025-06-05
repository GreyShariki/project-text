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
        $lines = file( __DIR__.'./user.txt');
        $correctPassword = trim($lines[1]);
        $correctLogin = trim($lines[0]);

        if ($this->passwordInput == $correctPassword && $this->loginInput == $correctLogin ){
            $_SESSION['user'] = $this->loginInput;

            $logline = date('Y-m-d H:i:s') .'/'. $correctLogin . "\n";
            file_put_contents( __DIR__.'./sessions.txt', $logline, FILE_APPEND);
            return json_encode(['status'=> 'Успех', "user"=> $this -> loginInput ], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(["status"=> "Ошибка", "massage"=> "Неверное имя пользователя или пароль" ], JSON_UNESCAPED_UNICODE);
        }
    }
    public function AuthWithDatabase(){

    }
}
?>