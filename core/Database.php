<?php
namespace App\Core;
use PDO;

class Database{
    private PDO $connection;
    public function __construct(){
        try {
            $this->connection = new PDO("mysql:host=localhost;port=3308;dbname=asu","root","");
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            die("Ошибка подключения к базе данных");
        }
    }
    public function getConnection(){
        return $this->connection;
    }
}