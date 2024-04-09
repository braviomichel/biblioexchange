<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mes Livres</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    /* Ajoutez votre CSS personnalisé ici */
</style>
</head>
<body>
<?php include_once "header.php"; ?>

<div class="container mt-5">
    <h2 class="mb-4">Mes Livres</h2>
    <div class="row">
        <!-- Filtrage et recherche -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filtrage et Recherche</h5>
                    <div class="form-group">
                        <label for="filtreTitre">Titre:</label>
                        <input type="text" class="form-control" id="filtreTitre">
                    </div>
                    <div class="form-group">
                        <label for="filtreAuteur">Auteur:</label>
                        <input type="text" class="form-control" id="filtreAuteur">
                    </div>
                    <button class="btn btn-primary btn-block" id="btnFiltrer">Filtrer</button>
                </div>
            </div>
        </div>
        
        <!-- Options de tri -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Options de Tri</h5>
                    <select class="form-control mb-2" id="triSelect">
                        <option value="titre">Titre</option>
                        <option value="auteur">Auteur</option>
                        <option value="annee">Année de publication</option>
                    </select>
                    <button class="btn btn-primary btn-block" id="btnTrier">Trier</button>
                </div>
            </div>
        </div>
        
        <!-- Liste des livres -->
        <div id="livresList" class="col-md-8">
            <!-- La liste des livres sera générée ici -->
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Script JavaScript pour charger et afficher les livres de l'utilisateur
    $(document).ready(function() {
        // Simule une liste de livres (à remplacer par les données réelles de l'utilisateur)
        var books = [
            { title: "Livre 1", author: "Auteur 1", publicationYear: 2020, image: "Assets/book10.jpg" },
            { title: "Livre 2", author: "Auteur 2", publicationYear: 2018, image: "Assets/book4.jpg" },
            { title: "Livre 3", author: "Auteur 3", publicationYear: 2015, image: "Assets/book3.jpg" },
            { title: "Livre 4", author: "Auteur 3", publicationYear: 2015, image: "Assets/book5.jpg" },
            { title: "Livre 5", author: "Auteur 3", publicationYear: 2015, image: "Assets/book9.jpg" },
            { title: "Livre 6", author: "Auteur 3", publicationYear: 2015, image: "Assets/book7.jpg" }
            // Ajoutez d'autres livres selon les besoins
        ];

        // Afficher les livres initiaux
        afficherLivres(books);

        // Fonction pour filtrer les livres
        $("#btnFiltrer").click(function() {
            filtrerLivres();
        });

        // Fonction pour trier les livres
        $("#btnTrier").click(function() {
            trierLivres();
        });

        // Fonction pour afficher les livres
        function afficherLivres(livres) {
            $("#livresList").empty();
            livres.forEach(function(livre) {
                var bookCard = `
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="${livre.image}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">${livre.title}</h5>
                                    <p class="card-text">Auteur: ${livre.author}</p>
                                    <p class="card-text">Année de publication: ${livre.publicationYear}</p>
                                    <button class="btn btn-primary mr-2">Modifier</button>
                                    <button class="btn btn-danger">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $("#livresList").append(bookCard);
            });
        }

        // Fonction pour filtrer les livres
        function filtrerLivres() {
            var filtreTitre = $("#filtreTitre").val().toLowerCase();
            var filtreAuteur = $("#filtreAuteur").val().toLowerCase();

            var livresFiltres = books.filter(function(livre) {
                return livre.title.toLowerCase().indexOf(filtreTitre) !== -1 && livre.author.toLowerCase().indexOf(filtreAuteur) !== -1;
            });

            // Afficher les livres filtrés
            afficherLivres(livresFiltres);
        }

        // Fonction pour trier les livres
        function trierLivres() {
            var critereTri = $("#triSelect").val();

            if (critereTri === "titre") {
                books.sort((a, b) => a.title.localeCompare(b.title));
            } else if (critereTri === "auteur") {
                books.sort((a, b) => a.author.localeCompare(b.author));
            } else if (critereTri === "annee") {
                books.sort((a, b) => a.publicationYear - b.publicationYear);
            }

            // Afficher les livres triés
            afficherLivres(books);
        }
    });
</script>
</body>
</html>
