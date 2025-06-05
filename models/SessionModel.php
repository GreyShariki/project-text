<?php
namespace App\Models;

class SessionModel {
    public function getSessions() {
        $path = __DIR__.'/sessions.txt';
        if (file_exists($path)) {
            return file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
    }
}