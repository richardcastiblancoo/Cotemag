<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "cotemag");

$query = "SELECT n.*, u.username FROM noticias n 
          JOIN usuarios u ON n.autor_id = u.id 
          ORDER BY n.fecha_publicacion DESC";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Metaetiquetas Open Graph -->
    <meta property="og:title" content="Ingreso al Sistema Académico - Cotemag">
    <meta property="og:description" content="Accede al sistema académico de Cotemag para consultar notas, asistencia y más.">
    <meta property="og:url" content="https://www.cotemag.edu.co/index.php/auth/login/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.cotemag.edu.co/">
    <meta property="og:site_name" content="Cotemag">
    <!-- Metaetiquetas Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ingreso al Sistema Académico - Cotemag">
    <meta name="twitter:description" content="Consulta tus notas, asistencia y más en el portal académico de Cotemag.">
    <meta name="twitter:image" content="https://www.cotemag.edu.co/">
    <!-- final  -->
    <!-- Metaetiquetas -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="cotemag">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nuestro objetivo es siempre ofrecer Programas de Formación para el Trabajo y el Desarrollo Humano, para crear oportunidades y mejoramiento de la calidad de vida de nuestros estudiantes y también un mayor crecimiento económico y social de la comunidad del Magdalena.">
    <meta name="keywords" content="Inicio, Novedades, Conocenos, Programas, Contacto, Admin Blog, Login | Q10, PQR, Convenio de Prácticas.">
    <link rel="icon" href="/Cotemag/assets/img/cotemag.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cotemag/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../Cotemag/assets/css/oferta_academica.css">
    <title>Cotemag - Bienvenidos a la Corporación Técnica del Magdalena</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="manifest" href="/cotemag/manifest.json">
    <meta name="theme-color" content="#0B1D3A">
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0B1D3A;
            /* Modern darker blue color */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .preloader.fade-out {
            opacity: 0;
        }

        .preloader img {
            width: 150px;
            height: 150px;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        body.loaded {
            overflow: auto;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <img src="/Cotemag/assets/img/cotemag.png" alt="Cotemag Logo">
    </div>

    <?php include '../cotemag/includes/header.php'; ?>

    <?php include '../cotemag/includes/about.php'; ?>

    <?php include '../Cotemag/includes/oferta_academica.php'; ?>

    <?php include '../cotemag/nov.php'; ?>

    <?php include '../cotemag/includes/blog.php'; ?>

    <?php include '../cotemag/includes/footer.php'; ?>

    <!-- scripts -->
    <script src="/cotemag/scripts/main.js"></script>
    <script src="/cotemag/scripts/scroll.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('ServiceWorker registration successful');
                    })
                    .catch(err => {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }
    </script>
    <!-- Add this before your existing scripts -->
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                const preloader = document.querySelector('.preloader');
                preloader.classList.add('fade-out');
                document.body.classList.add('loaded');

                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }, 1500); // Shows preloader for 1.5 seconds
        });
    </script>
</body>

</html>