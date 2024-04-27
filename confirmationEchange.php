<?php
// Vérifier si l'identifiant du livre est défini dans l'URL et n'est pas vide
include_once "Back-end/get_id.php";


if (isset($_GET['tr']) ) {
   
        $transaction_id = $_GET['tr'];
    

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
$stmt->close(); // Fermer le statement

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
                <h1>Informations pour l'échange</h1>
               
                
                <p><strong>Date de l'échange:</strong> <?php echo htmlspecialchars($transaction['date_echange'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Heure de l'échange:</strong> <?php echo htmlspecialchars($transaction['heure_echange'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Lieu de l'échange:</strong>
                    <?php echo htmlspecialchars($transaction['lieu_echange'], ENT_QUOTES, 'UTF-8'); ?></p>
                
                    <button type="submit" class="btn btn-success mb-2">Valider l'échange</button>
                    <button type="submit" class="btn btn-warning mb-2">Faire une autre proposition </button>
                    <button type="submit" class="btn btn-danger mb-2">Annuler l'échange</button>
            </div>
            <?php include_once 'footer.php'; ?>
        </body>

        </html>