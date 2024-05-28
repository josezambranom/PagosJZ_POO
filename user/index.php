<?php

use App\Cuenta;
use App\Plataforma;
use App\Usuario;

require '../includes/app.php';
estaAutenticado();

$id = $_SESSION['id'];

$plataformas = Plataforma::all();
$cuentas = Cuenta::all();
$usuario = Usuario::find($id);

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h2>Mis Cuentas</h2>

    <table class="tabla">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Plataforma</th>
                <th>Precio</th>
                <th>Usuario</th>
                <th>Clave</th>
                <th>Perfil</th>
                <th>Pin</th>
                <th>Fecha de Compra</th>
                <th>Días Restantes</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cuentas as $cuenta): ?>
                <?php foreach ($plataformas as $plataforma): ?>
                    <?php if ($plataforma->id === $cuenta->plataformaid && $cuenta->usuarioid === $usuario->id): ?>
                        <?php
                            $diasRestantes = calcularDiasRestantes($cuenta->fecha, $cuenta->vigencia);
                        ?>
                        <tr>
                            <td><img class="imagen-tabla" src='/imagenes/<?php echo categoria($plataforma->categoria)?>/<?php echo $plataforma->imagen?>' alt="avatar"></td>
                            <td class="titulo"><?php echo $plataforma->plataforma ?></td>
                            <td><?php echo '$ ' . $plataforma->precio ?></td>
                            <td><?php echo $cuenta->usuario ?></td>
                            <td><?php echo $cuenta->clave ?></td>
                            <td><?php echo ($cuenta->perfil === '5') ? 'Cuenta Completa' :'Perfil ' . $cuenta->perfil ?></td>
                            <td><?php echo ($cuenta->pin) ? $cuenta->pin : 'No aplica'; ?></td>
                            <td><?php echo $cuenta->fecha ?></td>
                            <td><?php echo $diasRestantes ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php
incluirTemplate('footer');
?>
