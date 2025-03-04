<!DOCTYPE html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Bootstrap CSS Core - Solo componentes esenciales -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-utilities.min.css">
    
    <!-- Font Awesome Icons - Carga completa para asegurar funcionamiento -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Base Bootstrap Components - Cargados después del grid para evitar conflictos con la navegación -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Estilos personalizados - Aseguramos que se carguen DESPUÉS de Bootstrap -->
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/custom.css">
    
    <!-- Estilos específicos por página - Se cargarán desde cada vista cuando sea necesario -->
    <?php if (isset($pageCss) && !empty($pageCss)): ?>
        <?php foreach ($pageCss as $cssFile): ?>
            <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/<?= $cssFile ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <title>EMERGENCIA | HOSPITAL REGIONAL DE CAÑETE REZOLA</title>
</head>
<body>
    <!-- Scripts cargados antes del contenido para asegurar disponibilidad -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="<?= APP_URL ?>/assets/img/logo1.jpg" alt="Logo Hospital">
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