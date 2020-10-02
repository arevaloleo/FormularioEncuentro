
<?php 

require_once 'autoload.php';

require_once 'configs/db.php';
require_once 'helpers/utils.php';
require_once 'configs/parameters.php';
require_once 'views/layout/navegacion.php';

//conexion a la base de datos


function show_error(){
    $error = new errorController();
    $error->index();
}

/* ?controller=UsuarioController&action=crear */
if (isset($_GET['controller'])){
$nombre_controlador = $_GET['controller'].'Controller';
} elseif(!isset($_GET['controller'])&& !isset($_GET['action'])){
$nombre_controlador = controller_default;

}
else {
show_error();
exit;
}


if (class_exists($nombre_controlador)){
$controlador = new $nombre_controlador;

if (isset($_GET['action']) && method_exists($controlador,$_GET['action'])){
    $action = $_GET['action'];
    $controlador->$action();
} elseif(!isset($_GET['controller'])&& !isset($_GET['action'])){
    $default = action_default;
    $controlador->$default();
}
else {
    show_error();
}   
}

else {
show_error();
}

require_once 'views/layout/footer.php';