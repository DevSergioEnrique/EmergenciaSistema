<!DOCTYPE html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
    
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>EMERGENCIA | HOSPITAL REGIONAL DE CAÑETE REZOLA</title>
    <style>
        button.cerrar-sesion {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            font: inherit;
            color: inherit;
            cursor: pointer; 
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="<?= APP_URL ?>/assets/img/logo1.jpg" alt="">
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
               <img src="<?= APP_URL ?>/assets/img/user.png" alt="">
            </div>
        </div>

        <script src="<?= APP_URL ?>/assets/js/Layouts/header.js"></script>