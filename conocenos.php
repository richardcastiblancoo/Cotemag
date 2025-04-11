<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quienes Somos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/cotemag/conocenos.css">
</head>

<body>
<?php include '../cotemag/includes/header.php'; ?>
    <h1>¿Quiénes Somos?</h1>

    <div class="mission-statement">
        <p class="mission-text">
            Nuestro objetivo es siempre ofrecer Programas de Formación para el Trabajo y el Desarrollo Humano, para crear oportunidades y mejoramiento de la calidad de vida de nuestros estudiantes y también un mayor crecimiento económico y social de la comunidad del Magdalena. Formamos el recurso humano de la región hombre y mujeres en competencias laborales que se ajustan a las necesidades del sector productivo, forjando los valores cívicos y éticos que permitan impulsar el desarrollo y crecimiento integral de nuestra sociedad. 
        </p>
        <div class="divider"></div>
    </div>

    <div class="program-grid">
        <div class="program-tile" onclick="openModal('modal-salud')">
            <div class="tile-icon bg-blue"><i class="fa-solid fa-heart-crack"></i></div>
            <div class="tile-title">Área de Salud</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-administrativa')">
            <div class="tile-icon bg-yellow"><i class="fas fa-briefcase"></i></div>
            <div class="tile-title">Área Administrativa</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-salud-animal')">
            <div class="tile-icon bg-pink"><i class="fas fa-paw"></i></div>
            <div class="tile-title">Área de Salud Animal</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-educacion')">
            <div class="tile-icon bg-purple"><i class="fas fa-graduation-cap"></i></div>
            <div class="tile-title">Área de Educación</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-sistemas')">
            <div class="tile-icon bg-purple"><i class="fas fa-desktop"></i></div>
            <div class="tile-title">Área de Análisis y desarrollo de sistemas de la información</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-bachillerato')">
            <div class="tile-icon bg-pink"><i class="fas fa-user-graduate"></i></div>
            <div class="tile-title">Bachillerato por Ciclos CLEI</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-diplomados')">
            <div class="tile-icon bg-yellow"><i class="fas fa-certificate"></i></div>
            <div class="tile-title">Diplomados y Cursos</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-gastronomia')">
            <div class="tile-icon bg-blue"><i class="fas fa-utensils"></i></div>
            <div class="tile-title">Área de Gastronomía</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-industrial')">
            <div class="tile-icon bg-blue"><i class="fas fa-industry"></i></div>
            <div class="tile-title">Área Industrial</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-idiomas')">
            <div class="tile-icon bg-yellow"><i class="fas fa-language"></i></div>
            <div class="tile-title">Área de Idiomas</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-investigativa')">
            <div class="tile-icon bg-pink"><i class="fas fa-search"></i></div>
            <div class="tile-title">Área Investigativa y Judicial</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-diseno')">
            <div class="tile-icon bg-blue"><i class="fas fa-paint-brush"></i></div>
            <div class="tile-title">Área de Diseño</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-belleza')">
            <div class="tile-icon bg-pink"><i class="fas fa-spa"></i></div>
            <div class="tile-title">Belleza y Bienestar Corporal</div>
        </div>

        <div class="program-tile" onclick="openModal('modal-servicios')">
            <div class="tile-icon bg-gray"><i class="fas fa-cogs"></i></div>
            <div class="tile-title">Servicios Generales</div>
        </div>
    </div>

    <!-- Modales -->
    <div id="modal-salud" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Salud</h2>
                <span class="close" onclick="closeModal('modal-salud')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área de Salud
                    La salud es una condición suprema para el desarrollo pleno de la vida humana, lograrla al interior de COTEMAG, es un objetivo primordial.
                    Corresponde al Área de Salud, orientar sus acciones a la promoción de la misma, a través de la prevención de la enfermedad y promoción de estilos de vida saludable, procurando el mejoramiento permanente de las condiciones psíquicas, físicas y ambientales, favoreciendo actividades que promuevan el desarrollo integral y el bienestar social, mediante la implementación de planes, programas y proyectos que propicien y estimulen conductas de auto cuidado entre los miembros de esta comunidad.</p>
            </div>
        </div>
    </div>

    <div id="modal-administrativa" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área Administrativa</h2>
                <span class="close" onclick="closeModal('modal-administrativa')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área Administrativa
                    Ciertos autores definen la Administración educativa como la "ciencia que planifica, organiza, dirige, ejecuta, controla y evalúa las actividades que se desarrollan en las organizaciones educativas, dirigidas a desarrollar las capacidades.</p>
            </div>
        </div>
    </div>

    <div id="modal-salud-animal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Salud Animal</h2>
                <span class="close" onclick="closeModal('modal-salud-animal')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área de Salud Animal
                    Un animal que goza de buena salud está contento, alerta y produce eficientemente. Así, un perro o un gato, comerá tranquilo, estará alerta, tendrá el pelo suave y brilloso, su mirada será vivaz, serán juguetones.
                    
                    Es el deber de toda persona que estudie Veterinaria, velar por la salud de nuestros animales y en COTEMAG estamos comprometidos con la formación de personas al servicio de la salud veterinaria
                    
                    "El arte de la medicina consiste en entretener al paciente mientras la naturaleza cura la enfermedad" - Voltarie.</p>
            </div>
        </div>
    </div>

    <div id="modal-educacion" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Educación</h2>
                <span class="close" onclick="closeModal('modal-educacion')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área de Educación
                    Brindar educación inicial de calidad en el marco de una atención integral, es asegurar el acceso y permanencia a niños y niñas menores de 5 años a la prestación de servicios que garanticen como mínimo los derechos a educación inicial, atención y cuidado, nutrición y salud.</p>
            </div>
        </div>
    </div>

    <div id="modal-sistemas" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Sistemas</h2>
                <span class="close" onclick="closeModal('modal-sistemas')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área de Análisis y desarrollo de sistemas de la información
El egresado de Técnico Laboral en Asistente en Análisis y Desarrollo de Software estará en capacidad de analizar, modelar, desarrollar e implementar soluciones informáticas en entornos web y dispositivos móviles que permitan la optimización de procesos y el manejo de información de la empresa.</p>
            </div>
        </div>
    </div>

    <div id="modal-bachillerato" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Bachillerato por Ciclos CLEI</h2>
                <span class="close" onclick="closeModal('modal-bachillerato')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Bachillerato por Ciclos CLEI
                    En COTEMAG, estamos comprometidos con el crecimiento y fortalecimiento integral de ser humano y sabemos que unos de los pasos importantes es tu bachillerato.
                    
                    Por eso hazte Bachillerato en un tiempo corto tiempo, por cada 6 meses es un año lectivo, no lo dejes para después, ni lo pienses, Ven inscríbete y has realidad tus sueños.</p>
            </div>
        </div>
    </div>

    <div id="modal-diplomados" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Diplomados y Cursos</h2>
                <span class="close" onclick="closeModal('modal-diplomados')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Diplomados y Cursos
                    Un diplomado es un curso de corta o mediana duración, generalmente dictado por una institución de educación, que tiene el propósito de enseñar, complementar o actualizar algún conocimiento o habilidad específica. Los diplomados pueden ser dictados de forma presencial o a distancia (virtuales), con ayuda de las tecnologías de la información y la comunicación.​ Aunque suelen estar dirigidos a los egresados, no siempre se les exige el poseer un grado académico para poder cursarlos.</p>
            </div>
        </div>
    </div>

    <div id="modal-gastronomia" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Gastronomía</h2>
                <span class="close" onclick="closeModal('modal-gastronomia')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área de Gastronomía
                    El técnico laboral en Chef de Alta Cocina tendrá la capacidad y habilidad necesaria para la adecuada preparación de alimentos, su conservación, nutrición, configuración de menús, ejecuta procesos básicos en su servicio, apoya de manera determinante al profesional en la consecución de objetivos en la prestación de un servicio eficiente que beneficie al cliente con demanda culinaria. •Preparar y cocinar menús completos o platos individuales. •Planear menús determinados, tamaño de porciones de alimentos, estimar ingredientes y costos de los alimentos. •Especializarse en la preparación de comida típica o platos especiales. •Cocinero •Cocinero Cocina Caliente •Parrillero.</p>
            </div>
        </div>
    </div>

    <div id="modal-industrial" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área Industrial</h2>
                <span class="close" onclick="closeModal('modal-industrial')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área Industrial
                    El egresado del programa Técnico Profesional en Procesos de Seguridad y Salud en el Trabajo se caracteriza por su profesionalismo, capacidad de análisis, pensamiento creativo, experticia en el manejo de los conceptos, procesos y procedimientos propios de su campo de acción, desde su nivel de operación.</p>
            </div>
        </div>
    </div>

    <div id="modal-idiomas" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Idiomas</h2>
                <span class="close" onclick="closeModal('modal-idiomas')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área de Idiomas
                    En el mundo competitivo de hoy, las lenguas o idiomas forman parte clave de nuestra cultura moderna, pues nos ayudan a ampliar nuestros conocimientos e interactuar con gente de otras partes del mundo, lo que nos sirve para aprender de las tradiciones de otros países, establecer amistades y hacer negocios.</p>
            </div>
        </div>
    </div>

    <div id="modal-investigativa" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área Investigativa y Judicial</h2>
                <span class="close" onclick="closeModal('modal-investigativa')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área Investigativa y Judicial
                    Interpretar el Derecho, fundamentando en la rama judicial investigativa del proceso penal y cualquier país del mundo. La criminalística es la disciplina que aplica fundamentalmente los conocimientos, métodos y técnicas de investigación de las ciencias naturales en el examen del material sensible significativo relacionado con un presunto hecho delictuoso, con el fin de determinar, en auxilio de los órganos de administrar justicia, su existencia, o bien reconstruirlo, o bien señalar y precisar la investigación de uno o varios sujetos en el mismo.</p>
            </div>
        </div>
    </div>

    <div id="modal-diseno" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Diseño</h2>
                <span class="close" onclick="closeModal('modal-diseno')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Área de Diseño
                    Diseño Gráfico implementará metodologías y procesos de creación de imágenes, técnicas de expresión gráfica, y tecnologías computacionales, conducentes a la búsqueda de soluciones visuales óptimas a los problemas de la comunicación gráfica y publicitaria.
                    
                </p>
            </div>
        </div>
    </div>

    <div id="modal-belleza" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Área de Belleza y Bienestar Corporal</h2>
                <span class="close" onclick="closeModal('modal-belleza')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Servicios especializados en belleza y cuidado personal para mejorar la apariencia y el bienestar.</p>
            </div>
        </div>
    </div>

    <div id="modal-servicios" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Servicios Generales</h2>
                <span class="close" onclick="closeModal('modal-servicios')">&times;</span>
            </div>
            <div class="modal-body">
                <p>SERVICIOS GENERALES
                    Limpian salas de espera, pasillos, oficinas, áreas comunes, interiores de ascensores, hospitales, colegios, edificios de oficinas, instalaciones comerciales, residencias privadas y entre otros. Están empleados por hospitales, institutos de educación, oficinas, casas de familia, compañías de servicio de aseo y todos aquellos que requieran del servicio.</p>
            </div>
        </div>
    </div>

    <script>
        // Script simplificado para manejar modales
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar evento de clic al fondo de los modales
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) closeModal(this.id);
                });
            });
        });

        // Función para abrir modal
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.style.display = 'block';
            setTimeout(() => modal.classList.add('show'), 10);
        }

        // Función para cerrar modal
        function closeModal(id) {
            const modal = typeof id === 'string' ? document.getElementById(id) : id;
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
    </script>
</body>

</html>