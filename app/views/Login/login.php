<!DOCTYPE html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Emergencia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="logo-container vertical-center">
            <img class="logo-container vertical-center" src="<?= APP_URL ?>/assets/img/portada.jpg">
        </div>
        <div class=" vertical-center text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form action="<?= APP_URL ?>/login/iniciarSesion" method="POST">
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger">
                                    <?php
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']); // Limpiar error después de mostrarlo
                                    ?>
                                </div>
                            <?php endif; ?>

                            <!-- Logo -->
                            <img class="mb-4" src="<?= APP_URL ?>/assets/img/logo1.jpg" width="130px">
                            <h1 class="h3 mb-3 fw-normal">Emergencia</h1>

                            <!-- Usuario -->
                            <div class="form-floating mb-3">
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="usuario" required>
                                <label for="nombre">Usuario</label>
                            </div>

                            <!-- Contraseña -->
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                <label for="password">Contraseña</label>
                            </div>

                            <!-- CSRF Token -->
                            <?php
                                if (empty($_SESSION['csrf_token'])) {
                                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                                }
                            ?>
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

                            <!-- Recordarme -->
                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" name="remember_me" value="1"> Recuérdame
                                </label>
                            </div>

                            <!-- Botón de envío -->
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>

                            <!-- Link de ayuda -->
                            <p class="mt-5 mb-3 text-muted">
                                <a id="forgot-password" href="#">Contactar con el administrador sobre alguna duda</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->
    <script src="<?= APP_URL ?>/assets/js/login.js"></script>
</body>
</html>