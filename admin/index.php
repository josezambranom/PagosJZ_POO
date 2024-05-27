<?php
    use App\Plataforma;
    use App\Persona;
    use App\Cuenta;
    use App\Usuario;

    require '../includes/app.php';

    estaAutenticado();
    $plataformas = Plataforma::all();
    $personas = Persona::all();
    $usuarios = Usuario::all();
    $cuentas = Cuenta::all();

    $resultado = $_GET['result'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validar id
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo)){
                // Compara lo que se va a eliminar
                if($tipo === "plataforma"){
                    $plataforma = Plataforma::find($id);
                    ($plataforma->eliminar()) ? header('Location: /admin?result=3') : header('Location: /admin?result=4');     
                } elseif($tipo === "cuenta") {
                    $cuenta = Cuenta::find($id);
                    ($cuenta->eliminar()) ? header('Location: /admin?result=3') : header('Location: /admin?result=4');       
                }
            }      
        }
    }
    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h2>Panel de Administración</h2>
    <?php
        $mensaje = mostrarMensaje(intval($resultado));
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php } ?>
    
    <a class="boton-verde" href="/admin/plataforma/crear.php">Añadir Plataforma</a>
    <a class="boton-verde" href="/admin/cuenta/crear.php">Añadir Cuenta</a>

    <h2>Plataformas</h2>

    <table class="tabla ">
        <thead>
            <tr>
                <th>Id</th>
                <th>Imagen</th>
                <th>Plataforma</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($plataformas as $plataforma):?>
            <tr>
                <td><?php echo $plataforma->id ?></td>
                <td><img class="imagen-tabla" src='/imagenes/<?php echo $plataforma->imagen?>'></td>
                <td class="titulo"><?php echo $plataforma->plataforma ?></td>
                <td><?php echo '$ ' . $plataforma->precio ?></td>
                <td><?php echo ($plataforma->estado === '1') ? 'Disponible' : 'Agotado' ?></td>
                <td><?php foreach ($usuarios as $usuario){
                    if($plataforma->usuarioid === $usuario->id) {
                        foreach ($personas as $persona) {
                            echo ($usuario->personaid === $persona->id) ? $persona->nombre 
                            . " " . $persona->apellido . " - " . idTipoUsuario($usuario->tipousuario) : '';
                        }
                    }
                }?></td>
                <td class="accion">
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $plataforma->id; ?>">
                        <input type="hidden" name="tipo" value="plataforma">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/plataforma/actualizar.php?id=<?php echo $plataforma->id ?>" 
                    class="boton-verde-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Cuentas</h2>
    <table class="tabla">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Clave</th>
                <th>Perfil</th>
                <th>Usuario</th>
                <th>Fecha de Compra</th>
                <th>Vigencia</th>
                <th>Plataforma</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cuentas as $cuenta):?>
            <tr>
                <td><?php echo $cuenta->id ?></td>
                <td class="titulo"><?php echo $cuenta->usuario ?></td>
                <td><?php echo $cuenta->clave ?></td>
                <td><?php echo ($cuenta->perfil === '5') ? 'Cuenta Completa' :'Perfil ' . $cuenta->perfil ?></td>
                <td><?php foreach ($usuarios as $usuario){
                    if($cuenta->usuarioid === $usuario->id) {
                        foreach ($personas as $persona) {
                            echo ($usuario->personaid === $persona->id) ? $persona->nombre 
                            . " " . $persona->apellido . " - " . idTipoUsuario($usuario->tipousuario) : '';
                        }
                    }
                }?></td>
                <td><?php echo $cuenta->fecha ?></td>
                <td><?php echo $cuenta->vigencia ?></td>
                <td><?php 
                    foreach ($plataformas as $p) {
                        if($p->id === $cuenta->plataformaid){
                            echo $p->plataforma;
                        }
                    }
                ?></td>
                <td class="accion">
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $cuenta->id; ?>">
                        <input type="hidden" name="tipo" value="cuenta">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/cuenta/actualizar.php?id=<?php echo $cuenta->id ?>" 
                    class="boton-verde-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<?php
    incluirTemplate('footer');
?>