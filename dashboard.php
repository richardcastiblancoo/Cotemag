<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cotemag");

// Handle delete post
if (isset($_POST['eliminar'])) {
    $post_id = mysqli_real_escape_string($conexion, $_POST['post_id']);
    $query = "DELETE FROM noticias WHERE id = $post_id AND autor_id = {$_SESSION['user_id']}";
    mysqli_query($conexion, $query);
    header("Location: dashboard.php");
    exit();
}

// Handle edit post
if (isset($_POST['editar'])) {
    $post_id = mysqli_real_escape_string($conexion, $_POST['post_id']);
    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
    $contenido = mysqli_real_escape_string($conexion, $_POST['contenido']);

    $query = "UPDATE noticias SET titulo = '$titulo', contenido = '$contenido' 
              WHERE id = $post_id AND autor_id = {$_SESSION['user_id']}";
    mysqli_query($conexion, $query);
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['publicar'])) {
    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
    $contenido = mysqli_real_escape_string($conexion, $_POST['contenido']);
    $autor_id = $_SESSION['user_id'];

    // Enhanced image upload handling
    $imagen = "";
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['imagen']['name'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed)) {
            $imagen_nombre = time() . '_' . $filename;
            $destino = "uploads/" . $imagen_nombre;

            // Create uploads directory if it doesn't exist
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                $imagen = $destino;
            }
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
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Crear Nueva Publicación</h3>
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
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Mis Publicaciones</h3>
                    </div>
                    <div class="card-body p-0">
                        <?php while ($post = mysqli_fetch_assoc($resultado)): ?>
                            <div class="card shadow-sm mb-3 mx-3 mt-3">
                                <?php if (!empty($post['imagen'])): ?>
                                    <img src="<?php echo $post['imagen']; ?>" class="card-img-top" alt="Post image" style="height: 200px; object-fit: cover;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h4 class="card-title text-primary"><?php echo $post['titulo']; ?></h4>
                                    <p class="card-text text-muted mb-2">
                                        <small><i class="fas fa-calendar-alt"></i> <?php echo date('d M Y', strtotime($post['fecha_publicacion'])); ?></small>
                                    </p>
                                    <p class="card-text"><?php echo substr($post['contenido'], 0, 200) . '...'; ?></p>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-outline-primary btn-sm mr-2" data-toggle="modal" data-target="#editModal<?php echo $post['id']; ?>">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <form method="POST" action="" style="display: inline;">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                            <button type="submit" name="eliminar" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?php echo $post['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Publicación</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        // In the edit form modal, add image upload capability
                                        <div class="modal-body">
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                <div class="form-group">
                                                    <label>Título</label>
                                                    <input type="text" name="titulo" class="form-control" value="<?php echo $post['titulo']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contenido</label>
                                                    <textarea name="contenido" class="form-control" rows="5" required><?php echo $post['contenido']; ?></textarea>
                                                </div>
                                                <?php if (!empty($post['imagen'])): ?>
                                                    <div class="form-group">
                                                        <label>Imagen actual:</label>
                                                        <img src="<?php echo $post['imagen']; ?>" class="img-fluid mb-2" style="max-height: 200px;">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group">
                                                    <label>Nueva imagen (opcional)</label>
                                                    <input type="file" name="imagen" class="form-control-file">
                                                </div>
                                                <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/your-code-here.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>