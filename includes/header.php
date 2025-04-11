<header class="header">
    <div class="text-img">
        <img src="/Cotemag/assets/img/logo5.png" class="logo" alt="logo-cotemag">
        <h1>Cotemag</h1>
    </div>
    <nav class="navbar">
        <ul>
            <li><a class="contant-a" title="Inicio" href="/cotemag/index.php">Inicio</a></li>
            <li><a class="contant-a" title="Novedades" href="../Cotemag/novedades.php">Novedades</a></li>
            <li><a class="contant-a" title="Conocenos" href="/cotemag/conocenos.php">Conocenos</a></li>
            <li><a class="contant-a" title="Programas" href="../cotemag/pages/oferta_academica.php">Programas</a></li>
            <li><a class="contant-a" title="Contacto" href="#">Contacto</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="btn btn-outline-light mr-2">Dashboard</a>
                <a href="logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="sign-in-btn">Administrador Blog</a>
                <a href="https://site4.q10.com/login?ReturnUrl=%2F&aplentId=73c46535-d1df-4c30-8340-44c2a135aae5" class="sign-in-btn">Plataforma Q10</a>
            <?php endif; ?>
        </div>
    </div>
</header>