<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs using modern methods
    $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $documento = htmlspecialchars(trim($_POST['documento'] ?? ''));
    $telefono = htmlspecialchars(trim($_POST['telefono'] ?? ''));
    $tipoPQR = htmlspecialchars(trim($_POST['tipoPQR'] ?? ''));
    $asunto = htmlspecialchars(trim($_POST['asunto'] ?? ''));
    $descripcion = htmlspecialchars(trim($_POST['descripcion'] ?? ''));

    // Database connection
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cotemag", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO pqr_solicitudes (nombre, email, documento, telefono, tipo_pqr, asunto, descripcion) 
                VALUES (:nombre, :email, :documento, :telefono, :tipoPQR, :asunto, :descripcion)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':documento' => $documento,
            ':telefono' => $telefono,
            ':tipoPQR' => $tipoPQR,
            ':asunto' => $asunto,
            ':descripcion' => $descripcion
        ]);

        $mensaje = "PQR recibido exitosamente";
    } catch(PDOException $e) {
        $error = "Error al procesar la solicitud: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PQR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-logo {
            max-width: 150px;
            margin: 20px auto;
            display: block;
        }
        .main-title {
            color: #1a3c6b;
            font-weight: bold;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <img src="/cotemag/assets/img/cotemag.png" alt="Escudo Cotemag" class="header-logo">
        <h2 class="text-center mb-4 main-title">Formulario PQR</h2>
        
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="row g-3">
                <!-- Información Personal -->
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <div class="invalid-feedback">Por favor ingrese su nombre</div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">Por favor ingrese un email válido</div>
                </div>
                
                <div class="col-md-6">
                    <label for="documento" class="form-label">Número de Documento</label>
                    <input type="text" class="form-control" id="documento" name="documento" required>
                    <div class="invalid-feedback">Por favor ingrese su documento</div>
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" required>
                    <div class="invalid-feedback">Por favor ingrese su teléfono</div>
                </div>

                <!-- Tipo de Solicitud -->
                <div class="col-12">
                    <label for="tipoPQR" class="form-label">Tipo de Solicitud</label>
                    <select class="form-select" id="tipoPQR" name="tipoPQR" required>
                        <option value="">Seleccione una opción</option>
                        <option value="peticion">Petición</option>
                        <option value="queja">Queja</option>
                        <option value="reclamo">Reclamo</option>
                    </select>
                    <div class="invalid-feedback">Por favor seleccione un tipo de solicitud</div>
                </div>

                <!-- Asunto y Descripción -->
                <div class="col-12">
                    <label for="asunto" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" required>
                    <div class="invalid-feedback">Por favor ingrese el asunto</div>
                </div>
                
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
                    <div class="invalid-feedback">Por favor ingrese la descripción</div>
                </div>

                <!-- Archivos Adjuntos -->
                <div class="col-12">
                    <label for="archivos" class="form-label">Archivos Adjuntos (opcional)</label>
                    <input type="file" class="form-control" id="archivos" name="archivos[]" multiple>
                </div>

                <!-- Botones -->
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary">Enviar PQR</button>
                    <button type="reset" class="btn btn-secondary ms-2">Limpiar Formulario</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>