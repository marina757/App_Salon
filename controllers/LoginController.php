<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;


class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
           $alertas =  $auth->validarLogin();
            
        }

        $router->render('auth/login', [
            'alertas' => $alertas,
        ]);
    }

    public static function logout() {
        echo "desde logout";
    }

    public static function olvide(Router $router) {
        $router->render('auth/olvide-password', [

        ]);
        
    }

    public static function recuperar() {
        echo "desde recuperar";
    }

    public static function crear(Router $router) {

        $usuario = new Usuario($_POST);

        //Alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            
            //Revisar que alerta este vacio
            if (empty($alertas)) {
               //verificar que usuario no este registrado
               $resultado = $usuario->existeUsuario();

               if ($resultado->num_rows) {
                   $alertas = Usuario::getAlertas();
               }else {
                   //Hashear el password
                   $usuario->hashPassword();

                   //Generar un token unico
                   $usuario->crearToken();
                   

                   //Enviar el Email
                   $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                   
                   $email->enviarConfirmacion();

                   //Crear el usuario
                   $resultado = $usuario->guardar();
                   if ($resultado) {
                       header('Location: /mensaje');
                   }
                   //debuguear($usuario);
               }
            }
        }

       $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
       ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router) {
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);
        

        if (empty($usuario)) {
            //Mostrar mensaje de error
            Usuario::setAlerta('error', 'token no valido');
        }else {
            //Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            //debuguear($usuario);
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta compbada correctamente');
        }

        //Obtener alertas
        $alertas = Usuario::getAlertas();

        //Renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
       ]);
    }
}