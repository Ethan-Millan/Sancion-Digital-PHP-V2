<?php
require_once '../app/Models/Multas.php';

class MultasController{
    private $multaModel;

    public function __construct($db){
        $this->multaModel = new Multas($db);    
    }

    public function store(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(empty($_POST['nombre_falta']) || empty($_POST['horas_sancion'])){
                throw new Exception("El nombre y las horas tienen que estar llenos");
            }

            if($_POST['horas_sancion'] <= 0){
                throw new Exception("Las horas deben ser mayores a cero");
            }

            $datos = [
                'nombre_falta' => trim($_POST['nombre_falta']),
                'descripcion' => trim($_POST['descripcion']),
                'horas_sancion' => (int)$_POST['horas_sancion']
            ];

            if($this->multaModel->store($datos)){
                header('Location: ' . URL_PROJECT . 'index.php?url=multas/index');
                exit;
            }
        }
        require_once dirname(__DIR__, 2) . '/views/admin/multas/home.php';
    }

    public function update($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(empty($_POST['nombre_falta']) || empty($_POST['horas_sancion'])){
                throw new Exception("El nombre y las horas tienen que estar llenos");
            }

            $datos = [
                'nombre_falta' => trim($_POST['nombre_falta']),
                'descripcion' => trim($_POST['descripcion']),
                'horas_sancion' => (int)$_POST['horas_sancion']
            ];

            if($this->multaModel->home($id)){
                if($this->multaModel->update($id, $datos)){
                    header('Location: ' . URL_PROJECT . 'index.php?url=multas/index');
                    exit;
                }
            }else{
                throw new Exception('No se encontro esa multa');
            }
        }
        require_once dirname(__DIR__, 2) . '/views/admin/multas/home.php';
    }

    public function delete($id){
        if($this->multaModel->home($id)){
            if($this->multaModel->delete($id)){
                header('Location: ' . URL_PROJECT . 'index.php?url=multas/index');
                exit;
            }
        }else{
            throw new Exception('Esta multa no existe');
        }
    }
}