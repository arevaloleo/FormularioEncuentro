<a href="<?=base_url?>login/logout"><i class="fas fa-power-off"></i>Salir</a>
<div class="titulo">
<a href="<?= base_url ?>login/select" class="but button-ver">Volver</a>
<h2>Lista de asistentes</h2>

</div>
<p>Hasta el momento hay <?=$turn_fecha->num_rows?> inscriptos</p>
    <table>
    <tr>
        <th>Cod_turno</th>
        <th>Nombre y Apellido</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $turn_fecha->fetch_object()) : 
        $id_fech = $row->id_fecha;
    ?> 
    <tr>
        
        <td><p><?= $row->cod_turno ?></p></td>
        <td><p><?= $row->nombre ?> <?= $row->apellido ?></p></td>    
        <td>
            <a href="https://api.whatsapp.com/send?phone=549<?=$row->celular?>&text=Hola <?=$row->nombre?>" target="_blank" rel="nopenner noreferrer" class=""><i class="fab fa-whatsapp"></i></a>
            <a href="<?=base_url?>login/ver&id=<?=$row->id_miembro?>&id_fech=<?=$row->id_fecha?>"><i class="far fa-eye"></i></a>
        </td>

        </tr>
    <?php endwhile; ?>
    </table>
    <form action="<?=base_url?>login/generar" method="POST">
<input type="submit" name="generarPDF" class="but button-ver" value="Generar PDF">
<input type="hidden" name="id_fecha" value="<?=$id_fech?>">
</form>
    <a href="<?= base_url ?>login/generar&id=<?=$id_fech?>" class="but button-ver">Generar PDF</a>
