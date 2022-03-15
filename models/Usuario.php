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
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';        
    }

    //Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'el nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'el apellido es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'el email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'el password del cliente es obligatorio';
        }
        if(strlen($this->password) <6 ){
            self::$alertas['error'][] = 'el password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    //Revisa si el usuario existe
    public function existeUsuario(){
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        //debuguear($query);

        $resultado = self::$db->query($query);
        //debuguear($resultado);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya esta registrado';
        }
        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }
}