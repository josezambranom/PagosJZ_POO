<?php

use App\Usuario;

    require 'includes/app.php';

    $token = $_GET['token'];
    $col = "token";

    $usuario = Usuario::findcond($col, $token);

    debugear($usuario);

?>