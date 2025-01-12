<?php
    
    if(!isset($_SESSION)) {
        session_start();
    }

    $tipoid = $_SESSION['tipoid'] ?? false;

?>

<!DOCTYPE html>
<html lang="es" data-location="QUEVEDO">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="José Zambrano">
    <meta name="description" content="Tienda de Servicios de Entretenimiento">
    <title>Punto de Pagos JZ</title>
    <link rel="icon" type="img/logo-principal" href="build/img/logo-principal.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;600&family=Staatliches&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href= "/build/css/app.css">
</head>

<body>
    <header class="header">
        <a class="logo" href="/">
            <img class="logo__img" src="/build/img/logo-principal.webp" alt=logo-principal">
        </a>
        <nav class="navegacion">
        <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/index.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/">Inicio</a>
                <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/tienda.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/tienda.php">Tienda</a>            
            <?php if($tipoid === '0') {?>
                <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/user/index.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/user">Mis Cuentas</a>
                <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/perfil.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/perfil.php">Mi perfil</a>
                <a class="navegacion__enlace" href="/logout.php">Salir</a>
            <?php } elseif ($tipoid == '1') { ?>
                <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/index.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/admin">Panel</a>
                <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/perfil.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/perfil.php">Mi perfil</a>
                <a class="navegacion__enlace" href="/logout.php">Salir</a>
            <?php } else { ?> 
                <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/registro.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/registro.php">Registro</a>
                <a class="navegacion__enlace <?php echo ($_SERVER['SCRIPT_NAME'] === '/login.php') ? 'navegacion__enlace--activo' : ''; ?>" href="/login.php">Acceso</a>
            <?php } ?>
        </nav>
    </header>