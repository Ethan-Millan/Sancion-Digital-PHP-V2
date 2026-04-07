<?php

class Usuarios{
    private $db;

    public function __construct($db_connection){
        $this->db = $db_connection;// se recibe la conecion de la bd 
    }

    public function ObtenerPorEmail($username){
        //se prepara la consulta para evitar inyeccion sql
        $query = "select id, correo_electronico, password, rol_id, nombre from usuarios where correo_electronico = :username limit 1";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch();
    }
}