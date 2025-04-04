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
    <title>Cotemag - Noticias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Cotemag</a>
            <div class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="btn btn-outline-light mr-2">Dashboard</a>
                    <a href="logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light mr-2">Iniciar Sesión</a>
                    <a href="registro.php" class="btn btn-outline-light">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php while($post = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <?php if($post['imagen']): ?>
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

    <?php include 'includes/administrador.php'; ?>

</body>
</html>