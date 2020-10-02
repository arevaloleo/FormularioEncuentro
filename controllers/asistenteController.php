<?php
require_once 'models/asistente.php';
require_once 'models/fecha.php';
session_start();

class AsistenteController
{

    public function index()
    {
        if (isset($_POST)) {
            $dni = isset($_POST['DNI']) || $_POST['DNI'] != 1 || $_POST['DNI'] != ""  ? $_POST['DNI'] : false;
            if ($dni) {
                $asistente = new Asistente();
                $asistente->setDNI($dni);
                $asist = $asistente->asistDNI();
                if ($asist) {
                    $_SESSION['asistente'] = true;
                } else {
                    $_SESSION['asistente'] = false;
                }
                $fecha = new Fecha();
                $fechas = $fecha->getCantFecha();
 /*                while($row = $fechas->fetch_assoc()){
                    echo $row['id_fecha'] ."<br>";
                } */
                require_once 'views/turno/nuevoAsistente.php';
            } else {
                header("location:" . base_url . 'turno/index&e="vacio"');
            }
        } else {
            echo "No existe la variable post";
        }
    }
}
