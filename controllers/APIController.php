<?php 


namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        //debuguear($servicios);
        echo json_encode($servicios);
    }

    public static function guardar() {
    //Almacena la cita y devuelve el id
     $cita = new Cita($_POST);
     $resultado = $cita->guardar(); 

     $id = $resultado['id'];
      
    //Almacena servicios con id cita   
    $idServicios = explode(",", $_POST['servicios']);
    
    foreach ($idServicios as $idServicio) {
        $args = [
            'citaId' => $id,
            'ServicioId' => $idServicio
        ];

        $citaServicio = new CitaServicio($args);
        $citaServicio->guardar();
    }

    //Retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);
  }
}