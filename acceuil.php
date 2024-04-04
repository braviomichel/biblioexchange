<?php
include_once "check_connection.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - BiblioExchange</title>
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
            overflow: visible;
        }
        
        .book {
            position: relative;
            display: block;
            width: 200px;
            height: 350px;
            overflow: visible;
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
      
    </style>
</head>
<body>
  <?php include_once "header.php"; ?>
    <main>
        <section class="banner bg-primary text-white py-5">
            <div class="container">
                <h2 class="mb-4">Échangez vos livres facilement</h2>
                <p class="lead mb-4">Découvrez une nouvelle façon de partager vos livres préférés avec d'autres lecteurs passionnés.</p>
                <a href="#" class="btn btn-outline-light btn-lg">Commencer</a>
            </div>
        </section>

        <section class="popular-books py-5">
            <div class="container">
                <h2 class="mb-4">Livres populaires</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book3.jpg" alt="Livre 1" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 1</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book5.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 2</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book4.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 3</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book4.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 4</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book5.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 5</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book5.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 6</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book7.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 7</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book10.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Naruto & Les Sannins légendaires.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book9.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 9</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book10.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 10</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book9.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0" ><B>Les Inséparablesjk. Hommage à Masashi Kishimoto</B></p>
                        </div>
                        <div class="col-md-4">
                        <div class="book">
                            <img src="Assets/book10.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 12</p>
                        </div>
                    </div>
                    <!-- Ajoutez plus de livres populaires ici -->
                </div>
            </div>
                    </div>
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel"  >
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner mx-auto "  style="width: 200px;" >
    <div class="carousel-item active ">
    <div class="book">
                            <img src="Assets/book10.jpg" alt="Livre 2" class="img-fluid mb-3">
                            
                        </div>
      
      <h5>First slide label</h5>
    </div>
    
    <div class="carousel-item  ">
    <div class="book">
                            <img src="Assets/book10.jpg" alt="Livre 2" class="img-fluid mb-3">
                           
                        </div>
                        <h5>First slide label</h5>
    </div>
    <div class="carousel-item  ">
    <div class="book">
                            <img src="Assets/book10.jpg" alt="Livre 2" class="img-fluid mb-3">
                            <p class="mb-0">Titre du Livre 10</p>
                        </div>
                        <h5>First slide label</h5>
    </div>
    
   
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev"  style="height: 50px;  width: 50px; ">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next" style="height: 50px;  width: 50px; ">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>
    
        </section>
    </main>

  <?php include_once 'footer.php'; ?>

    <!-- Bootstrap JS et jQuery (facultatif) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
