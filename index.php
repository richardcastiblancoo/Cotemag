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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="/Cotemag/assets/img/logo5.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cotemag/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../Cotemag/assets/css/oferta_academica.css">
    <title>Cotemag - Bienvenidos a la Corporación Técnica del Magdalena</title>
</head>

<body>
    <?php include '../cotemag/includes/header.php'; ?>


    <?php include '../cotemag/includes/about.php'; ?>

    <?php include '../Cotemag/includes/oferta_academica.php'; ?>

    <?php include '../cotemag/includes/blog.php'; ?>


    <!-- Footer -->
    <?php include '../cotemag/includes/footer.php'; ?>

    <!-- Add Bootstrap JS and dependencies at the end of body -->
    <script src="/cotemag/scripts/main.js"></script>
    <script src="/cotemag/scripts/scroll.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>