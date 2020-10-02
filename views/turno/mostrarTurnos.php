<div class="title-turno">
    <h2>Listado de Turnos</h2>
    <p> Turno/turnos de: <?= $asistuan->nombre ?> <?= $asistuan->apellido ?></p>
    <p>DNI: <?= $asistuan->DNI ?></p>
</div>
<?php if (isset($_SESSION['turno']) && $_SESSION['turno'] == 'tiene') : ?>
    <div class="mis-turnos">
        <?php while ($turno = $turno_asistente->fetch_object()) : ?>
            <?php $fecha = explode('-', $turno->fecha);
            $hora = explode(':', $turno->hora);
            ?>
            <div class="mi-turno">
                <?php $valor = $turno->id_fecha == 7 || $turno->id_fecha == 6  ? 'Domingo' : 'Sabado'; ?>
                <p>Turno para el <?=$valor?> <?= $fecha[2] ?>/<?= $fecha[1] ?></p>
                <p>a las <?= $hora[0] ?>hs.</p>
                <div class="turn">
                    <p><?= $turno->cod_turno ?></p>
                    <img src="<?= base_url ?>temp/<?= $turno->img ?>" alt="">
                </div>
                <div class="botones">

                    <div class="btn2">
                        <a href="<?= base_url ?>turno/cancelar&id=<?= $turno->cod_turno ?>" class=" but button-cancel">Cancelar</a>
                    </div>

                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php else : ?>
    <h2>No tiene turnos programados</h2>
<?php endif; ?>