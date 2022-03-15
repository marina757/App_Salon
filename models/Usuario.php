<?php

namespace Model;

class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'password', 'email', 'admin', 'confirmado',
    'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $password;
    public $email;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';        
    }

    //Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'el nombre del cliente es obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'el apellido del cliente es obligatorio';
        }
        return self::$alertas;
    }
}