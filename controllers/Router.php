<?php
namespace App\Controllers;

use App\Controllers\FileAuthController;
use App\Controllers\SessionController;
use App\Controllers\DatabaseAuthController;

class Router {
    public function handle(string $action): void {
        switch ($action) {
            case 'authWithFile':
                $fileController = new FileAuthController();
                $fileController->userAuthentification();
                break;

            case 'authWithDatabase':
                $databaseAuthContriller = new DatabaseAuthController();
                $databaseAuthContriller->userAuthentification();
                break;

            case 'profile':
                if (!$this->isAuthorized()) {
                    $this->forbidden("Не удалось загрузить профиль");
                    return;
                }
                include 'pages/components/profile.php';
                break;

            case 'loginForm':
                include 'pages/components/form.html';
                break;

            case 'logout':
                if (isset($_SESSION["authType"], $_SESSION["user"])) {
                    $sessionController = new SessionController($_SESSION["authType"], $_SESSION["user"]);
                    $sessionController->destroySession();
                }
                session_destroy();
                echo json_encode(["status" => "Успех"], JSON_UNESCAPED_UNICODE);
                break;

            case 'sessionDate':
                if (!$this->isAuthorized()) {
                    $this->forbidden("Не удалось загрузить страницу");
                    return;
                }
                include 'pages/components/sessionTime.html';
                break;

            case 'getData':
                if (!$this->isAuthorized(true)) {
                    $this->forbidden("Недостаточно данных из сессии");
                    return;
                }
                $sessionController = new SessionController($_SESSION["authType"], $_SESSION["user"]);
                $sessionController->getTime();
                break;

            default:
                include 'pages/app.html';
                break;
        }
    }

    private function isAuthorized(bool $checkAuthType = false): bool {
        if (!isset($_SESSION['user'])) return false;
        if ($checkAuthType && !isset($_SESSION['authType'])) return false;
        return true;
    }

    private function forbidden(string $message): void {
        http_response_code(403);
        echo json_encode(["status" => "Ошибка", "massage" => $message], JSON_UNESCAPED_UNICODE);
    }
}
