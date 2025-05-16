<?php
session_start();
$data = json_decode(file_get_contents("php://input", true));

$action = $data['action'];

switch($action){
  case "login":
    (new AuthController())->login();
    break;
  case "profile":
    (new ApiController())->loadProfile();
    break;
  case "datetime":
    (new ApiController())->loadDatetime();
  default:
    include './pages/auth.php';
}

