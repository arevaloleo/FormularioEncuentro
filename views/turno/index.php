
<div class="index">
    <?php if(isset($_GET['id'])): ?>
    <div class='deleted'>
        <p class='delete'>Usted ya tiene turno para la fecha seleccionada</p>
    <?php endif; ?>
</div>
    <?php if(isset($_GET['e'])){
        $valor_e= $_GET['e'];

        if(isset($_GET['e']) && $valor_e ='error'){
            echo "<div class='notEncont'>
                <p class=''>Campos vacios o ocurrio un error</p>
        
    </div>";
        }

    }
    ?>
    
    <h3>Reserva turno para la reunion</h3>
    <p>Por disposición del COE no podrán ingresar al auditorio
        personas menores de 10 años y mayores de 60 años.
        Al llenar este formulario yo declaro no tener ningún síntoma compatible con COVID-19
        ni haber estado en contacto con alguna persona que los tuviera.</p>
    <form action="<?= base_url ?>asistente/index" method="POST">
        <input type="number" class="inpt" placeholder="Ingrese su DNI" name="DNI">
        <input type="submit" class="but button-ver" value="Siguiente">
    </form>
</div>