<?php if (isset($_SESSION['login'])) :
    $valor = $_SESSION['login'];
    if ($valor == 'admitido') :
?>

        <form action="<?=base_url?>login/buscar" method="POST">
            <select name="meetDay" id="">
                <?php while ($row = $fechas->fetch_assoc()) : ?>
                    <?php $fecha = explode('-', $row['fecha']);
                    $valor_dia = $row['id_fecha'] == 7 ? 'Domingo' : 'Sabado';
                    $valor_id = $row['id_fecha'];
                    ?>
                    <option name="id_day" value="<?= $row['id_fecha'] ?>"><?php echo $valor_dia;  ?> <?= $fecha[2] ?>/<?= $fecha[1] ?></option>
                <?php endwhile; ?>
            </select>
            <select name="meetHour" id="">
                <option name="id_hour" value="18:00:00">18hs</option>
            </select>
            <input type="submit" class="but button-ver" width="60px" value="Buscar">
        </form>
    <?php else :
        header("Location:" . base_url) ?>
    <?php endif; ?>
<?php else :
    header("Location:" . base_url) ?>
<?php endif; ?>