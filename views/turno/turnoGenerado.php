<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iglesia Encuentro con Dios</title>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
</head>
<div class="container text-center">


    <?php
    if (isset($_SESSION['disponible']) && $_SESSION['disponible']) {
        require './phpqrcode/qrlib.php';

        $dir = './temp/';
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $filename = $dir .  $turno_asistente->img;

        $tam = 10;
        $level = 'M';
        $frameSize = 3;
        $contenido = 'Nombre: ' . $asistuan->nombre . ' Apellido: ' . $asistuan->apellido . ' DNI: ' . $asistuan->DNI . ' 
Fecha:' . $fech->fecha . ' Hora: ' . $fech->hora;

        QRcode::png($contenido, $filename, $level, $tam, $frameSize); ?>

            <div class="mi-turno">
                <p>Acá esta tu codigo para acceder a la reunion.</p>
                <p>Te pedimos por favor que hagas una captura de pantalla para presentarlo en el ingreso a la reunion</p>
                <h3 class="date">Tus Datos: </h3>
                <p>Apellido y nombre:</br> <?= $asistuan->nombre ?> <?= $asistuan->apellido ?></p>

                <div class="turn">
                    <p>Codigo de Ingreso: <?= $turno_asistente->cod_turno ?></p>
                    <img src="<?= base_url ?>temp/<?= $turno_asistente->img ?>" alt="<?= $turno_asistente->img ?>">
                </div>


            </div>






    <?php } else {
        echo "<p>No hay mas turnos disponibles</p>";
    }
    ?>
</div>
</div>
</div>