<a href="<?=base_url?>login/logout"><i class="fas fa-power-off"></i>Salir</a>
<div class="titulo">

</div>

    <table>
    <tr>
        <th>Nombre y Apellido</th>
        <th>DNI</th>
        <th>Fecha Nac</th>
        <th>Celular</th>
    </tr>
    <?php while ($row = $asistuan->fetch_object()) : ?> 
    <tr>

        <td><p><?= $row->nombre ?> <?= $row->apellido ?></p></td>    
        <td><p><?= $row->DNI?></p></td>
        <td><p><?= $row->fecha_nacimiento?></p></td> 
        <td><p><?= $row->celular?></p></td>   

        </tr>
    <?php endwhile; ?>
    </table>
    
 <form action="<?=base_url?>login/buscar" method="POST">
<input type="submit" class="but button-ver" value="Volver">
<input type="hidden" name="meetDay" value="<?=$_GET['id_fech']?>">
</form>