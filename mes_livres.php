<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // Récupère et stocke l'id de l'utilisateur dans $user_id

// Requête SQL pour récupérer les livres de l'utilisateur
$sql = "SELECT * FROM livres WHERE owner_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_user = $stmt->get_result();

if ($result_user->num_rows > 0) {
    $livres = array();
    while ($ligne = $result_user->fetch_assoc()) {
        $livres[] = $ligne;
    }
} else {
    echo "Aucun livre trouvé.";
}
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Livres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include_once "header.php"; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Mes Livres</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sélectionner</th>
                            <th scope="col">Image</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Année</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($livres as $livre): ?>
                        <tr>
                            <td><input type="checkbox" name="selected_books[]" value="<?= $livre['id_livre']; ?>"></td>
                            <td><img src="uploads/<?= $livre['couverture']; ?>" alt="<?= $livre['titre_livre']; ?>" style="width: 50px; height: auto;"></td>
                            <td><?= $livre['titre_livre']; ?></td>
                            <td><?= $livre['auteur']; ?></td>
                            <td><?= $livre['année_de_publication']; ?></td>
                            <td><?= $livre['categorie']; ?></td>
                            <td>
                                <a href="modifier_livre.php?id=<?= $livre['id_livre']; ?>" class="btn btn-primary">Modifier</a>
                                <a href="delete_book.php?id=<?= $livre['id_livre']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a>
                                <a href="select_books_to_exchange.php?id=<?= $livre['id_livre']; ?>" class="btn btn-success">Selectionner</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
