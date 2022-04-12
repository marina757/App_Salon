<?php


namespace Controllers;

use Model\AdminCita;
use MVC\Router;


class AdminController {
    public static function index(Router $router) {


        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if( !checkdate( $fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404'); 
        }

        

        //Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( clientes.nombre, ' ', clientes.apellido) as cliente, ";
        $consulta .= " clientes.email, clientes.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN clientes ";
        $consulta .= " ON citas.clienteId=clientes.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasservicios.ServicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCita::SQL($consulta);
      
        
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}