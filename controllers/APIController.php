<?php 


namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{

    public static function index(){
        $servicios = Servicio::all();

        echo json_encode($servicios);
 
    }
    public static function guardar(){
        //a;macena la XCita y devuelve el Id
        $cita = new Cita($_POST);  
        $resultado = $cita->guardar();

        //almacena las Cita el servicio
        $id = $resultado['id'];


        $idServicios = explode(",",$_POST['servicios']);
        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio

            ];
          $citaServicio = new CitaServicio($args);
          $citaServicio->guardar();
        }
        //retornamos una respuesta
      
        echo json_encode(['resultado' => $resultado]);

    }
    public static function eliminar(){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $id = $_POST['id'];

            $cita = Cita::find($id);
            $cita->eliminar();

            header('Location:' . $_SERVER['HTTP_REFERER']);

        }

    }

}