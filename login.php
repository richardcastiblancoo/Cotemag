<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "cotemag");

// Check for saved credentials in cookies
if (!isset($_POST['login']) && isset($_COOKIE['remembered_user'])) {
    $username = $_COOKIE['remembered_user'];
    $password = $_COOKIE['remembered_pass'];
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;

    $query = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            // Set cookies if remember me is checked
            if ($remember) {
                setcookie('remembered_user', $username, time() + (30 * 24 * 60 * 60), '/');
                setcookie('remembered_pass', $password, time() + (30 * 24 * 60 * 60), '/');
            } else {
                // Clear cookies if not checked
                setcookie('remembered_user', '', time() - 3600, '/');
                setcookie('remembered_pass', '', time() - 3600, '/');
            }

            header("Location: dashboard.php");
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cotemag</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Cotemag/assets/css/login.css">
    <link rel="icon" href="/Cotemag/assets/img/logo5.png" type="image/png">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <a href="index.php" class="back-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                </a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Administrador Blog</h3>
                    </div>
                    <div class="text-center mt-4 mb-3">
                        <img src="/Cotemag/assets/img/logo5.png" alt="Cotemag Logo" class="login-logo">
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label>Usuario</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="text" name="username" class="form-control"
                                        value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember"
                                        <?php echo isset($_COOKIE['remembered_user']) ? 'checked' : ''; ?>>
                                    <label class="custom-control-label" for="remember">Recordar mis datos</label>
                                </div>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </form>
                        <p class="text-center mt-3">
                            ¿No tienes una cuenta? <a href="registro.php">Regístrate</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>
</body>

</html>