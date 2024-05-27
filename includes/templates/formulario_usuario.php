<fieldset>
    <legend>Información Personal</legend>

    <label for="nombre">Nombres</label>
    <input type="text" name="persona[nombre]" id="nombre" placeholder="Ingrese sus Nombres"
        value="<?php echo s($persona->nombre)?>" maxlength="45" require>

    <label for="apellido">Apellidos</label>
    <input type="text" name="persona[apellido]" id="apellido" placeholder="Ingrese sus Apellidos"
        value="<?php echo s($persona->apellido)?>" maxlength="45" require>

    <label for="genero">Género</label>
    <select name="persona[genero]" id="genero">
        <option selected value="">-- Seleccione una opción --</option>
        <option <?php echo ($persona->genero === '1') ? 'selected' : ''; ?> value="1">Hombre</option>
        <option <?php echo ($persona->genero === '0') ? 'selected' : ''; ?> value="0">Mujer</option>
        <option <?php echo ($persona->genero === '2') ? 'selected' : ''; ?> value="2">Otro</option>
    </select>

    <input type="hidden" name="usuario[]" value="">

</fieldset>