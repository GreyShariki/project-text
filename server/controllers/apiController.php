<?php
class ApiController{
    public function profile(){
        if (empty($_SESSION['user'])){
            die(json_encode(["error" => "Нет доступа"]));
        }
        include "../../pages/profile.php";
    }
    public function loadDatetime() { 
        include __DIR__ . '/../Views/datetime.php';        
    }
}