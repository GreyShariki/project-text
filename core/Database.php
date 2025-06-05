<?php
namespace App\Core;

use PDO;

class Database{
    private PDO $connection;
    public function __construct(){
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=ASU","root","");
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
    public function getConnection(){
        return $this->connection;
    }
}