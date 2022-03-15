<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;


class LoginController {
    public static function login(Router $router) {
        $router->render('auth/login');
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
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $usuario->sincronizar($_POST);
        }

       $router->render('auth/crear-cuenta', [
            'usuario' => $usuario
       ]);
    }
}