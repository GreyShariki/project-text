<?php
namespace App\Controllers;

class RouterController {
    public $action;
    public function loadPage(string $page){
            include "pages/components/$page.html";
    }
}