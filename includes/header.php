<header class="header">
    <div class="text-img">
        <img src="/Cotemag/assets/img/cotemag.png" class="logo" alt="logo-cotemag">
        
    </div>
    <nav class="navbar">
        <ul>
            <li><a class="contant-a" title="Inicio" href="#">Inicio</a></li>
            <li><a class="contant-a" title="Novedades" href="#">Novedades</a></li>
            <li><a class="contant-a" title="Conocenos" href="#">Conocenos</a></li>
            <li><a class="contant-a" title="Programas" href="#">Programas</a></li>
            <li><a class="contant-a" title="Contacto" href="#">Contacto</a></li>
        </ul>
    </nav>
    <div class="container-botones">
        <div class="auth-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="btn btn-outline-light mr-2">Dashboard</a>
                <a href="logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="sign-in-btn">Admin Blog</a>
                <a href="https://site4.q10.com/login?ReturnUrl=%2F&aplentId=73c46535-d1df-4c30-8340-44c2a135aae5" class="sign-in-btn">Login | Q10</a>
            <?php endif; ?>
        </div>
    </div>
</header>