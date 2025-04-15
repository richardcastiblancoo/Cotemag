<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "cotemag");

// Handle profile updates
if (isset($_POST['actualizar_perfil'])) {
    $user_id = $_SESSION['user_id'];
    $username = mysqli_real_escape_string($conexion, $_POST['username']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    
    // Image upload handling
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['imagen']['name'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed)) {
            $imagen_nombre = time() . '_' . $filename;
            $destino = "uploads/profiles/" . $imagen_nombre;

            if (!file_exists('uploads/profiles')) {
                mkdir('uploads/profiles', 0777, true);
            }

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                $update_image = ", imagen = '$destino'";
            }
        }
    } else {
        $update_image = "";
    }

    // Update basic info
    $query = "UPDATE usuarios SET username = '$username', email = '$email' $update_image 
              WHERE id = $user_id";
    mysqli_query($conexion, $query);

    // Handle password change if requested
    if (!empty($_POST['new_password']) && !empty($_POST['current_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        
        // Verify current password
        $verify_query = "SELECT password FROM usuarios WHERE id = $user_id";
        $result = mysqli_query($conexion, $verify_query);
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($current_password, $user['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            mysqli_query($conexion, "UPDATE usuarios SET password = '$hashed_password' WHERE id = $user_id");
            $password_message = "Contraseña actualizada correctamente";
        } else {
            $password_error = "La contraseña actual es incorrecta";
        }
    }

    header("Location: perfil.php?success=1");
    exit();
}

// Fetch current user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM usuarios WHERE id = $user_id";
$result = mysqli_query($conexion, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Cotemag</title>
    <link rel="icon" href="/Cotemag/assets/img/logo5.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #007bff;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <img src="/cotemag/assets/img/logo5.png" alt="Cotemag" height="40">
            </a>
            <a href="dashboard.php" class="btn btn-outline-light">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="<?php echo !empty($user['imagen']) ? htmlspecialchars($user['imagen']) : '/cotemag/assets/img/default-profile.png'; ?>" 
                                 alt="Profile" 
                                 class="profile-image mb-3">
                            <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                        </div>

                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success">Perfil actualizado correctamente</div>
                        <?php endif; ?>

                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nombre de Usuario</label>
                                <input type="text" name="username" class="form-control" 
                                       value="<?php echo htmlspecialchars($user['username']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Cambiar Foto de Perfil</label>
                                <input type="file" name="imagen" class="form-control-file">
                            </div>

                            <hr>

                            <h5 class="mb-3">Cambiar Contraseña</h5>
                            <?php if (isset($password_error)): ?>
                                <div class="alert alert-danger"><?php echo $password_error; ?></div>
                            <?php endif; ?>
                            <?php if (isset($password_message)): ?>
                                <div class="alert alert-success"><?php echo $password_message; ?></div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label>Contraseña Actual</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>

                            <div class="text-center">
                                <button type="submit" name="actualizar_perfil" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>