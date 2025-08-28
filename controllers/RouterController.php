<?php
namespace App\Controllers;

use App\Controllers\FileAuthController;
use App\Controllers\SessionController;
use App\Controllers\DatabaseAuthController;
use App\Models\PageModel;
use App\Controllers\AuthController;

class RouterController {
    public $action;
    public function loadPage(string $page){
            include "pages/components/$page.html";
    }
}