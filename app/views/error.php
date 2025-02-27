<!DOCTYPE html>
<html>
<head>
    <title><?php echo $data['title'];?></title>
</head>
<body>
    <h1>Welcome to the Error Page</h1>

    <p><?php echo $_SESSION['error'];?></p>
    
    <?php unset($_SESSION['error']); // Limpiar el mensaje después de mostrarlo
    ?>

</body>
</html>
