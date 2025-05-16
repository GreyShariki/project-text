<?php
class Controller{
    public function profile(){
        if (empty($_SESSION['user'])){
            header("Location: /");
        }
        include "pages/profile.php";
    }
    public function datetime() { 
        include 'pages/datetime.php';        
    }
}