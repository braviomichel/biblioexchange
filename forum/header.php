<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - BiblioExchange</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Styles personnalisés -->
    <style>
        /* Styles supplémentaires */
        .book {
            margin-bottom: 20px;
        }
        .logo img {
            width: 50px; /* Taille du logo */
            height: auto;
            border-radius: 10px; /* Arrondi des bords */
        }
        .app-logo {
            width: 30px; /* Taille miniaturisée du logo */
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
            background-color: rgba(255, 255, 255, 0.7); /* Transparence de l'overlay */
            opacity: 0;
            transition: opacity 0.5s;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .book-container:hover .book-overlay {
            opacity: 1;
        }
        .book-info {
            text-align: center;
            color: #000;
        }
        .navbar-brand {
            margin-right: auto; /* Alignement à droite */
        }
    </style>
</head>
<body>

<header class="bg-dark text-white py-4">
    <div class="container">
        <h1 class="mb-0">
            <img src="../Assets/BiblioExchange.png" alt="Logo" class="app-logo">
            BiblioExchange
        </h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../accueil.php">
                <i class="fas fa-home"></i> Accueil
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../notification.php"><i class="far fa-bell"></i> Notification</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="message.php"><i class="fas fa-envelope"></i> Messages</a>
                    </li> -->
                     <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkLivres" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book"></i> Livres</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../mes_livres.php"><i class="fas fa-book"></i> Mes livres</a>
                        <a class="dropdown-item" href="../Publier_un_livre.php"><i class="fas fa-upload"></i> Publier un livre</a>
                        <a class="dropdown-item" href="../book_list.php"><i class="fas fa-search"></i> Rechercher un livre</a>
                        <a class="dropdown-item" href="../mes_demandes_livres.php"><i class="fa-regular fa-clock" ></i> Demandes</a>
                    </div>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forum.php"><i class="fas fa-comments"></i> Forum</a>
                    </li>
                     <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkPlus" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Plus</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../paramètre.php"><i class="fas fa-cog"></i> Paramètres</a>
                        <a class="dropdown-item" href="../profile.php"><i class="fas fa-user"></i> Profil</a>
                        <a class="dropdown-item" href="../signaler.php"><i class="fas fa-flag"></i> Signaler</a>
                        <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </div>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </nav>
    </div>
</header>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
