<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_STRING);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $tipoPQR = filter_input(INPUT_POST, 'tipoPQR', FILTER_SANITIZE_STRING);
    $asunto = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);

    // Here you can add your database connection and insertion logic
    // For now, we'll just show a success message
    $mensaje = "PQR recibido exitosamente";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PQR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulario PQR</h2>
        
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