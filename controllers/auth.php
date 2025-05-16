<?php
class AuthController{
    public function login(){
        $file = file("models/user.txt");
        if ($_POST['login'] === trim($file[0]) && $_POST["password"] === trim($file[1])){
            $_SESSION["user"] = trim($file[0]);
            include("pages/profile.php");
        } else {
            echo json_encode(["error" => "Неверный логичн или пароль"], JSON_UNESCAPED_UNICODE);
        }
    }
}
?>