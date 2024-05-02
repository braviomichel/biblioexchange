<?php
// Vérifier si l'identifiant du livre est défini dans l'URL et n'est pas vide
include_once "Back-end/get_id.php";

// On doi séparer les validations pour que chacun de son côté fasse une validation 

function getUserData($id_utilisateur, $conn)
{
    $sql = "SELECT nom_utilisateur, prenom_utilisateur FROM utilisateurs WHERE id_utilisateur = $id_utilisateur";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return "Utilisateur non trouvé";
    }
}

// Fonction pour récupérer le titre et l'auteur d'un livre à partir de son ID
function getLivreData($id_livre, $conn)
{
    $sql = "SELECT titre_livre, auteur FROM livres WHERE id_livre = $id_livre";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return "Livre non trouvé";
    }
}


if (isset($_GET['tr'])) {

    $transaction_id = $_GET['tr'];
    $validate = false;
    $disable = "";

    if (isset($_GET['validate']) && isset($_GET['user'])) {
        $validate = true;
        $user = $_GET['user'];


        // mettre la valeur de etape à 3
        $etape = $_GET["etape"] + 1;

        // Verifier de quel utilisateur il est question : 
        if ($user_id == $user) {
            $contrepartie = 1;
            $sql = "UPDATE transactions SET etape = ?, confirmation_contrepartie = ? WHERE id_transaction = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iii", $etape, $contrepartie, $transaction_id);
        } else {
            $owner = 1;
            $sql = "UPDATE transactions SET etape = ?, confirmation_owner = ? WHERE id_transaction = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iii", $etape, $owner, $transaction_id);
        }

        if ($stmt->execute()) {

            //header("Location: mes_demandes_livres.php");
            //exit;

            //desactiver le lien : 
            $disable = "disabled";

            // Afficher le message de réussite : 
            $message = "Félicitations, vous avez validé la transaction !";
            $errortype = "success";
        }


    }


    // Récupérer les détails du livre depuis la base de données
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'biblioexchange';

    // Connexion à la base de données
    $conn = new mysqli($host, $user, $password, $database);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Récupérer les demandes de livres effectuées par l'utilisateur
    $sql = "SELECT * FROM transactions WHERE id_transaction = ?"; // Requête SQL pour récupérer les demandes
    $stmt = $mysqli->prepare($sql); // Préparer la requête
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute(); // Exécuter la requête
    $result_demandes = $stmt->get_result(); // Obtenir le résultat de la requête

    //$demandes = $result_demandes->fetch_assoc();
//echo $demandes;

    if ($result_demandes->num_rows > 0) {
        $transaction = $result_demandes->fetch_assoc();

    } else {
        return "aucune transaction";
    }
    // Tableau pour stocker les demandes
// if ($result_demandes->num_rows > 0) {
//     while ($ligne = $result_demandes->fetch_assoc()) {
//         $demandes = $ligne;
//         echo $demandes; // Ajouter chaque demande au tableau
//     }
// } else {
//     $message = "Aucune demande trouvée."; // Message si aucune demande
// }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Détails du Livre</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Votre CSS personnalisé ici */
        .book-cover {
            max-width: 300px;
            /* Taille maximale de l'image */
            height: auto;
            transition: transform 0.3s ease-in-out;
            /* Transition sur l'effet hover */
        }

        .book-cover:hover {
            transform: scale(1.1);
            /* Zoom de 10% sur l'effet hover */
        }

        .book-cover-container {
            width: auto;
            /* Taille du conteneur carré */
            height: auto;
            overflow: hidden;
            /* Masquer les parties de l'image qui dépassent */
            margin-bottom: autopx;
            /* Espacement sous l'image */
        }

        .book-cover-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ajuster l'image pour remplir le conteneur carré */
        }
    </style>
</head>

<body>
    <?php include_once "header.php"; ?>
    <div class="container mb-2">
        <div class="mt-2">
            <?php include_once "Back-end/display.php"; ?>

        </div>
        <h1>Informations pour l'échange</h1>

        <?php
        // Recupération des informations du ou des livres impliqués. 
        $livreData = getLivreData($transaction["id_livre_echange"], $mysqli);
        $livre_echange_name = $livreData["titre_livre"];
        $livre_echange_auteur = $livreData["auteur"];


        // Recupération des informations du ou des livres impliqués. 
        $livreData = getLivreData($transaction["id_livre_contrepartie"], $mysqli);
        $livre_contrepartie = $livreData["titre_livre"];
        $livre_contrepartie_auteur = $livreData["auteur"];


        //utilisateurs impliqués : 
        
        $user_implied = getUserData($transaction["id_recepteur"], $mysqli);
        $user_name_recepteur = $user_implied["nom_utilisateur"] . " " . $user_implied["prenom_utilisateur"];

        $user_implied = getUserData($transaction["id_emetteur"], $mysqli);
        $user_name_emetteur = $user_implied["nom_utilisateur"] . " " . $user_implied["prenom_utilisateur"];

        // // Modification du choix : 
        
        // if ($transaction["id_emetteur"] == $user_id) {
        //     $url = "livres_utilisateur.php?user_id=" . $transaction["id_recepteur"] . "&tr=" . $transaction["id_transaction"];
        // } else {
        //     $url = "livres_utilisateur.php?user_id=" . $transaction["id_emetteur"] . "&tr=" . $transaction["id_transaction"]; //rediriger vers la section des livres de l'autre utilisateur pour choisir 
        // }
        
        ?>


        <p><strong>Date de l'échange:</strong>
            <?php echo htmlspecialchars($transaction['date_echange'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Heure de l'échange:</strong>
            <?php echo htmlspecialchars($transaction['heure_echange'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Lieu de l'échange:</strong>
            <?php echo htmlspecialchars($transaction['lieu_echange'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Livre Pincipal :</strong>
            <?php echo $livre_echange_name . " écrit par " . $livre_echange_auteur; ?></p>
        <p><strong>Propriétaire :</strong>
            <?php echo $user_name_recepteur; ?></p>
        <p><strong>Contrepartie proposée :</strong>
            <?php echo $livre_contrepartie . " écrit par " . $livre_contrepartie_auteur; ?></p>
        <p><strong>Propriétaire :</strong>
            <?php echo $user_name_emetteur; ?></p>

        <?php
        if ($transaction["confirmation_contrepartie"] == 1 && $transaction["confirmation_owner"] == 1) {
            $disable = "disabled";
            $texte = "Transaction terminée";
        } elseif ((($user_id == $transaction["id_emetteur"]) && $transaction["confirmation_contrepartie"] == 1) || (($user_id == $transaction["id_recepteur"]) && $transaction["confirmation_owner"] == 1)) {
            $disable = "disabled";
            $texte = "Seconde confirmation en attente";
        } else {
            $texte = "Valider l'échange";
        }
        if($transaction["etape"] == 4)
        {
            // on va changer l'état des livres : 
            $sql = "UPDATE livres SET disponible = 0 WHERE id_livre = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i",$transaction["id_livre_echange"]);
            $stmt->execute();


            $sql = "UPDATE livres SET disponible = 0 WHERE id_livre = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i",$transaction["id_livre_contrepartie"]);
            $stmt->execute();

            $stmt->close(); // Fermer le statement

        }
        ?>

        <a href="confirmationEchange.php?tr=<?= $transaction_id; ?>&validate&user=<?= $transaction["id_emetteur"]; ?>&etape=<?= $transaction["etape"] ?>"
            class="btn btn-success <?= $disable ?>"><?= $texte; ?></a>
        <a href="" class="btn btn-danger">Annuler l'échange</a>

        <!-- <button type="submit" class="btn btn-success mb-2">Valider l'échange</button> -->
        <!-- <a href="$url" class="btn btn-warning mb-2">Faire une autre proposition</a> -->
        <!-- <button type="submit" class="btn btn-danger mb-2">Annuler l'échange</button> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php include_once 'footer.php'; ?>
</body>

</html>