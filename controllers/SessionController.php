<?php
namespace App\Controllers;

use App\Models\SessionModel;

class SessionController{
    public $authType;
    public $userLogin;
    public function __construct($authType, $userLogin){
        $this->authType = $authType;
        $this->userLogin = $userLogin;
    }
    public function getTime(){
        date_default_timezone_set('Asia/Novosibirsk');
        $now = date("Y-m-d H:i:s");
        $sessions = new SessionModel();
        if ($this->authType == "file"){
            $result = $sessions->getSessionsFromFile();
             if (empty($result)) {
                echo json_encode(["error" => "Нет сессий"]);
                return;
            }
            $lastSession = $result[count($result)-1];
            $startTimeArray = explode('/', $lastSession);
            $startTime = $startTimeArray[0];
        } else if ($this->authType == "db") {
            $result = $sessions->getSessionsFromDb($this->userLogin);
            $startTime = $result[0]["start_time"];
        }
        $sessionTime = strtotime($now) - strtotime($startTime);
        echo json_encode($sessionTime);
    }    
}