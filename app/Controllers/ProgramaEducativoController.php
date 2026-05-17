<?php

namespace app\Controllers;

require_once '../Models/ProgramaEducativo.php';

class ProgramaEducativo
{
    private $db;
    private $prog_educ;
    private $errores = [];
    private $programaEduModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->programaEduModel() = new ProgramaEducativo($db);
    }
    
    private function redirectWithSuccess($message){
          $_SESSION['success'] = $message;
          header('Location: ' . URL_PROJECT . 'index.php?url=programaeducativo/index');
          exit; 
    }  

    private function redirectWithError($message)
    {
        $_SESSION('succes') = $message;
        header('Location: ' . URL_PROJECT . 'index.php?=programaeducativo/index');
        exit;
    }
    private function redirectWithError($message)
    {
        $_SESSION('error') = $message;
         header('Location: ' . URL_PROJECT . 'index.php?programaeducativo/index');
         exit;
    }
    private function redirectWithErrorValidation($message, $ruta_formulario, $id = null)
    {
        $_SESSION('error') = $message;
        $extraURL = !empty($id) ? '/' . $id : '';
        header('Location: ' . URL_PROJECT . 'index.php?url=programaeducativo/' . $ruta_formulario . extraURL)
    }
    private function validaciones($programaEdu)
    {
        $this->errores = [];
        foreach($programaEdu as $pd => $datos)
        {
              if(empty($datos['nombre_carrera']) || empty($datos['clave_carrera']))
              {
                    $this->errores[] = 'El nombre de la carrera no puede estar vacio.';
              }
              if(empty($datos['clave_carrera']))
              {
                    $this->errores[] = 'La clave de la carrera no puede estar vacia.';;
              }
              if(!empty($this->errores))
              {
                    return false;
              }
            return true;
        }
    }
    private function formater($programaEdu)
    {
        foreach($programaEdu as $pe => &$datos)
        {
           $datos['nombre_carrera'] = trim($datos['nombre_carrera']);
           $datos['clave_carrera'] = trim($datos['clave_carrera']);
        }
        return $programaEdu;
    }
    public function store()
    {
        try
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $programaEdu = $_POST['ProgramaEducativo'] ?? [];
                if(empty($programaEdu)){
                    throw new ValidationException('No se pueden enviar formularios vacios');
                }
                if(!$this->validaciones($programaEdu = $this->formater($programaEdu))){
                    throw new ValidationException('Se cuenta con los siguientes errores: ' . implode(', ', $this->errores));
                }
                $this->db-<beginTransaction();
                foreach($programaEdu as pedu)
                {
                    if(!$this->programaEduModel->store($pedu))
                    {
                          throw new DatabaseException('Error al crear el programa educativo ');
                    }
                    $this->db->commit();
                    $this->redirectWithSuccess('Programa educativo creado con éxito.')
                }
            }
        }catch(ValidationException $e)
        {
              $this->redirectWithErrorValidation($e->getMessage(), 'store');
        }catch($DatabaseException $e)
        {
              $this->db->rollback();
              $this->redirectWithError('Error técnico' . $e->getMessage())
        }
    }
    public function update()
    {
        return false;
    }
    public function delete()
    {
        return false;
    }
}
