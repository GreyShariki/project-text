<?php
session_start();
require_once "vendor/autoload.php";

use App\Controllers\FileAuthController;
use App\Controllers\SessionController;
use App\Controllers\DatabaseAuthController;

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'authWithFile':
        $fileController = new FileAuthController();
        $fileController->userAuthentification(); 
        break;
    case 'authWithDatabase':
        $dataBaseController = new DatabaseAuthController();
        $dataBaseController->userAuthentification(); 
        break;

    case 'profile':
        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            echo json_encode(["status"=> "Ошибка", "massage"=> "Не удалось загрузить профиль"], JSON_UNESCAPED_UNICODE);
            exit;
        }
        include 'pages/components/profile.php';
        break;
    case 'loginForm':
        include "pages/components/form.html";
        break;
    case "logout":
        session_destroy();
        echo json_encode(["status"=> "Успех"], JSON_UNESCAPED_UNICODE);
        break;
    case "sessionDate":
        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            echo json_encode(["status"=> "Ошибка", "massage"=> "Не удалось загрузить страницу"], JSON_UNESCAPED_UNICODE);
            exit;
        }
       
        include "./pages/components/sessionTime.html";
      
        break;
        
    case "getData":
        if (!isset($_SESSION['user']) || !isset($_SESSION['authType'])) {
            http_response_code(403);
            echo json_encode(["status"=> "Ошибка", "massage" => "Недостаточно данных из сессии"], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $sessionTime = new SessionController($_SESSION["authType"], $_SESSION['user']);
        echo $sessionTime->getTime();
        break;
    default:
        include 'pages/app.html';
        break;
}
