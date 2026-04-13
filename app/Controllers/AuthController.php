<?php

use App\Exceptions\DatabaseException;
use App\Exceptions\ValidationException;

require_once '../app/Models/Usuarios.php';

class AuthController{
    
    private $userModel;

    public function __construct($db){
        $this->userModel = new Usuarios($db);
    }

    public function register(){
        try{
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
                // 1. Primero capturamos las contraseñas en texto plano para comparar
                $password_plain = trim($_POST['password']);
                $password_confirm = trim($_POST['password_confirm']);

                // 2. Validamos que coincidan ANTES de hashear
                if($password_plain !== $password_confirm){
                    throw new ValidationException('Las contraceñas no coinciden');
                }

                $datos = [
                    'matricula'          => trim($_POST['matricula']),
                    'nombre'             => trim($_POST['nombre']),
                    'apellido_paterno'   => trim($_POST['apellido_paterno']),
                    'apellido_materno'   => trim($_POST['apellido_materno']), 
                    'correo_electronico' => trim($_POST['correo_electronico']), 
                    'password'           => password_hash($password_plain, PASSWORD_DEFAULT),
                    'rol_id'             => (int)$_POST['rol_id']
                ];

                if($this->userModel->Register($datos)){
                    $_SESSION['success'] = 'Registro exitoso, inicia sesión';
                    header('Location: ' . URL_PROJECT . 'index.php?url=auth/login');
                    exit;
                } else {
                    throw new DatabaseException('Error en Auth de BD.');
                }

            } else {
                require_once dirname(__DIR__, 2) . '/views/auth/registro.php';
            }
        }catch(ValidationException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . URL_PROJECT . 'index.php?url=auth/register');
            exit;
        }catch(DatabaseException $e){
            die('Error técnico: ' . $e->getMessage());
        }
    }

    public function login(){
        try{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                $usuario = $this->userModel->ObtenerPorEmail($email);

                if($usuario){
                    if(password_verify($password, $usuario->password)){
                        //session_start();
                        $_SESSION['user_id'] = $usuario->id;
                        $_SESSION['user_name'] = $usuario->nombre;
                        $_SESSION['user_role'] = $usuario->rol_id;

                        header('Location:' . URL_PROJECT . 'index.php?url=admin/dashboard');
                        exit;
                    }else{
                        throw new ValidationException('Contraceña incorrecta');
                    }
                }else{
                    throw new ValidationException('El usuario no existe');
                }
            }else{
                require_once dirname(__DIR__, 2) . '/views/auth/login.php';
            }
        }catch(ValidationException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . URL_PROJECT . 'index.php?url=auth/login');
            exit;
        }catch(DatabaseException $e){
            die('Error técnico: ' . $e->getMessage());           
        }
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        header('Location:' . URL_PROJECT . 'index.php?url=home/index');
        exit;
    }

}