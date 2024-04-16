<?php
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.book-card {
    width: 200px;
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.5s, box-shadow 0.5s;
}

.book-card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.book-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.book-card .book-info {
    padding: 10px;
}

.book-card h5 {
    margin-top: 0;
    font-size: 16px;
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
</head>
<body>
        <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
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
                    <a class="nav-link" href="message.html"><i class="fas fa-envelope"></i> Messages</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkLivres" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book"></i> Livres</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="mes_livres.php"><i class="fas fa-book"></i> Mes livres</a>
                        <a class="dropdown-item" href="Publier_un_livre.php"><i class="fas fa-upload"></i> Publier un livre</a>
                        <a class="dropdown-item" href="rechercher_un_livre.php"><i class="fas fa-search"></i> Rechercher un livre</a>
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

     <section class="banner bg-primary text-white py-5">
            <div class="container">
                <h2 class="mb-4">Échangez vos livres facilement</h2>
                <p class="lead mb-4">Découvrez une nouvelle façon de partager vos livres préférés avec d'autres lecteurs
                    passionnés.</p>
                <a href="Publier_un_livre.php" class="btn btn-outline-light btn-lg">Commencer</a>
            </div>
        </section>
         <section class="popular-books py-5">
            <div class="container">
                <h2 class="mb-4">Livres populaires</h2>
                <div class="book-section">
                    <h2 class="section-title">Manga</h2>
                        <div class="book-container">
                         <!-- Insérez ici les livres de la catégorie Manga -->
                         <div class="book-card">
                        <img src="Assets/manga1.jpg" alt="Manga 1">
                        <div class="book-info">
                            <h5>Blue Lock</h5>
                            <p>Nomura YUSUKE</p>
                        </div>
            </div>
            <div class="book-card">
                <img src="Assets/manga2.jpeg" alt="Manga 2">
                <div class="book-info">
                    <h5>Blue Lock</h5>
                    <p>Nomura YUSUKE</p>
                </div>
            </div>
             <div class="book-card">
                <img src="Assets/manga3.jpeg" alt="Manga 3">
                <div class="book-info">
                    <h5>Kimestu No Yaiba</h5>
                    <p>Koyoharu Gotôge</p>
                </div>
            </div>
             <div class="book-card">
                <img src="Assets/manga4.jpg" alt="Manga 4">
                <div class="book-info">
                    <h5>Kimestu No Yaiba</h5>
                    <p>Koyoharu Gotôge</p>
                </div>
            </div>
            <!-- Ajoutez d'autres livres de manga ici -->
        </div>
    </div>

    <div class="book-section">
        <h2 class="section-title">Géopolitique</h2>
        <div class="book-container">
            <!-- Insérez ici les livres de la catégorie Géopolitique -->
            <div class="book-card">
                <img src="Assets/geo1.jpg" alt="Géopolitique 1">
                <div class="book-info">
                    <h5>Géopolitique 1</h5>
                    <p>Auteur</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/geo2.jpg" alt="Géopolitique 2">
                <div class="book-info">
                    <h5>Géopolitique 2</h5>
                    <p>Auteur</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/geo3.jpg" alt="Géopolitique 1">
                <div class="book-info">
                    <h5>Géopolitique 3</h5>
                    <p>Auteur</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/geo4.jpg" alt="Géopolitique 2">
                <div class="book-info">
                    <h5>Géopolitique 4</h5>
                    <p>Auteur</p>
                </div>
            </div>
            <!-- Ajoutez d'autres livres de géopolitique ici -->
        </div>
    </div>
    <div class="book-section">
        <h2 class="section-title">Biographie</h2>
        <div class="book-container">
            <!-- Insérez ici les livres de la catégorie Biographie  -->
            <div class="book-card">
                <img src="Assets/bio1.jpeg" alt="Biographie 1">
                <div class="book-info">
                    <h5>Steve JOBBS</h5>
                    <p>Steve JOBBS</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/bio2.jpg" alt="Biographie 2">
                <div class="book-info">
                    <h5>Soprano</h5>
                    <p>Soprano</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/bio3.jpg" alt="Biographie 3">
                <div class="book-info">
                    <h5>Angela Merkel</h5>
                    <p>Florence AUTRET</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/bio4.jpg" alt="Biographie 4">
                <div class="book-info">
                    <h5>Michelle Obama</h5>
                    <p>Michelle Obama</p>
                </div>
            </div>
            <!-- Ajoutez d'autres livres de géopolitique ici -->
        </div>
    </div>
    <div class="book-section">
        <h2 class="section-title">Magazine</h2>
        <div class="book-container">
            <!-- Insérez ici les livres de la catégorie magazine -->
            <div class="book-card">
                <img src="Assets/magazine1.jpeg" alt="magazine1">
                <div class="book-info">
                    <h5>Jeune Afrique1</h5>
                    <p>Béchir Ben Yahmed</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/magazine2.jpeg" alt="magazine2">
                <div class="book-info">
                    <h5>Jeune Afrique2</h5>
                    <p>Béchir Ben Yahmed</p>
                </div>
            </div>
             <div class="book-card">
                <img src="Assets/magazine3.png" alt="magazine3">
                <div class="book-info">
                    <h5>Jeune Afrique3</h5>
                    <p>Béchir Ben Yahmed</p>
                </div>
            </div>
            <div class="book-card">
                <img src="Assets/magazine4.png" alt="magazine4">
                <div class="book-info">
                    <h5>Jeune Afrique4</h5>
                    <p>Béchir Ben Yahmed</p>
                </div>
            </div>
            <!-- Ajoutez d'autres livres de géopolitique ici -->
        </div>
    </div>
    <!-- Ajoutez d'autres sections pour d'autres catégories de livres -->

</div>
</section>
<footer class="bg-dark text-white py-4">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles supplémentaires */
        .useful-links a {
            color: #fff; /* Couleur des liens utiles en blanc */
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Liens utiles</h5>
                <ul class="list-unstyled useful-links">
                    <li><a href="acceuil.php"><i class="fas fa-home"></i>Accueil</a></li>
                    <li><a href="notification.php"><i class="fas fa-bell"></i>Notifications</a></li>
                    <li><a href="message.php"><i class="fas fa-envelope"></i>Messages</a></li>
                    <li><a href="livres.php"><i class="fas fa-book"></i>Livres</a></li>
                    <li><a href="forum.php"><i class="fas fa-comments"></i>Forum</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Contactez-nous</h5>
                <ul class="list-unstyled">
                    <li>Adresse: 123 Rue de la Bibliothèque, Kénitra</li>
                    <li>Téléphone: +123 456 789</li>
                    <li>Email: contact@biblioexchange.com</li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="text-center">&copy; 2024 BiblioExchange. Tous droits réservés.</p>
    </div>
    <!-- Bootstrap JS et jQuery (facultatif) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




   