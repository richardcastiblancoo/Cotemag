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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img src="/Cotemag/assets/img/logo5.png" class="logo" alt="">
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
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if ($post['imagen']): ?>
                            <img src="<?php echo $post['imagen']; ?>" class="card-img-top" alt="<?php echo $post['titulo']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['titulo']; ?></h5>
                            <p class="card-text"><?php echo substr($post['contenido'], 0, 200) . '...'; ?></p>
                            <button type="button" class="btn btn-primary btn-sm btn-read-more" data-toggle="modal" data-target="#modal<?php echo $post['id']; ?>">
                                Leer más
                            </button>
                            <p class="text-muted mt-2">
                                Por: <?php echo $post['username']; ?><br>
                                Publicado el: <?php echo $post['fecha_publicacion']; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Modal for each post -->
                <div class="modal fade" id="modal<?php echo $post['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $post['titulo']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php if ($post['imagen']): ?>
                                    <img src="<?php echo $post['imagen']; ?>" class="img-fluid mb-3" alt="<?php echo $post['titulo']; ?>">
                                <?php endif; ?>
                                <?php echo $post['contenido']; ?>
                                <hr>
                                <p class="text-muted">
                                    Por: <?php echo $post['username']; ?><br>
                                    Publicado el: <?php echo $post['fecha_publicacion']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Add Bootstrap JS and dependencies at the end of body -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>