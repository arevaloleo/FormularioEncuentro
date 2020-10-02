<?php 
require_once 'models/login.php';
require_once 'models/fecha.php';
require_once 'models/turno.php';
require_once 'models/asistente.php';
require_once 'fpdf/fpdf.php';
session_start();
class LoginController{
    public function index(){
        require_once 'views/login/inicio.php';
    }

    public function log(){
        if(isset($_POST)){
            $user = isset($_POST['user']) && $_POST['user'] != '' ? $_POST['user'] : false;
            $clave = isset($_POST['clave']) && $_POST['clave'] != '' ? $_POST['clave'] : false;

            if($user && $clave){
                $login = new Login();
                $login->setUsuario($user);
                $login->setClave($clave);
                $log = $login->login();
                if($log){
                    $_SESSION['login'] = 'admitido';
                    header("Location:".base_url.'login/select');
                }
                else{
                    header("location:".base_url.'login/index?e=incor');
                }
            }
            else{
                header("location:".base_url.'login/index?e=vacio');
            }

        }
        
        
    }
    public function select(){
        Utils::isAdmin();
        $fecha = new Fecha();
        $fechas = $fecha->getCantFecha();
        require_once 'views/login/listaAsistentes.php';
    }
    public function buscar(){
        if(isset($_POST) || isset($_SESSION['meetDay'])){

            $_SESSION['meetDay'] = isset($_POST['meetDay']) && $_POST['meetDay'] != '' ? $_POST['meetDay'] : false;

            if($_SESSION['meetDay']){
                $meetDay = $_SESSION['meetDay'];
                $turno = new Turno();
                $turno->setId_fecha($meetDay);
                $turn_fecha = $turno->getTurnoFechAsist();
                if($turn_fecha->num_rows!=0){
                    require_once 'views/login/mostrarTurnos.php';
                }
                else{
                    header("location:".base_url.'login/index?e=vacieo');
                }
            }
            else{
                header("location:".base_url.'login/index?e=nothing');
            }
        }
    }

    public function logout(){
        $log = new Login();
        $cerro = $log->logout();
        if($cerro){
            header("location:".base_url.'login/index?e=close');
        }
    }

    public function ver(){
    Utils::isAdmin();
        if(isset($_GET['id'])){
            $id_miembro = isset($_GET['id']) && $_GET['id'] != '' ? $_GET['id']: false ;

            if($id_miembro){
                $asistente = new Asistente();
                $asistente->setId_asist($id_miembro);
                $asistuan = $asistente->asistID();
                require_once 'views/login/verMiembro.php';
            }
        }
    }
        public function generar(){
    Utils::isAdmin();
    if(isset($_GET)){
       $id_fecha = isset($_GET['id']) && $_GET['id'] != '' ? $_GET['id'] : false;
       if($id_fecha){
                $turno = new Turno();
                $turno->setId_fecha($id_fecha);
                $turn_fecha = $turno->getTurnoFechAsist();
                if($turn_fecha->num_rows!=0){
                    require_once 'views/login/generarPDF.php';
                }
                else{
                    header("location:".base_url.'login/index?e=vacieo');
                }
       }
           
       }
        
    }
    
    
    }
    

