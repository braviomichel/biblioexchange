<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable


// Requête SQL pour récupérer les livres
$sql = "SELECT * FROM livres WHERE owner_id = ?";
// Préparation de la requête
$stmt = $mysqli->prepare($sql);

// Liaison des paramètres
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_user = $stmt->get_result();
// Vérifier s'il y a des livres
if ($result_user->num_rows > 0) {
    // Initialiser un tableau pour stocker les livres
    $livres = array();
    
    // Parcourir les résultats et ajouter chaque livre au tableau
    while ($ligne = $result_user->fetch_assoc()) {
        $livre = array(
            'id' => $ligne['id_livre'],
            'title' => $ligne['titre_livre'],
            'author' => $ligne['auteur'],
            'publicationYear' => $ligne['année_de_publication'],
            'categorie' => $ligne['categorie'],
            'image' => "uploads/".$ligne['couverture'] // Chemin de l'image du livre, à remplacer par le chemin réel de votre image
        );
        // Ajouter le livre au tableau des livres
        $livres[] = $livre;
    }

    // Convertir le tableau des livres en format JSON
    $livres_json = json_encode($livres);

    // Afficher le résultat JSON
    //echo $livres_json;
    //print_r($livres);
} else {
    echo "Aucun livre trouvé.";
}

// Ferme la connexion à la base de données
$stmt->close();
$stmt_user->close();
$mysqli->close();
?>


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
        $(document).ready(function () {
            // Simule une liste de livres (à remplacer par les données réelles de l'utilisateur)

            // var books = [
            //     { title: "Livre 1", author: "Auteur 1", publicationYear: 2020, image: "Assets/book10.jpg" },
            //     { title: "Livre 2", author: "Auteur 2", publicationYear: 2018, image: "Assets/book4.jpg" },
            //     { title: "Livre 3", author: "Auteur 3", publicationYear: 2015, image: "Assets/book3.jpg" },
            //     { title: "Livre 4", author: "Auteur 3", publicationYear: 2015, image: "Assets/book5.jpg" },
            //     { title: "Livre 5", author: "Auteur 3", publicationYear: 2015, image: "Assets/book9.jpg" },
            //     { title: "Livre 6", author: "Auteur 3", publicationYear: 2015, image: "Assets/book7.jpg" }
            //     // Ajoutez d'autres livres selon les besoins
            // ];

            var books = <?php echo $livres_json; ?>
            // Afficher les livres initiaux
            afficherLivres(books);

            // Fonction pour filtrer les livres
            $("#btnFiltrer").click(function () {
                filtrerLivres();
            });

            // Fonction pour trier les livres
            $("#btnTrier").click(function () {
                trierLivres();
            });

            // Fonction pour afficher les livres
            function afficherLivres(livres) {
                $("#livresList").empty();
                livres.forEach(function (livre) {
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
                                    <p class="card-text">Catégorie : ${livre.categorie}</p>
                                    <a href="modifier_livre.php?id=${livre.id}" class="btn btn-primary mr-2">Modifier</a>
                                    <a href="modifier_livre.php" class="btn btn-danger mr-2">Supprimer</a>
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

                var livresFiltres = books.filter(function (livre) {
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