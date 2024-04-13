    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles supplémentaires */
        .book {
            margin-bottom: 20px;
        }
        .logo img {
            width: 50px; /* Modification de la taille du logo */
            height: auto;
            border-radius: 10px; /* Arrondir les bords du logo */
        }
        .app-logo {
            width: 30px; /* Miniaturisation du logo */
            height: auto;
            margin-right: 10px;
        }
        .book-container {
            display: inline-block;
            position: relative;
            overflow: hidden;
        }
        
        .book {
            position: relative;
            display: block;
            width: 200px;
            height: 300px;
            overflow: hidden;
            transition: transform 0.5s;
        }

        .book:hover {
            transform: scale(1.2);
        }

        .book-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7); /* Couleur d'arrière-plan de l'overlay avec transparence */
            opacity: 0;
            transition: opacity 0.5s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .book-container:hover .book-overlay {
            opacity: 1;
        }

        .book-overlay:hover {
            background-color: rgba(255, 255, 255, 0.9); /* Couleur d'arrière-plan de l'overlay avec plus de transparence au survol */
        }

        .book-info {
            text-align: center;
            color: #000;
        }

        .book img {
            max-width: 100%;
            height: auto;
        }
        .navbar-brand {
            margin-right: auto; /* Alignement à droite */
        }
        .logo img {
            width: 50px; /* Modification de la taille du logo */
            height: auto;
            border-radius: 10px; /* Arrondir les bords du logo */
        }
        .app-logo {
            width: 30px; /* Miniaturisation du logo */
            height: auto;
            margin-right: 10px;
        }
    </style>
    <title>Accueil - BiblioExchange</title>
<header class="bg-dark text-white py-4">
        <div class="container">
<h1 class="mb-0"><img src="Assets/BiblioExchange.png" alt="Logo" class="app-logo">BiblioExchange</h1>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="acceuil.php">
             <!-- Logo de l'applicationBiblioExchange -->
            <i class="fas fa-home" href='#'></i> Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="notification.php"><i class="far fa-bell"></i> Notification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-envelope"></i> Messages</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkLivres" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book"></i> Livres</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="mes_livres.php"><i class="fas fa-book"></i> Mes livres</a>
                        <a class="dropdown-item" href="Publier_un_livre.php"><i class="fas fa-upload"></i> Publier un livre</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forum.php"><i class="fas fa-comments"></i> Forum</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkPlus" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Plus</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="paramètre.php"><i class="fas fa-cog"></i> Paramètres</a>
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profil</a>
                        <a class="dropdown-item" href="signaler.php"><i class="fas fa-flag"></i> Signaler</a>
                        <a class="dropdown-item" href="Back-end/logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </nav>
        </div>
</header>
