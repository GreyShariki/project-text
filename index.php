<?php
session_start();
require_once "vendor/autoload.php";

use App\Controllers\FileAuthController;
use App\Controllers\SessionController;


$action = $_GET['action'] ?? '';

switch ($action) {
    case 'authWithFile':
        $controller = new FileAuthController();
        $controller->login(); 
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
        $sessionTime = new SessionController();

        echo $sessionTime->getTime();
        break;
    default:
        include 'pages/app.html';
        break;
}
