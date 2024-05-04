<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <!-- Liens vers les bibliothèques de graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.css">
    <style>
        .chart-container {
            width: 40%;
            height: 300px;
            margin: 50px;
            float: left;
        }
        .body{
            background-color : white;
        }
    </style>
</head>
<body>

        <?php include_once "header.php"; ?>

    <h1>Statistiques</h1>
    <?php
    // Simulation de données fictives
    $nombre_utilisateurs_par_mois = [100, 150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650];
    $nombre_livres = 5000;
    $nombre_echanges_par_mois = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160];
    $activite_forum_par_mois = [30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140];

    // Graphique : Nombre d'utilisateurs par mois
    echo '<div class="chart-container">';
    echo '<canvas id="utilisateursParMoisChart"></canvas>';
    echo '</div>';
    // Graphique : Nombre de livres de la plateforme
    echo '<div class="chart-container">';
    echo '<canvas id="livresPlateformeChart"></canvas>';
    echo '</div>';
    // Graphique : Nombre d'échanges par mois
    echo '<div class="chart-container">';
    echo '<canvas id="echangesParMoisChart"></canvas>';
    echo '</div>';
    // Graphique : Activité du forum
    echo '<div class="chart-container">';
    echo '<canvas id="activiteForumChart"></canvas>';
    echo '</div>';

    ?>

    <script>
        // Données fictives
        var nombreUtilisateursParMois = <?php echo json_encode($nombre_utilisateurs_par_mois); ?>;
        var nombreLivres = <?php echo $nombre_livres; ?>;
        var nombreEchangesParMois = <?php echo json_encode($nombre_echanges_par_mois); ?>;
        var activiteForumParMois = <?php echo json_encode($activite_forum_par_mois); ?>;

        // Graphique : Nombre d'utilisateurs par mois
        var utilisateursParMoisChart = new Chart(document.getElementById('utilisateursParMoisChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Nombre d\'utilisateurs',
                    data: nombreUtilisateursParMois,
                    borderColor: 'blue',
                    fill: false
                }]
            }
        });

        // Graphique : Nombre de livres de la plateforme
        var livresPlateformeChart = new Chart(document.getElementById('livresPlateformeChart'), {
            type: 'pie',
            data: {
                labels: ['Livres sur la plateforme', 'Autres'],
                datasets: [{
                    data: [nombreLivres, 10000 - nombreLivres],
                    backgroundColor: ['green', 'lightgrey']
                }]
            }
        });

        // Graphique : Nombre d'échanges par mois
        var echangesParMoisChart = new Chart(document.getElementById('echangesParMoisChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Nombre d\'échanges',
                    data: nombreEchangesParMois,
                    backgroundColor: 'orange'
                }]
            }
        });

        // Graphique : Activité du forum
        var activiteForumChart = new Chart(document.getElementById('activiteForumChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Activité du forum',
                    data: activiteForumParMois,
                    borderColor: 'red',
                    fill: false
                }]
            }
        });

        
    </script>

<?php include_once 'footer.php'; ?>
</body>
</html>
