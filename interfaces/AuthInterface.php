<?php
namespace App\Interfaces;

interface AuthInterface {
    public function checkLogin($login, $password);
}