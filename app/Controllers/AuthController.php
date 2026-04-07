<?php

require_once 'app/Models/Usuarios.php';

class AuthController{
    
    private $userModel;

    public function __construct($db){
        $this->userModel = new Usuarios($db);
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = trim($_POST['email']);
            $password = ($_POST['password']);

            $usuario = $this->userModel->ObtenerPorEmail($email);

            if($usuario){
                if(password_verify($password, $usuario->password)){
                    session_start();
                    $_SESSION['user_id'] = $usuario->id;
                    $_SESSION['user_name'] = $usuario->nombre;
                    $_SESSION['user_role'] = $usuario->rol_id;

                    header('Location:' . URL_PROJECT . 'views/admin/dashboard.php');
                    exit;
                }else{
                    echo "la contraceña es incorrecta";
                }
            }else{
                echo "el usuario no existe";
            }
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location:' . URL_PROJECT . 'views/login.php');
        exit;
    }

}