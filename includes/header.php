<header class="encabezado">
    <div class="contenedor-logo">
        <img src="/Cotemag/assets/img/cotemag.png" class="logo" alt="logo-cotemag">
    </div>
    <nav class="navegacion">
        <ul>
            <li><a class="enlace-nav" title="Inicio" href="#">Inicio</a></li>
            <li><a class="enlace-nav" title="Novedades" href="#">Novedades</a></li>
            <li><a class="enlace-nav" title="Conocenos" href="#">Conocenos</a></li>
            <li><a class="enlace-nav" title="Programas" href="#">Programas</a></li>
            <li><a class="enlace-nav" title="Contacto" href="#">Contacto</a></li>
        </ul>
    </nav>
    <div class="contenedor-botones">
        <div class="botones-autenticacion">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="boton-iniciar">Dashboard</a>
                <a href="logout.php" class="boton-iniciar">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="boton-iniciar">Admin Blog</a>
                <a href="https://site4.q10.com/login?ReturnUrl=%2F&aplentId=73c46535-d1df-4c30-8340-44c2a135aae5" class="boton-iniciar">Login | Q10</a>
            <?php endif; ?>
        </div>
    </div>
</header>