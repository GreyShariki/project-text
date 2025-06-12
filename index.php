<?php
session_start();
require_once "vendor/autoload.php";

use App\Controllers\Router;

$action = $_GET['action'] ?? '';
$router = new Router();
$router->handle($action);