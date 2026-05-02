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

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $sanciones = $_POST['sancion'] ?? [];
                if(empty($sanciones)){
                    throw new ValidationException('No se pueden enviar formularios vacios.');//Valida que el array no venga vacio
                }

                foreach($sanciones as $sancion => $datos){
                    $datos['id_alumno'] = trim($datos['id_alumno']);
                    $datos['alumno_matricula'] = trim($datos['alumno_matricula']); 
                    $datos['id_vigilante'] = trim($datos['id_vigilante']);
                    $datos['vigilante_matricula'] = trim($datos['vigilante_matricula']); 
                    $datos['codigo_falta_id'] = trim($datos['codigo_falta_id']);
                    $datos['observaciones'] = trim($datos['observaciones']);

                    if(empty($datos['alumno_matricula']) || empty($datos['vigilante_matricula'])){//Verifica que las matricuals no esten vacias 
                        $errores[] = 'La matriculas no pueden estar vacias ';//si estan vacias gaurda el error 
                        continue;//Si este error existe no vale la pena continuar con el resto asi que se salta al proximo cilo del foreach
                    }

                    $alumno = $this->usuariosModel->BuscarUsuario($datos['alumno_matricula'],$datos['id_alumno']);
                    //Busca al usaurio en la base de datos validando que su matricula pertenezca a su id 

                    if(!$alumno){
                        $errores[] = 'El alumno no existe';
                    }
                    
                    $vigilante = $this->usuariosModel->BuscarUsuario($datos['vigilante_matricula'], $datos['id_vigilante']);
                    //Busca al vigilante en la base de datos validando que su matriual pertenezca a su id 

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
                    throw new ValidationException('Se cuanta con lo siguientes errores: ' . implode(', ',  $errores));
                }

                $this->store($sanciones);
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
        try{
            foreach($sanciones  as $sancion){
                if(!$this->sancionModel->store($sancion)){
                    $_SESSION['error'] = 'Fallo al crear la sancion';
                    header('Location: ' . URL_PROJECT . 'index.php?url=sancion/index');
                    exit;
                }
            }

            $_SESSION['success'] = 'Sancion creada con exito';
            header('Location: ' . URL_PROJECT . 'index.php?url=sancion/index');
            exit;
        }catch(DatabaseException $e){
            die('Error técnico: ' . $e->getMessage());
        }
    }

    public function update(){
        
    }

    public function delete(int $id){
        try{
            // 1. Validar si el registro existe antes de intentar operar
            if(!$this->sancionModel->findById($id)){
                throw new ValidationException('La sancion que intentas eliminar no existe.');
            }

            // 2. Intentar la eliminación
            if(!$this->sancionModel->delete($id)){
                throw new DatabaseException('No se pudo completar la eliminación en la base de datos.');
            }
            
            $_SESSION['success'] = 'Sancion eliminada con exito';
            header('Location: ' . URL_PROJECT . 'index.php?url=sancion/index');
            exit;

        }catch(ValidationException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . URL_PROJECT . 'index.php?url=sancion/index');
            exit;
        }catch(DatabaseException $e){
            die('Error técnico: ' . $e->getMessage());
        }
    }


    

}