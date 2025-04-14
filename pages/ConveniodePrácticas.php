<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convenio de Prácticas | Cotemag</title>
    <link rel="shortcut icon" href="/Cotemag/assets/img/cotemag.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-title {
            text-align: center;
            margin: 40px 0;
            color: #333;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #0d6efd;
        }

        .accordion-button {
            background-color: #b8a17c !important;
            color: white !important;
            font-weight: 600;
        }

        .accordion-button:not(.collapsed) {
            background-color: #9f8b6c !important;
            color: white !important;
            box-shadow: none;
        }

        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .requirements-list li::before {
            color: #b8a17c;
        }

        .download-btn {
            background-color: #b8a17c;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(184, 161, 124, 0.3);
        }

        .download-btn:hover {
            background-color: #9f8b6c;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(184, 161, 124, 0.4);
        }

        .download-btn svg {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        .download-btn:hover svg {
            transform: translateY(2px);
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 2rem;
        }

        .header{
            display: flex;
            justify-content: center;
            align-items: center;;
        }

        .img-logo-convenio{
            width: 100px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    
    <header class="header">
        <a href="/cotemag/index.php"><img src="/Cotemag/assets/img/cotemag.png" class="img-logo-convenio" alt=""></a>
    </header>

    <div class="container py-5">
        <h1 class="section-title">Convenio de Prácticas</h1>

        <div class="accordion" id="practicasAccordion">
            <!-- Requisitos Section -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#requisitosCollapse" aria-expanded="true" aria-controls="requisitosCollapse">
                        REQUISITOS
                    </button>
                </h2>
                <div id="requisitosCollapse" class="accordion-collapse collapse show" data-bs-parent="#practicasAccordion">
                    <div class="accordion-body">
                        <ul class="requirements-list">
                            <li>1. Solicitud de prácticas formativas (Formato entregado en COTEMAG)</li>
                            <li>2. Dos hoja de vida impresa a color en el formato de COTEMAG</li>
                            <li>3. Dos foto 3x4 fondo azul tipo documento (No escaneada, No tipo selfie)</li>
                            <li>4. Dos fotocopia del documento de identidad al 100%</li>
                            <li>5. Una fotocopia del documento de identidad al 150%</li>
                            <li>6. Esquema de vacunación al día para el área de salud</li>
                            <li>7. Dos certificado de Fosyga</li>
                            <li>8. Dos fotocopia del Seguro Estudiantil o recibo de pago del mismo</li>
                            <li>9. Una fotocopia del recibo de pago de pólizas</li>
                            <li>10. Paz y salvo académico</li>
                            <li>11. Paz y salvo financiero</li>
                            <li>12. Permiso de trabajo notariado para menores de edad</li>
                            <li>13. Certificado de la procuraduría</li>
                            <li>14. Certificado de contraloría</li>
                            <li>15. Certificado de policía</li>
                            <li>16. Fotocopia del diploma de bachiller y de otros estudios incluyendo seminarios realizados en COTEMAG (Una fotocopia de cada documento)</li>
                            <li>17. Una carpeta blanca</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Anexos Section -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#anexosCollapse" aria-expanded="true" aria-controls="anexosCollapse">
                        ANEXOS PRACTICAS FORMATIVAS
                    </button>
                </h2>
                <div id="anexosCollapse" class="accordion-collapse collapse show" data-bs-parent="#practicasAccordion">
                    <div class="accordion-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <h3 class="card-title h5 mb-3">Formato solicitud de prácticas</h3>
                                        <p class="card-text flex-grow-1">Este documento esta diseñado en Microsoft Word (docx), el cual es desarrollado por Sistema de Gestión de la Calidad – Corporación Técnica del Magdalena con el título de SOLICITUD DE PRÁCTICAS FORMATIVAS Código: GC-F007.</p>
                                        <a href="#" class="download-btn mt-3 align-self-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                            </svg>
                                            DESCARGAR
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <h3 class="card-title h5 mb-3">Hoja de Vida</h3>
                                        <p class="card-text flex-grow-1">Este documento esta diseñado en Microsoft Word (docx), el cual es desarrollado por Sistema de Gestión de la Calidad – Corporación Técnica del Magdalena HOJA DE VIDA DE PRACTICANTES Código: GC-F008.</p>
                                        <a href="#" class="download-btn mt-3 align-self-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                            </svg>
                                            DESCARGAR
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

   
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>