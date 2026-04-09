<?php
class Multas{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function home($id = null){
        if(!$id){
            $sql = "SELECT id, nombre_falta, descripcion, horas_sancion FROM codigo_faltas ORDER BY id DESC;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }else{
            $sql = "SELECT id, nombre_falta, descripcion, horas_sancion FROM codigo_faltas WHERE id = :id;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }

    public function store($datos){
        $sql = "INSERT INTO codigo_faltas (nombre_falta, descripcion, horas_sancion) VALUES (:nombre_falta, :descripcion, :horas_sancion);";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre_falta' => $datos['nombre_falta'],
            ':descripcion' => $datos['descripcion'],
            ':horas_sancion' => $datos['horas_sancion']
        ]);
    }

    public function update($id, $datos){
        $sql = "UPDATE codigo_faltas SET nombre_falta = :nombre_falta, descripcion = :descripcion, horas_sancion = :horas_sancion WHERE id = :id;";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre_falta' => $datos['nombre_falta'],
            ':descripcion' => $datos['descripcion'],
            ':horas_sancion' => $datos['horas_sancion'],
            ':id' => $id
        ]);
    }

    public function delete($id){
        $sql = "DELETE FROM codigo_faltas WHERE id = :id;";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}