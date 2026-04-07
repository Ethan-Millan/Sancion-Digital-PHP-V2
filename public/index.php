<?php

require_once '../config/db_config.php';
require_once '../app/Core/Database.php';

$database = new Database();

$db = $database->connect();

if($db){
    echo "Conexión exitosa a la base de datos.";
}else{
    echo "Error al conectar a la base de datos.";
}