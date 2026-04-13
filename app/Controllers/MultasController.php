<?php

use App\Exceptions\DatabaseException;
use App\Exceptions\ValidationException;

require_once '../app/Models/Multas.php';

class MultasController{
    private $multaModel;

    public function __construct($db){
        $this->multaModel = new Multas($db);    
    }

    public function store(){
        try{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(empty($_POST['nombre_falta']) || empty($_POST['horas_sancion'])){
                    throw new ValidationException("El nombre y las horas tienen que estar llenos");
                }

                if($_POST['horas_sancion'] <= 0){
                    throw new ValidationException("Las horas deben ser mayores a cero");
                }

                $datos = [
                    'nombre_falta' => trim($_POST['nombre_falta']),
                    'descripcion' => trim($_POST['descripcion']),
                    'horas_sancion' => (int)$_POST['horas_sancion']
                ];

                if($this->multaModel->store($datos)){
                    $_SESSION['success'] = 'Multa creada correctamente.';
                    header('Location: ' . URL_PROJECT . 'index.php?url=multas/index');
                    exit;
                }
            }
            require_once dirname(__DIR__, 2) . '/views/admin/multas/home.php';
        }catch(ValidationException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . URL_PROJECT . 'index.php?url=multas/index');
            exit;
        }catch(DatabaseException $e){
            die("Error técnico: " . $e->getMessage());
        }
    }

    public function update($id){
        try{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(empty($_POST['nombre_falta']) || empty($_POST['horas_sancion'])){
                    throw new ValidationException("El nombre y las horas tienen que estar llenos");
                }

                $datos = [
                    'nombre_falta' => trim($_POST['nombre_falta']),
                    'descripcion' => trim($_POST['descripcion']),
                    'horas_sancion' => (int)$_POST['horas_sancion']
                ];

                if($this->multaModel->home($id)){
                    if($this->multaModel->update($id, $datos)){
                        $_SESSION['success'] = 'Multa modificada correctamente.';
                        header('Location: ' . URL_PROJECT . 'index.php?url=multas/index');
                        exit;
                    }
                }else{
                    throw new ValidationException('No se encontro esa multa');
                }
            }
            require_once dirname(__DIR__, 2) . '/views/admin/multas/home.php';
        }catch(ValidationException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . URL_PROJECT . 'index.php?url=multas/index');
            exit;
        }catch(DatabaseException $e){
            die("Error técnico: " . $e->getMessage());
        }
    }

    public function delete($id){
        try{
            if($this->multaModel->home($id)){
                if($this->multaModel->delete($id)){
                    $_SESSION['success'] = 'Multa eliminada correctamente.';
                    header('Location: ' . URL_PROJECT . 'index.php?url=multas/index');
                    exit;
                }
            }else{
                throw new ValidationException('Esta multa no existe');
            }

        }catch(ValidationException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . URL_PROJECT . 'index.php?url=multas/index');
            exit;
        }catch(DatabaseException $e){
            die("Error técnico: " . $e->getMessage());
        }
    }
}