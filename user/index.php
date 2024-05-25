<?php

use App\Cuenta;
use App\Plataforma;

require '../includes/app.php';
incluirTemplate('header');
estaAutenticado();

$id = $_SESSION['id'];

$plataformas = Plataforma::all();
$cuentas = Cuenta::all();
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
                    <?php if ($plataforma->usuarioid === $id && $plataforma->id === $cuenta->plataformaid): ?>
                        <?php
                            $diasRestantes = calcularDiasRestantes($cuenta->fecha, $cuenta->vigencia);
                        ?>
                        <tr>
                            <td><img class="imagen-tabla" src="/imagenes/<?php echo $plataforma->imagen ?>" alt="Imagen de la plataforma"></td>
                            <td class="titulo"><?php echo $plataforma->plataforma ?></td>
                            <td><?php echo $plataforma->precio ?></td>
                            <td><?php echo $cuenta->usuario ?></td>
                            <td><?php echo $cuenta->clave ?></td>
                            <td><?php echo $cuenta->perfil ?></td>
                            <td><?php echo $cuenta->pin ?></td>
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
