<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link de CSS compilado -->
        <link rel="stylesheet" href="assets/sass/styles.css">
        <title>Menu responsive</title>
    </head>
    <body>
        <header class="header">
            <a href="#" class="header__logo">KALU</a>
            <ion-icon name="menu-outline" class="header__toggle" id="nav-toggle"></ion-icon>
            <nav class="nav" id="nav-menu">
                <div class="nav__content bd-grid">
                    <ion-icon name="close-outline" class="nav__close" id="nav-close"></ion-icon>
                    <div class="nav__perfil">
                        <div>
                            <a href="#" class="nav__name">KALU</a>
                            <span class="nav__profesion">emociones</span>
                        </div>
                    </div>
                    <div class="nav__menu">
                        <ul class="nav__list">
                            <li class="nav__item"><a href="#" class="nav__link active">INICIO</a></li>
                            <li class="nav__item"><a href="#" class="nav__link">TEST</a></li>
                            <li class="nav__item"><a href="#" class="nav__link">DIARIO</a></li>
                            <li class="nav__item"><a href="#" class="nav__link">CHAT</a></li>
                            <li class="nav__item"><a href="Artículos/index.php" class="nav__link">NOTICIAS</a></li>
                        </ul>
                    </div>
                    <div class="nav__social">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Include Ionic Icons -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        <!-- Link JavaScript -->
        <script src="assets/js/main.js"></script>
    </body>
</html>
