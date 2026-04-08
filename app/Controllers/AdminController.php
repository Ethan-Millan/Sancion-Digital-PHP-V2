<?php

class AdminController{

    public function __construct($db){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['user_id'])){
            header('Location: ' . URL_PROJECT . 'index.php?url=home/index');
            exit;
        }

        if($_SESSION['user_role'] != 1){
            header('Location: ' . URL_PROJECT . 'index.php?url=home/index');
            exit;
        }
    }

    public function dashboard(){
        require_once '../views/admin/dashboard.php';
    }
}