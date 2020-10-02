<?php
require_once 'models/turno.php';
require_once 'models/asistente.php';
require_once 'models/fecha.php';
session_start();

class TurnoController
{
    public function index()
    {
        require_once 'views/turno/index.php';
    }


    public function buscarTurno()
    {
        require_once 'views/turno/buscarTurno.php';
    }
    public function buscar(){
        if($_POST){
            $DNI = isset($_POST['DNI']) && $_POST['DNI'] != '' ? $_POST['DNI'] : false;
            if($DNI){
                $asistente = new Asistente();
                $asistente->setDNI($DNI);
                $asistuan = $asistente->asistDNI();
                if($asistuan){
                    $id_miembro = $asistuan->id_asist;
                    $turno = new Turno();
                    $turno->setId_miembro($id_miembro);
                    $turno_asistente = $turno->getThreeTurnoMiembro();
                    if($turno_asistente->num_rows != 0){
                        $_SESSION['turno'] = 'tiene';
                        require_once 'views/turno/mostrarTurnos.php';
                    }
                    else{
                        $_SESSION['turno'] = 'no tiene';
                        require_once 'views/turno/mostrarTurnos.php';
                    }
                }
                else{
                    header("location:" . base_url . 'turno/buscar&e="error"');
                }
            }
            else{
                header("location:" . base_url . 'turno/buscar&e="error"');
            }
        }
        else{
            header("location:" . base_url . 'turno/buscarTurno&e="vacio"');
        }
    }

    public function cancelar()
    {
        require_once 'views/turno/cancelar.php';
    }

    public function cancelando(){
        if(isset($_POST) && $_POST['cod_turno']){
            $cod_turno = isset($_POST['cod_turno']) && $_POST['cod_turno'] != '' ? $_POST['cod_turno'] : false;
            if($cod_turno){
                
                //verificar si existe ese codigo de turno
                $turno = new Turno();
                $turno->setCod_turno($cod_turno);
                $exist = $turno->getExistCodTurno();
                if($exist){
                    $id_turno = $exist->id_turno;
                    $turno->setId_turno($id_turno);
                    $turno->setCod_turno($cod_turno);
                    $turno->setCancelado(1);
                    $cancelo = $turno->cancelarTurno();
                    if($cancelo) {
                        require_once('views/turno/cancelado.php');
                    }
                    else{
                        header("Location:".base_url.'turno/cancelar&e="inesp"');
                    }

                }
                else{
                    header("Location:".base_url.'turno/cancelar&e="error"');
                }
            }
        }
        else {
            header("Location:".base_url.'turno/cancelar&e="vacio"');
        }
    }

    public function reservarTurno()
    {
        if (isset($_POST) && isset($_SESSION['asistente'])) {


            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $DNI = isset($_POST['DNI_new']) ? $_POST['DNI_new'] : false;
            $ant = isset($_POST['ant']) ? $_POST['ant'] : false;
            $desp = isset($_POST['desp']) ? $_POST['desp'] : false;
            $celular = $ant . $desp;
            $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : false;
            $meetDay = isset($_POST['meetDay']) ? $_POST['meetDay'] : false;
            $meetHour = isset($_POST['meetHour']) ? $_POST['meetHour'] : false;
            $id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : false;
            
            

            if ($nombre && $apellido && $DNI && $fecha_nacimiento && $meetDay && $meetHour) {
                echo "si anda";
                // nuevo asistente
                $asistente = new Asistente();
                $asistente->setDNI($DNI);
                $asistente->setNombre($nombre);
                $asistente->setApellido($apellido);
                $asistente->setCelular($celular);
                $asistente->setFecha_nacimiento($fecha_nacimiento);
                $inserto = $asistente->setAsistente();

                $asist = new Asistente();
                $asist->setDNI($DNI);
                $asistuan = $asist->asistDNI(); //false

                //consultar fecha para rellenar turno
                $fecha = new Fecha();
                $fecha->setId_fecha($meetDay);
                
                $fech = $fecha->getOneFechaID();

                    
                if ($fech && $asistuan) {
                    $turno = new Turno();
                    $id_miembro = $asistuan->id_asist;
                    $id_fecha = $fech->id_fecha;
                    $turno->setDni($DNI);
                    $turno->setId_miembro($id_miembro);
                    $turno->setId_fecha($id_fecha);
                    $cant = $turno->getCantidadTurnoFecha();

                
                    if ($cant) {
                        $insert = $turno->setTurno();
                        if ($insert) {
                            $_SESSION['disponible'] = true;
                            $turno_asistente = $turno->getOneTurnoMiembroIdFech();
                            require_once 'views/turno/turnoGenerado.php';
                        } else {
                            echo "No se pudo insertar";
                            header("Location: " . base_url); 
                        }
                    } else {
                        echo "La cantidad de miembros es alta";
                        $_SESSION['disponible'] = false;
                    }
                } else {
                    header("Location: " . base_url);
                }
            } elseif ($DNI && $meetHour && $meetDay && $id_usuario) {

                //consultar fecha para rellenar turno
                $fecha = new Fecha();
                $fecha->setId_fecha($meetDay);
                $fech = $fecha->getOneFechaID();
                $asist = new Asistente();
                $asist->setDNI($DNI);
                $asistuan = $asist->asistDNI();



                if ($fech && $asistuan) {
                    $turno = new Turno();
                
                    $id_fecha = $fech->id_fecha;
                    $turno->setDni($DNI);
                    $turno->setId_miembro($id_usuario);
                    $turno->setId_fecha($id_fecha);
                    $tiene_turno = $turno->getOneTurnoFech(); //tiene turno en esa fecha

                    if($tiene_turno == false){
                        header("location:".base_url.'turno/index&id="tiene"');

                    }
                    else{
                        $cant = $turno->getCantidadTurnoFecha();
                        if ($cant) {
                            $insert = $turno->setTurno();
    
                            if ($insert) {
                                $_SESSION['disponible'] = true;
                                $turno_asistente = $turno->getOneTurnoMiembroIdFech();
                                require_once 'views/turno/turnoGenerado.php';
                            } else {
                                header("Location: " . base_url); 
                            }
                        } else {
                            
                            $_SESSION['disponible'] = false;
                        }
                    }

                } 
                else{
                    header("location:".base_url.'turno/index&e="error"');
                }


            }
            else {
            }
        } else {
            echo "error variable post";
            header("Location: " . base_url); 
        }
        unset($_SESSION['asistente']);

        
    }
}
