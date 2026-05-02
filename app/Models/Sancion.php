<?php

class Sancion{

    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    

    public function store($sancion){
        $sql = "INSERT INTO sanciones (alumno_id, vigilante_id, codigo_falta_id, fecha_reporte,observaciones) VALUES (:alumno_id, :vigilante_id,:codigo_falta_id, now(), :observaciones);";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':alumno_id' => $sancion['id_alumno'],
            ':vigilante_id' => $sancion['id_vigilante'],
            ':codigo_falta_id' => $sancion['codigo_falta_id'],
            ':observaciones' => $sancion['observaciones']
        ]);
    }

    public function findById($id){
        $sql = "SELECT id FROM sanciones WHERE id = :id LIMIT 1;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function delete($id_sancion){
        $sql = "DELETE FROM sanciones WHERE id = :id_sancion;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_sancion' => $id_sancion]);
        return $stmt->rowCount() > 0;
    }
}