
<?php
session_start();
$action = $_POST['action'] ?? '';
require_once "controllers/auth.php";
require_once "controllers/routing.php";
switch($action){
  case "login":
    (new AuthController())->login();
    break;
  case "profile":
    (new Controller())->profile();
    break;
  case "datetime":
    (new Controller())->datetime();
    break;
  default:
    include './pages/auth.php';
}
?>


