<?php
namespace App\Core;

use PDO;

class Database{
    private PDO $connection;
    public function __construct(){
        try {
            $this->connection = new PDO("mysql:host=176.109.110.29;dbname=asu","root","DIMAS222");
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            die("Ошибка подключения к базе данных");
        }
    }
    public function getConnection(){
        return $this->connection;
    }
}