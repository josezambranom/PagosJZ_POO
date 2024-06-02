<fieldset>
    <legend>Información Cuenta</legend>

    <label for="cuenta">Usuario</label>
    <input type="text" name="cuenta[usuario]" id="cuenta" placeholder="Ingrese el usuario de la cuenta"
        value="<?php echo s($cuenta->usuario)?>" maxlength="45" require>

    <label for="clave">Clave</label>
    <input type="text" name="cuenta[clave]" id="clave" placeholder="Ingrese la clave de la cuenta"
        value="<?php echo s($cuenta->clave)?>" maxlength="45" require>

    <?php if ($cuenta->pin) { ?>
        <label for="pin">Pin</label>
        <input type="number" name="cuenta[pin]" id="pin" placeholder="Ingrese el pin de la cuenta"
            value="<?php echo s($cuenta->pin)?>" maxlength="45" require>
    <?php } ?>

    <label for="perfil">Perfil</label>
    <select name="cuenta[perfil]" id="perfil">
        <option selected value="">-- Seleccione una opción --</option>
        <option <?php echo ($cuenta->perfil === '1') ? 'selected' : ''; ?> value="1">Perfil 1</option>
        <option <?php echo ($cuenta->perfil === '2') ? 'selected' : ''; ?> value="2">Perfil 2</option>
        <option <?php echo ($cuenta->perfil === '3') ? 'selected' : ''; ?> value="3">Perfil 3</option>
        <option <?php echo ($cuenta->perfil === '4') ? 'selected' : ''; ?> value="4">Perfil 4</option>
        <option <?php echo ($cuenta->perfil === '5') ? 'selected' : ''; ?> value="5">Todos</option>
    </select>

    <label for="fecha">Fecha Inicio</label>
    <input type="date" name="cuenta[fecha]" id="fecha"
        value="<?php echo s($cuenta->fecha)?>" require>

    <label for="vigencia">Vigencia</label>
    <select name="cuenta[vigencia]" id="vigencia">
        <option selected value="">-- Seleccione una opción --</option>
        <option <?php echo ($cuenta->vigencia === '30') ? 'selected' : ''; ?> value="30">1 Mes</option>
        <option <?php echo ($cuenta->vigencia === '60') ? 'selected' : ''; ?> value="60">2 Meses</option>
        <option <?php echo ($cuenta->vigencia === '90') ? 'selected' : ''; ?> value="90">3 Meses</option>
        <option <?php echo ($cuenta->vigencia === '180') ? 'selected' : ''; ?> value="180">6 Meses</option>
        <option <?php echo ($cuenta->vigencia === '360') ? 'selected' : ''; ?> value="360">12 Meses</option>
    </select>
</fieldset>

<fieldset>
    <legend>Información Plataforma</legend>

    <label for="plataformaid">Plataforma</label>
    <select name="cuenta[plataformaid]" id="plataformaid">
        <option selected value="">-- Seleccione una opción --</option>
        <?php foreach ($plataformas as $plataforma): ?>
            <option <?php echo ($cuenta->plataformaid === $plataforma->id) ? 'selected' : ''; ?>
                value="<?php echo s($plataforma->id) ?>"><?php echo $plataforma->plataforma ?>
            </option>
        <?php endforeach; ?>
    </select>

</fieldset>
<?php if ($cuenta->usuarioid) { ?>
    <fieldset>
        <legend>Información Usuario</legend>
        
        <label for="usuarioid">Usuario</label>
        <select name="cuenta[usuarioid]" id="usuarioid">
            <option selected value="">-- Seleccione una opción --</option>
            <?php foreach ($usuarios as $usuario): 
                //$tipouser = idTipoUsuario($usuario->tipousuario);
                //if ($tipouser === 'Administrador') continue; 
                ?>
                <option <?php echo ($usuario->id === $cuenta->usuarioid) ? 'selected' : ''; ?>
                    value="<?php echo s($usuario->id) ?>">
                    <?php 
                        foreach ($personas as $persona) {
                            if ($usuario->personaid === $persona->id) {
                                echo $persona->nombre 
                                . " " . $persona->apellido;
                            }
                        }
                    ?>
                </option>
            <?php endforeach; ?>
        </select>
        
    </fieldset>
<?php } ?>