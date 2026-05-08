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
    private $errores = [];
    private $db;


    public function __construct($db){
        $this->db = $db;//Conexion a la BD

        $this->sancionModel = new Sancion($db);
        $this->multaModel = new Multas($db);
        $this->usuariosModel = new Usuarios($db);
    }

    private function redirectWithSuccess($message){//Aplicando DRY (Don't Repeat Yourself)
        $_SESSION['success'] = $message;
        header('Location: ' . URL_PROJECT . 'index.php?url=sancion/index');
        exit;
    }
    

    private function redirectWithError($message){//Aplicando DRY (Don't Repeat Yourself)
        $_SESSION['error'] = $message;
        header('Location: ' . URL_PROJECT . 'index.php?url=sancion/index');
        exit;
    }

    private function redirectWithErrorValidation($messages,$ruta_formulario, $id = null){// El id esta vacio por defecto para no afectar funcioenes como store o delete
        $_SESSION['error'] = $messages;
        
        $extraURL = !empty($id) ? '/' . $id : '';// se valida si $id esta vacio para retornar el id si no no 

        header('Location: ' . URL_PROJECT . 'index.php?url=sancion/' . $ruta_formulario . $extraURL);// se redirecciona con los parametros
        exit;
    }

    public function store(){
        try{

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $sanciones = $_POST['sancion'] ?? [];
                if(empty($sanciones)){
                    throw new ValidationException('No se pueden enviar formularios vacios.');//Valida que el array no venga vacio
                }

                if(!$this->validaciones($sanciones_format = $this->formatData($sanciones))){
                    throw new ValidationException('Se cuenta con los siguientes errores: ' . implode(', ',  $this->errores));
                }
                    
                $this->db->beginTransaction();//Se inicia la transaccion
                

                foreach($sanciones_format  as $sancion){
                    if(!$this->sancionModel->store($sancion)){
                        throw new DatabaseException('Error al crear la sancion en la base de datos.');
                    }
                }

                $this->db->commit();//Se hace el commit si todo salio bien en la bd 
                $this->redirectWithSuccess('Sancion creada con exito');
            }
        }catch(ValidationException $e){
            $this->redirectWithErrorValidation($e->getMessage(),'store');
        
        }catch(DatabaseException $e){
            $this->db->rollback();//Se hace un rollback si algo salio mal 
            $this->redirectWithError('Error técnico: ' . $e->getMessage());
        }
    }


    public function update(int $id){
        /*Se hace exactamente lo mismo que en store solo que se valida si la sancion ya existe, ademas de cambiar el store por el update*/
        try{

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $sanciones = $_POST['sancion'] ?? [];

                if(empty($sanciones)){
                    throw new ValidationException('No se pueden enviar formularios vacios.');
                }
                

                if(!$this->sancionModel->findById($id)){
                    throw new ValidationException('La sancion que intentas actualizar no existe.');
                }

                if(!$this->validaciones($sanciones_format = $this->formatData($sanciones))){
                    throw new ValidationException('Se cuenta con los siguientes errores: ' . implode(', ',  $this->errores));
                }
                    
                $this->db->beginTransaction();
                

                foreach($sanciones_format  as $sancion){
                    if(!$this->sancionModel->update($id,$sancion)){
                        throw new DatabaseException('Error al modificar la sancion en la base de datos.');
                    }
                }

                $this->db->commit();
                $this->redirectWithSuccess('Sancion modificada con exito');
            }


        }catch(ValidationException $e){
            $this->redirectWithErrorValidation($e->getMessage(), 'update', $id);

        }catch(DatabaseException $e){
            $this->db->rollback();
            $this->redirectWithError('Error técnico: ' . $e->getMessage());
        }
    
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
            
            $this->redirectWithSuccess('Sancion eliminada con exito');


        }catch(ValidationException $e){
            $this->redirectWithErrorValidation($e->getMessage(), 'delete');

        }catch(DatabaseException $e){
            $this->redirectWithError('Error técnico: ' . $e->getMessage());
        }
    }
    //FUNCION PARA DAR FORMATO A LOS DATOS 
    private function formatData($sanciones){
        foreach($sanciones as $sancion => &$datos){
            $datos['id_alumno'] = trim($datos['id_alumno']);
            $datos['alumno_matricula'] = trim($datos['alumno_matricula']); 
            $datos['id_vigilante'] = trim($datos['id_vigilante']);
            $datos['vigilante_matricula'] = trim($datos['vigilante_matricula']); 
            $datos['codigo_falta_id'] = trim($datos['codigo_falta_id']);
            $datos['observaciones'] = trim($datos['observaciones']);
        }
        return $sanciones;
    }
    
    //FUNCION PARA VALIDAR LOS DATOS 
    private function validaciones($sanciones){
        $this->errores = [];

        foreach($sanciones as $sancion => $datos){

            if(empty($datos['alumno_matricula']) || empty($datos['vigilante_matricula'])){//Verifica que las matricuals no esten vacias 
                $this->errores[] = 'La matriculas no pueden estar vacias ';//si estan vacias gaurda el error 
                continue;//Si este error existe no vale la pena continuar con el resto asi que se salta al proximo cilo del foreach
            }
            
            $involucrados = $this->usuariosModel->validarRolesYMatriculas(
                $datos['alumno_matricula'],
                3,
                $datos['vigilante_matricula'],
                2
            );

            if($involucrados['alumno_valido'] == 0){
                $this->errores[] = 'El alumno no existe' . $datos['alumno_matricula'];
            }

            if($involucrados['vigilante_valido'] == 0){
                $this->errores[] = 'El vigilante no existe' . $datos['vigilante_matricula'];
            }

            if(!$this->multaModel->BuscarMulta($datos['codigo_falta_id'])){
                $this->errores[] = 'La multa no existe';
            }                                                                                                             

            if(empty($datos['observaciones'])){
                $this->errores[] = 'Las observaciones no pueden estar vacias';
            }

        }

        if(!empty($this->errores)){
            return false;
        }
        
        return true;
        
    }

}