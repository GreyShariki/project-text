<?php
namespace App\Controllers;

use App\Interfaces\LogoutDatabase;
use App\Controllers\RouterController;
use App\Controllers\AuthController;
use App\Interfaces\DatabaseAuth;
use App\Models\Session;
use App\Core\Database;

class ApiController  {
    private RouterController $router;
    private AuthController $authController;
    private $userSession;
    public function __construct(){
        $this->router = new RouterController;
        $this->authController = new AuthController(new DatabaseAuth(new Database()), new LogoutDatabase(new Database()));
    }

    public function handle($action) {
        if (method_exists($this, $action)) {
            return $this->$action();
        }
        $this->router->loadPage("app");
    }
    
    private function authenticate() {
        $result = $this->authController->authenticate();
        $this->userSession = new Session($_SESSION["user"], 222323232323);
        if($this->userSession){
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => "Ошибка", "message" => "Не удалось создать сессию"]);
        }
    }
    private function loadProfile() {
        if (!$this->isAuthorized()) {
            http_response_code(401);
            echo json_encode(["status" => "Ошибка", "message" => "Unauthorized"], JSON_UNESCAPED_UNICODE);
            return;
        }
        $this->router->loadPage("profile");
    }
    private function loadLoginForm(){
        $this->router->loadPage("loginForm");
    }
    
    private function logout(){
        $result = $this->authController->logout();
        echo $result;
    }
    private function getUser(){
        echo json_encode(["user"=>$_SESSION['user'], "startTime"=> $_SESSION["startTime"]], JSON_UNESCAPED_UNICODE);
    }
    private function loadDatetime(){
        if (!$this->isAuthorized()){
            http_response_code(401);
            return json_encode(["status" => "Ошибка", "message" => "Unauthorized"]);
        }
        $this->router->loadPage("sessionDate");
    }

    private function forbidden($message){
        http_response_code(401);
        echo json_encode(["status" => "Ошибка", "message" => $message], JSON_UNESCAPED_UNICODE);
    }
    
    private function isAuthorized(){
        if (!isset($_SESSION["user"])){
            return false;
        }
        return true;
    }
}
