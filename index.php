<?php
session_start();
require_once "vendor/autoload.php";
use App\Controllers\ApiController;

$action = $_GET['action'] ?? '';
$ApiController = new ApiController();
$ApiController->handle($action);