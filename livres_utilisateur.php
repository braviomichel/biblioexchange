<?php
// Inclure les fichiers nécessaires
include_once 'Database/connect.php';
include_once 'Back-end/check_connection.php';

// Obtenir l'ID de l'utilisateur depuis les paramètres GET
$user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
$tr = isset($_GET['tr']) ? (int) $_GET['tr'] : 0;

if ($user_id === 0) {
    die("ID d'utilisateur invalide");
}

// Requête SQL pour récupérer les livres appartenant à l'utilisateur spécifié
$sql = "SELECT l.id_livre, l.titre_livre, l.auteur, l.année_de_publication, l.couverture
        FROM livres l
        WHERE l.owner_id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$livres = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $livres[] = $row;
    }
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Livres de l'utilisateur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include_once 'header.php'; ?>

    <div class="container mt-5">
        <h2>Livres de l'utilisateur</h2>
        <?php if (count($livres) > 0): ?>
            <form action="book_detail.php" method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Couverture</th>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Année de publication</th>
                            <th>Selectionner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($livres as $livre): ?>
                            <tr>
                                <td><img src="uploads/<?= $livre['couverture']; ?>" alt="Couverture"
                                        style="width: 100px; height: auto;"></td>
                                <td><?= $livre['titre_livre']; ?></td>
                                <td><?= $livre['auteur']; ?></td>
                                <td><?= $livre['année_de_publication']; ?></td>
                                <td>
                                    <input type="radio" name="selected_book" value="<?= $livre['id_livre']; ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="text" name="tr" value="<?= $tr; ?>" hidden/>
                <button type="submit" class="btn btn-success mb-2">Valider la sélection</button>
            </form>
        <?php else: ?>
            <div class="alert alert-info">Aucun livre trouvé pour cet utilisateur.</div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php include_once 'footer.php'; ?>
</body>

</html>