<?php

namespace Model;

class Cita extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'clienteId'];

    public $id;
    public $fecha;
    public $hora;
    public $clienteId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->clienteId = $args['clienteId'] ?? '';
        
    }
}