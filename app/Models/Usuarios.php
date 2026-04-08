<?php

class Usuarios{
    private $db;

    public function __construct($db_connection){
        $this->db = $db_connection;// se recibe la conecion de la bd 
    }

    public function ObtenerPorEmail($username){
        //se prepara la consulta para evitar inyeccion sql
        $query = "SELECT id, correo_electronico, password, rol_id, nombre FROM usuarios WHERE correo_electronico = :username LIMIT 1";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function Register($datos){
        
        $sql = "INSERT INTO usuarios (matricula, nombre, apellido_paterno, apellido_materno, correo_electronico, password, rol_id) 
        VALUES (:matricula, :nombre, :apellido_paterno, :apellido_materno, :correo_electronico, :password, :rol_id)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':matricula' => $datos['matricula'],
            ':nombre' => $datos['nombre'],
            ':apellido_paterno' => $datos['apellido_paterno'],
            ':apellido_materno' => $datos['apellido_materno'],
            ':correo_electronico' => $datos['correo_electronico'],
            ':password' => $datos['password'],
            ':rol_id' => $datos['rol_id']
        ]);
    }
}