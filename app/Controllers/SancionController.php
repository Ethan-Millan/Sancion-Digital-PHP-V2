<?php

use App\Exceptions\ValidationException;
use App\Exceptions\DatabaseException;

require_once '../app/Models/Sancion.php';
require_once '../app/Models/Multas.php';
require_once '../app/Models/Usuarios.php';

class SancionController{
    
    private $sancionModel;
    private $multaModel;
    private $usuariosModel;

    public function __construct($db){
        $this->sancionModel = new Sancion($db);
        $this->multaModel = new Multas($db);
        $this->usuariosModel = new Usuarios($db);
    }

    public function store_validation(){
        try{
            $errores = [];
            $sanciones = $_POST['sancion'];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(empty($sanciones)){
                    throw new ValidationException('No se pueden enviar formularios vacios.');
                }

                foreach($sanciones as $sancion => $datos){
                    if(empty($datos['alumno_matricula']) || empty($datos['vigilante_matricula'])){
                        $errores[] = 'La matriculas no pueden estar vacias ';
                    }

                    $alumno = $this->usuariosModel->BuscarUsuario($datos['alumno_matricula'],$datos['id_alumno']);

                    if(!$alumno){
                        $errores[] = 'El alumno no existe';
                    }
                    
                    $vigilante = $this->usuariosModel->BuscarUsuario($datos['vigilante_matricula'], $datos['id_vigilante']);

                    if(!$vigilante){
                        $errores[] = 'El vigilante no existe';
                    }
                    
                    if(!$this->multaModel->BuscarMulta($datos['codigo_falta_id'])){
                        $errores[] = 'La multa no existe';
                    }

                    if(empty($datos['observaciones'])){
                        $errores[] = 'Las observaciones no pueden estar vacias';
                    }

                }

                if(!empty($errores)){
                    throw new ValidationException('Se cuanta con lo siguientes errores: ' . $errores);
                }

                Store($sanciones);
            }
        }catch(ValidationException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . URL_PROJECT . 'index.php?url=sancion/index');
            exit;
        }catch(DatabaseException $e){
            die('Error técnico: ' . $e->getMessage());
        }
    }

    private function store($sanciones){

    }

    public function update(){

    }

    public function delete(){

    }

}