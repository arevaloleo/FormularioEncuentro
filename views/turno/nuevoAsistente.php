
<div>


    <h3>Reserva turno para la reunion</h3>
    <p>Por disposición del COE no podrán ingresar al auditorio
        personas menores de 10 años y mayores de 60 años.
        Al llenar este formulario yo declaro no tener ningún síntoma compatible con COVID-19
        ni haber estado en contacto con alguna persona que los tuviera.</p>

    <form method="POST" action="<?=base_url?>turno/reservarTurno">
    <?php if(isset($_SESSION['asistente']) && $_SESSION['asistente'] == false) : ?>
        <div class="row">
            <div class="col-sm">
                <input type="text" name="nombre" placeholder="Nombre">
            </div>
            <div class="col-sm">
                <input type="text" name="apellido" placeholder="Apellido">
            </div>
            <div class="col-sm">
                <input type="number" name="DNI" placeholder="DNI" value="<?=$dni?>" disabled>
            </div>
            <div class="col-sm col2">
                <label for="">+54</label>
                <input type="number" name="ant" placeholder="351">
                <input type="number" name="desp" placeholder="numero">

            </div>
            <div class="col-sm col2 fech">
                <Label>Fecha de Nacimiento</Label>
                <input type="date" name="fecha_nacimiento">
            </div>
        </div>
        <label for="" class="lbl">Elegir Fecha y Hora</label>
            <div class="col-sm meet">
            <?php date_default_timezone_set("America/Argentina/Buenos_Aires");
                    setlocale(LC_ALL,""); 
                ?>
                
                <select name="meetDay" id="">
                <?php while($row = $fechas->fetch_assoc()):?>
                    <?php $fecha = explode('-',$row['fecha']); 
                     $valor = $row['id_fecha'] == 7 ? 'Domingo' : 'Sabado';
                    ?>
                    <option name="id_day" value="<?=$row['id_fecha']?>"><?php echo $valor;  ?> <?=$fecha[2]?>/<?=$fecha[1]?></option>
                    <?php endwhile;?>
                </select>
                <select name="meetHour" id="">
                    <option name="id_hour" value="18:00:00">18hs</option>
                </select>

            </div>
<?php else: ?>
    <label for="" class="lbl">Elegir Fecha y Hora</label>
            <div class="col-sm meet">
                <?php date_default_timezone_set("America/Argentina/Buenos_Aires");
                    setlocale(LC_ALL,""); 
                ?>
                
                <select name="meetDay" id="">
                <?php while($row = $fechas->fetch_assoc()):
                    $count = 0;
                    ?>
                    <?php $fecha = explode('-',$row['fecha']); 
                    $valor = $row['id_fecha'] == 7 ? 'Domingo' : 'Sabado';
                    ?>
                    <option name="id_day" value="<?=$row['id_fecha']?>"><?php echo $valor;  ?> <?=$fecha[2]?>/<?=$fecha[1]?></option>
                    <?php endwhile;?>
                </select>
                <select name="meetHour" id="">
                    <option name="id_hour" value="18:00:00">18hs</option>
                </select>


            </div>

<?php endif; ?>
               <div class="atention">
            <p>Sabado: Reunion de Jovenes/Adolescentes</p>
            <p>Domingo: Reunion General</p>
        </div>
        <label><input type="checkbox" id="cbox1" value="aceptado" required> Declaro que no estuve en contacto con ninguna persona con COVID-19</label>
        <input type="hidden" name="id_usuario" value="<?php echo $valor = $_SESSION['asistente'] == false ? '' : $asist->id_asist;?>">
        <input type="hidden" name="DNI_new" value="<?=$dni?>">
        <input type="submit" class="but button-ver" width="60px" value="Confirmar Asistencia">
    </form>
</div>
</div>
</div>
<script src="./public/js/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="./public/js/01.js" type="text/javascript"></script>
</body>

</html>