<fieldset>
    <legend>Información Personal</legend>

    <label for="nombre">Nombres</label>
    <input type="text" name="persona[nombre]" id="nombre" placeholder="Ingrese sus Nombres"
        value="<?php echo s($persona->nombre)?>" require>

    <label for="apellido">Apellidos</label>
    <input type="text" name="persona[apellido]" id="apellido" placeholder="Ingrese sus Apellidos"
        value="<?php echo s($persona->apellido)?>" require>

    <label for="genero">Género</label>
    <select name="persona[genero]" id="genero">
        <option <?php echo ($persona->genero === '') ? 'selected' : ''; ?> value="">-- Seleccione una opción --</option>
        <option <?php echo ($persona->genero === '1') ? 'selected' : ''; ?> value="<?php echo s($persona->genero = '1')?>">Hombre</option>
        <option <?php echo ($persona->genero === '0') ? 'selected' : ''; ?> value="<?php echo s($persona->genero = '0')?>">Mujer</option>
        <option <?php echo ($persona->genero === '2') ? 'selected' : ''; ?> value="<?php echo s($persona->genero = '2')?>">Otro</option>
    </select>

</fieldset>

<fieldset>
    <legend>Información Usuario</legend>

    <label for="email">Email</label>
    <input type="email" name="usuario[email]" id="email" placeholder="Ingrese su Email" 
        value="<?php echo s($usuario->email) ?>" require>

    <label for="clave">Clave</label>
    <input type="password" name="usuario[clave]" id="clave" placeholder="Ingrese su Contraseña"
        value="<?php echo s($usuario->clave) ?>" require>
</fieldset>