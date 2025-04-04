<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cotemag");

if(isset($_POST['publicar'])) {
    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
    $contenido = mysqli_real_escape_string($conexion, $_POST['contenido']);
    $autor_id = $_SESSION['user_id'];
    
    // Handle image upload
    $imagen = "";
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen_nombre = time() . '_' . $_FILES['imagen']['name'];
        $destino = "uploads/" . $imagen_nombre;
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
            $imagen = $destino;
        }
    }

    $query = "INSERT INTO noticias (titulo, contenido, imagen, autor_id) VALUES ('$titulo', '$contenido', '$imagen', $autor_id)";
    mysqli_query($conexion, $query);
}

// Fetch user's posts
$autor_id = $_SESSION['user_id'];
$query = "SELECT * FROM noticias WHERE autor_id = $autor_id ORDER BY fecha_publicacion DESC";
$resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cotemag</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Cotemag</a>
            <div class="navbar-nav ml-auto">
                <span class="navbar-text mr-3">Bienvenido, <?php echo $_SESSION['username']; ?></span>
                <a href="logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Crear Nueva Publicación</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Contenido</label>
                                <textarea name="contenido" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" name="imagen" class="form-control-file">
                            </div>
                            <button type="submit" name="publicar" class="btn btn-primary">Publicar</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Mis Publicaciones</h3>
                    </div>
                    <div class="card-body">
                        <?php while($post = mysqli_fetch_assoc($resultado)): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $post['titulo']; ?></h5>
                                    <p class="card-text"><?php echo substr($post['contenido'], 0, 200) . '...'; ?></p>
                                    <p class="text-muted">Publicado el: <?php echo $post['fecha_publicacion']; ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

