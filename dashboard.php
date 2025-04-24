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
    <link rel="icon" href="/Cotemag/assets/img/logo5.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cotemag/assets/css/dashboard.css">
    <style>
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar {
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }

        .btn {
            border-radius: 5px;
            padding: 0.5rem 1.5rem;
        }

        .search-container input {
            border-radius: 20px;
            padding-left: 15px;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            padding-top: 60px;
            color: white;
            z-index: 100;
        }

        .sidebar-header {
            text-align: center;
            padding: 20px 0;
        }

        .sidebar-logo {
            width: 80px;
            height: auto;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .sidebar-menu li:hover {
            background-color: #495057;
        }

        .sidebar-menu li.active {
            background-color: #007bff;
        }

        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar-menu i {
            margin-right: 10px;
        }

        /* Adjust main content to make room for sidebar */
        .container {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .search-container {
            margin-top: 20px;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .table td {
            vertical-align: middle;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
        }

        /* Add these to your existing styles */
        .dropdown-menu {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .badge {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 0.7rem;
        }

        .nav-item {
            position: relative;
        }

        .media {
            transition: all 0.3s ease;
        }

        .media:hover {
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="d-flex align-items-center">
            <img src="/Cotemag/assets/img/cotemag.png" width="100" alt="logo cotemag" class="mr-3">
            <h1 class="text-white mb-0" style="font-size: 1.5rem;">Admin Cotemag</h1>
        </div>
        <div class="container">
            <div class="navbar-nav ml-auto d-flex flex-row align-items-center">
                <!-- Notification Bell -->
                <?php
                // Get total number of posts for notifications
                $posts_count_query = "SELECT COUNT(*) as total FROM noticias";
                $posts_count_result = mysqli_query($conexion, $posts_count_query);
                $posts_count = mysqli_fetch_assoc($posts_count_result);
                $notification_count = $posts_count['total'];
                ?>
                <div class="nav-item dropdown mr-3">
                    <a class="nav-link" href="#" id="notificationDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-danger"><?php echo $notification_count; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                        <?php
                        $recent_notifications_query = "SELECT n.titulo, u.username, n.fecha_publicacion 
                                                     FROM noticias n 
                                                     JOIN usuarios u ON n.autor_id = u.id 
                                                     ORDER BY n.fecha_publicacion DESC LIMIT 5";
                        $notifications_result = mysqli_query($conexion, $recent_notifications_query);
                        while ($notification = mysqli_fetch_assoc($notifications_result)): ?>
                            <a class="dropdown-item" href="#">
                                Nueva publicación: <?php echo htmlspecialchars($notification['titulo']); ?>
                                <small class="text-muted d-block">
                                    Por <?php echo htmlspecialchars($notification['username']); ?>
                                </small>
                            </a>
                        <?php endwhile; ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center" href="#">Ver todas las notificaciones</a>
                    </div>
                </div>
                <!-- User Profile -->
                <?php
                $user_id = $_SESSION['user_id'];
                $query = "SELECT imagen FROM usuarios WHERE id = $user_id";
                $result = mysqli_query($conexion, $query);
                $user = mysqli_fetch_assoc($result);
                $profile_image = !empty($user['imagen']) ? $user['imagen'] : '/cotemag/assets/img/logo5.png';
                ?>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                        <img src="<?php echo htmlspecialchars($profile_image); ?>"
                            alt="Profile"
                            class="rounded-circle"
                            style="width: 32px; height: 32px; object-fit: cover;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="perfil.php">Mi Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/cotemag/dashboard-pqr.php">PQR</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/cotemag/registro.php">Agregar admin</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Modify the container section to include right sidebar -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <!-- Replace the existing card with a button -->
                <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#createPostModal">
                    <i class="fas fa-plus"></i> Crear Nueva Publicación
                </button>

                <!-- Add the modal for creating posts -->
                <div class="modal fade" id="createPostModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Crear Nueva Publicación</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Mis Publicaciones</h3>
                    </div>
                    <!-- Add search input -->
                    <div class="card-body">
                        <div class="form-group position-relative">
                            <i class="fas fa-search position-absolute" style="top: 12px; right: 12px; color: #6c757d;"></i>
                            <input type="text" id="searchPosts" class="form-control pr-4" placeholder="Buscar por título...">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="posts-container">
                            <?php while ($post = mysqli_fetch_assoc($resultado)): ?>
                                <div class="card shadow-sm mb-3 mx-3 mt-3 post-item">
                                    <?php
                                    // Get author info
                                    $author_query = "SELECT username, imagen FROM usuarios WHERE id = {$post['autor_id']}";
                                    $author_result = mysqli_query($conexion, $author_query);
                                    $author = mysqli_fetch_assoc($author_result);
                                    $author_image = !empty($author['imagen']) ? $author['imagen'] : '/cotemag/assets/img/logo5.png';
                                    ?>
                                    <?php if (!empty($post['imagen'])): ?>
                                        <img src="<?php echo $post['imagen']; ?>" class="card-img-top" alt="Post image" style="height: 200px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="<?php echo htmlspecialchars($author_image); ?>"
                                                class="rounded-circle mr-2"
                                                style="width: 40px; height: 40px; object-fit: cover;"
                                                alt="Author">
                                            <div>
                                                <h4 class="card-title text-primary mb-0"><?php echo $post['titulo']; ?></h4>
                                                <small class="text-muted">
                                                    Por <?php echo htmlspecialchars($author['username']); ?> -
                                                    <?php echo date('d M Y', strtotime($post['fecha_publicacion'])); ?>
                                                </small>
                                            </div>
                                        </div>
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
            <!-- New Right Sidebar -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Últimas Publicaciones</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $recent_posts_query = "SELECT n.*, u.username, u.imagen as user_image 
                                             FROM noticias n 
                                             JOIN usuarios u ON n.autor_id = u.id 
                                             ORDER BY n.fecha_publicacion DESC LIMIT 5";
                        $recent_posts = mysqli_query($conexion, $recent_posts_query);
                        while ($post = mysqli_fetch_assoc($recent_posts)):
                            $user_image = !empty($post['user_image']) ? $post['user_image'] : '/cotemag/assets/img/default-profile.png';
                        ?>
                            <div class="media mb-3">
                                <img src="<?php echo htmlspecialchars($user_image); ?>"
                                    class="mr-3 rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;"
                                    alt="User">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1"><?php echo htmlspecialchars($post['titulo']); ?></h6>
                                    <small class="text-muted">
                                        Por <?php echo htmlspecialchars($post['username']); ?> -
                                        <?php echo date('d M Y', strtotime($post['fecha_publicacion'])); ?>
                                    </small>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update the scripts section at the bottom -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/cotemag/scripts/main.js"></script>

    <!-- Add search functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchPosts');
            const postsContainer = document.getElementById('posts-container');
            const posts = postsContainer.getElementsByClassName('post-item');

            function filterPosts() {
                const searchTerm = searchInput.value.toLowerCase();

                Array.from(posts).forEach(post => {
                    const title = post.querySelector('.card-title').textContent.toLowerCase();
                    const showPost = title.includes(searchTerm);
                    post.style.display = showPost ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterPosts);
        });
    </script>
</body>

</html>