
<?php 

    if(isset($_GET['id'])){
        $cod_turno = $_GET['id'];
        $valor = isset($_GET['id']) ? $cod_turno : '';
    }
    
    if(isset($_GET['e'])){
        $valor_e= $_GET['e'];

        if(isset($_GET['e']) && $valor_e ='error'){
            echo "<div class='notEncont'>
            <p class=''>No se ha encontrado el turno con ese numero</p>
        
    </div>";
        }
        elseif (isset($_GET['e']) && $valor_e='inesp'){
            echo "<div class='delete'>
            <p class=''>Error inesperado, vuelva a intentarlo</p>
        
    </div>";
        }
    }
?>


<form action="<?=base_url?>turno/cancelando" method="POST">
<p>Para cancelar el turno ingrese el codigo emitido al sacar el turno</p>
    <input type="text" name="cod_turno" class="inpt" value="<?php echo (isset($_GET['id']) ? $valor : '');?>"  placeholder="Ingrese codigo de turno">
    <input type="submit" class="but button-ver" value="Cancelar">
    <input type="hidden" name="r" value="buscar">

</form>

