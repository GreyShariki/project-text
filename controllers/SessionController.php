<?php
namespace App\Controllers;

use App\Models\SessionModel;

class SessionController{
    public $sessionType;
    public $userLogin;
    public function __construct($sessionType, $userLogin){
        $this->sessionType = $sessionType;
        $this->userLogin = $userLogin;
    }
    public function getTime(){

        $now = date("Y-m-d H:i:s");
        $sessions = new SessionModel();

        if ($this->sessionType == "file"){

            $result = $sessions->getSessionsFromFile();
            $lastSession = $result[count($result)-1];
            
            $startTime = explode('/', $lastSession);

            $sessionTime = strtotime($now) - strtotime($startTime[0]);
            echo json_encode($sessionTime);
        } else {
            $result = $sessions->getSessionsFromDb($this->userLogin);
            $lastSession = $result[0]["start_time"];

            $sessionTime = strtotime($now) - strtotime($lastSession);
            echo json_encode($sessionTime);
        }
    }    
}