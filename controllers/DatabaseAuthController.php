<?php
namespace App\Controllers;
use App\Models\AuthModel;

class DatabaseAuthController{
    public function userAuthentification(){
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $authModel = new AuthModel($password, $login);

        $result = $authModel->AuthWithDatabase();
        echo $result;
    }
}