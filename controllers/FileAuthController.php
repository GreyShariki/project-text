<?php
namespace App\Controllers;

use App\Models\AuthModel;

class FileAuthController{
    public function login(){
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $authModel = new AuthModel($password, $login);
        $result = $authModel->authWithFile();
        echo $result;
    }
}
?>