<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "cotemag");

if (isset($_GET['id'])) {
    $post_id = mysqli_real_escape_string($conexion, $_GET['id']);
    $query = "SELECT n.*, u.username 
              FROM noticias n 
              JOIN usuarios u ON n.autor_id = u.id 
              WHERE n.id = $post_id";
    $resultado = mysqli_query($conexion, $query);
    $post = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['titulo']); ?> - Cotemag</title>
    <link rel="icon" href="/Cotemag/assets/img/cotemag.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            background-color: #1a237e !important;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar-brand img {
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.1);
        }
        
        .btn-outline-light:hover {
            background-color: #ffffff;
            color: #1a237e;
        }
        .post-image {
            width: 50%;
            height: auto;
            margin: auto;
            object-fit: cover;
        }
        .post-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .post-meta {
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="/Cotemag/assets/img/cotemag.png" alt="Cotemag Logo" style="height: 100px;">
            </a>
            <a href="index.php" class="btn btn-outline-light">Volver al Blog</a>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if ($post): ?>
            <div class="card">
                <?php if (!empty($post['imagen'])): ?>
                    <img src="<?php echo $post['imagen']; ?>" class="post-image" alt="Post image">
                <?php endif; ?>
                <div class="card-body">
                    <h1 class="card-title"><?php echo htmlspecialchars($post['titulo']); ?></h1>
                    <div class="post-meta">
                        <small class="text-muted">
                            Publicado por: <?php echo htmlspecialchars($post['username']); ?><br>
                            Fecha: <?php echo date('d M Y', strtotime($post['fecha_publicacion'])); ?>
                        </small>
                    </div>
                    <div class="post-content">
                        <?php echo nl2br(htmlspecialchars($post['contenido'])); ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                La publicación no existe o ha sido eliminada.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>