<?php

class ProgramaEducativo{
    private $db:

    public function __construct($db){
        $this->db = $db;
    }

    public function store($programa_educativo){
        $sql = 'INSERT INTO programa_educativo (nombre_carrera, clave_carrera) VALUES (:nombre_carrera, :clave_carrera);';

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nombre_carrera' => $programa_educativo['nombre_carrera'],
            ':clave_carrera' => $programa_educativo['clave_carrera']
        ]);
    }
}
