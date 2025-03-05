<!DOCTYPE html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS Base y Variables -->
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/variables.css">
    
    <!-- Fuentes -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap">
    
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Estilos -->
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/components/sidebar.css">
    
    <!-- Estilos específicos -->
    <?php if (isset($pageCss) && !empty($pageCss)): ?>
        <?php foreach ($pageCss as $cssFile): ?>
            <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/<?= $cssFile ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <title>EMERGENCIA | HOSPITAL REGIONAL DE CAÑETE REZOLA</title>
</head>
<body>
    <!-- Scripts principales -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Sidebar Navigation -->
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="<?= APP_URL ?>/assets/img/logo1.jpg" alt="Logo">
            </div>
            <span class="logo_name">Emergencia</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="<?= APP_URL ?>/pacientes">
                        <i class="uil uil-file-search-alt"></i>
                        <span class="link-name">Consultar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= APP_URL ?>/triaje">
                        <i class="uil uil-stethoscope-alt"></i>
                        <span class="link-name">Triaje</span>
                    </a>
                </li>
                <li>
                    <a href="<?= APP_URL ?>/reportes">
                        <i class="uil uil-file-export"></i>
                        <span class="link-name">Reportes</span>
                    </a>
                </li>
                <li>
                    <a href="<?= APP_URL ?>/usuarios">
                        <i class="uil uil-user-nurse"></i>
                        <span class="link-name">Usuario</span>
                    </a>
                </li>
            </ul>

            <ul class="logout-mode">
                <li>
                    <a>
                        <i class="uil uil-signout"></i>
                        <form method="POST" action="<?= APP_URL ?>/login/cerrarSesion">
                            <button type="submit" class="cerrar-sesion"><span class="link-name">Salir</span></button>
                        </form>
                    </a>
                </li>
                <li class="mode">
                    <a>
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Modo oscuro</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="profile-image-container">
               <img src="<?= APP_URL ?>/assets/img/user.png" alt="Usuario">
            </div>
        </div>

        <script src="<?= APP_URL ?>/assets/js/Layouts/header.js"></script>