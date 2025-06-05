<?php
namespace App\Controllers;

use App\Models\SessionModel;

class SessionController{
    public function getTime(){
        $now = date("Y-m-d H:i:s");
        $userLogin = $_SESSION['user'];

        $sessions = new SessionModel();
        $result = $sessions->getSessions();
        $lastSession = $result[count($result)-1];
        
        $startTime = explode('/', $lastSession);

        $sessionTime = strtotime($now) - strtotime($startTime[0]);
        echo json_encode($sessionTime);
    }    
}