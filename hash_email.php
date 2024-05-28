<?php

use App\Usuario;

    require 'includes/app.php';

    $token = $_GET['token'] ?? false;

    $usuario="";

    if ($token) 
    {
        $usuario = Usuario::findcond('token', $token);
        
        $usuario->confirmado = '1';
        $usuario->token = '';

        $usuario->guardar();

        header('Location: /login.php?result=5');
    } else {
        header('Location: /');
    }

?>