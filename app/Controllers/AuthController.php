<?php

require_once '../app/Models/Usuarios.php';

class AuthController{
    
    private $userModel;

    public function __construct($db){
        $this->userModel = new Usuarios($db);
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // 1. Primero capturamos las contraseñas en texto plano para comparar
            $password_plain = trim($_POST['password']);
            $password_confirm = trim($_POST['password_confirm']);

            // 2. Validamos que coincidan ANTES de hashear
            if($password_plain !== $password_confirm){
                echo "Las contraseñas no coinciden";
                return;
            }

            // 3. Ahora sí armamos los datos (Fíjate en los CORCHETES [])
            $datos = [
                'matricula'          => trim($_POST['matricula']),
                'nombre'             => trim($_POST['nombre']),
                'apellido_paterno'   => trim($_POST['apellido_paterno']),
                'apellido_materno'   => trim($_POST['apellido_materno']), // Corregido () por []
                'correo_electronico' => trim($_POST['correo_electronico']), // Corregido () por []
                'password'           => password_hash($password_plain, PASSWORD_DEFAULT),
                'rol_id'             => 1
            ];

            if($this->userModel->Register($datos)){
                // Recuerda redirigir al Router, no al archivo directo
                header('Location: ' . URL_PROJECT . 'index.php?url=auth/login');
                exit;
            } else {
                echo "Error al registrar el usuario";
            }

        } else {
            require_once dirname(__DIR__, 2) . 'index.php?url=home/index';
        }
    }

    public function login(){
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
                    echo "la contraceña es incorrecta";
                }
            }else{
                echo "el usuario no existe";
            }
        }else{
            require_once dirname(__DIR__, 2) . 'index.php?url=home/index';
        }
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        header('Location:' . URL_PROJECT . 'index.php?url=home/index');
        exit;
    }

}