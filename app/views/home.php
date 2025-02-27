<!DOCTYPE html>
<html>
<head>
    <title><?php echo $data['title'];?></title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    <h4>User: <?php echo $_SESSION['Usuario'];?></h4>
    <h4>User: <?php echo $_SESSION['Clave'];?></h4>
    <h4>Token: <?php echo $_SESSION['csrf_token'];?></h4>

    <form method="POST" action="<?= APP_URL ?>/login/cerrarSesion">
        <button type="submit">Cerrar Sesión</button>
    </form>

</body>
</html>
