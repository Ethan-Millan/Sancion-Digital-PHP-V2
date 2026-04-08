<?php

class HomeController{
    public function __construct($db){

    }

    public function index(){
        require_once '../views/home.php';
    }
}