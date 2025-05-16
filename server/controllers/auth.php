<?php
class AuthController{
    public function login(){
        header("Content-Type: application/json");
        $file = file_get_contents("../models/user");
        if ($_POST['login'] === trim($file[0]) && $_POST["password"] === trim($file[1])){
            $_SESSION["user"] = trim($file[0]);
            echo json_encode(['success'=> true]);
        } else {
            echo json_encode(["error" => "Неверный логичн или пароль"]);
        }
    }
}
?>