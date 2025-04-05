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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cotemag - Bienvenidos a la Corporación Técnica del Magdalena</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Cotemag</a>
            <div class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="btn btn-outline-light mr-2">Dashboard</a>
                    <a href="logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light mr-2">Administrador Blog</a>
                    <a href="https://site4.q10.com/login?ReturnUrl=%2F&aplentId=73c46535-d1df-4c30-8340-44c2a135aae5" class="btn btn-outline-light">Plataforma Q10</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Contenido de las noticias -->
    <div class="container-text">
        <div class="container">
            <h2 class="h2">Blog Entérate de nuestras actividades</h2>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <?php while ($post = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <?php if ($post['imagen']): ?>
                            <img src="<?php echo $post['imagen']; ?>" class="card-img-top" alt="<?php echo $post['titulo']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['titulo']; ?></h5>
                            <p class="card-text"><?php echo substr($post['contenido'], 0, 200) . '...'; ?></p>
                            <p class="text-muted">
                                Por: <?php echo $post['username']; ?><br>
                                Publicado el: <?php echo $post['fecha_publicacion']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>


</body>

</html>