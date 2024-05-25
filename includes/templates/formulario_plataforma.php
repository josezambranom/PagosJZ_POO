<fieldset>
    <legend>Información Plataforma</legend>

    <label for="plataforma">Plataforma</label>
    <input type="text" name="plataforma[plataforma]" id="plataforma" placeholder="Ingrese nombre de Plataforma"
        value="<?php echo s($plataforma->plataforma)?>" maxlength="45" require>

    <label for="precio">Precio</label>
    <input type="decimal" name="plataforma[precio]" id="precio" placeholder="Ingrese precio de plataforma"
        value="<?php echo s($plataforma->precio)?>" maxlength="45" require>

    <label for="estado">Estado</label>
    <select name="plataforma[estado]" id="estado">
        <option selected value="">-- Seleccione una opción --</option>
        <option <?php echo ($plataforma->estado === '1') ? 'selected' : ''; ?> value="1">Disponible</option>
        <option <?php echo ($plataforma->estado === '0') ? 'selected' : ''; ?> value="0">Agotado</option>
    </select>

    <label for="imagen">Imagen</label>
    <input type="file" name="plataforma[imagen]" id="imagen" accept="image/jpeg, image/png" require>

    <?php if ($plataforma->imagen): ?> 
        <img src="/imagenes/<?php echo $plataforma->imagen; ?>" class="imagen-smoll">
    <?php endif;?>


</fieldset>

<fieldset>
    <legend>Información Usuario</legend>
    
    <label for="usuarioid">Usuario</label>
    <select name="plataforma[usuarioid]" id="usuarioid">
        <option selected value="">-- Seleccione una opción --</option>
        <?php foreach ($usuarios as $usuario): ?>
            <option <?php echo ($usuario->id === $plataforma->usuarioid) ? 'selected' : ''; ?>
                value="<?php echo s($usuario->id)?>">
                <?php 
                    foreach ($personas as $persona) {
                        echo ($usuario->personaid === $persona->id) ? $persona->nombre 
                        . " " . $persona->apellido . " - " . idTipoUsuario($usuario->tipousuario) : '';
                    }
                ?>
            </option>
        <?php endforeach; ?>
    </select>
    
</fieldset>