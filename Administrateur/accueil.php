<?php
include_once "../Back-end/check_connection.php";
include_once "../Back-end/check_role.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - BiblioExchange</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles pour le tableau de bord administratif */
        .a {
            color: #ffffff;
            text-decoration: none;
            background-color: transparent;
        }

        .admin-dashboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-dashboard h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .admin-dashboard h2 {
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 10px;
            color: #444;
        }

        .admin-dashboard button {
            margin-bottom: 10px;
            padding: 8px 16px;
            font-size: 16px;
            background-color: #56d364;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .admin-dashboard button:hover {
            background-color: #0056b3;
        }

        

        .user-item,
        .book-item,
        .message-item,
        .report-item,
        .statistic-item,
        .setting-item,
        .logout-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

       
        .navbar {
            margin-bottom: 20px ;
        }
    </style>
</head>

<body>
    
<?php include_once "header.php"; ?>

    <div class="admin-dashboard">
        <h1>Tableau de bord administratif</h1>

        <div id="userManagement">
            <h2>Gestion des utilisateurs</h2>
            <button><a href="userManagement.php">Charger les utilisateurs</a></button>
        </div>


        <div id="bookManagement">
            <h2>Gestion des livres</h2>
            <button><a href="bookManagement.php">Charger les livres</a></button>
       </div>
      
       <div id="reportManagement">
            <h2>Gestion des signalement</h2>
            <button ><a href="reportManagement.php" >Charger les signalements</a></button>
        </div>
        <div id="stats">
            <h2>Statistiques</h2>
            <button ><a href="stats.php">Charger les statistiques</a></button>
            
        </div>
           
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <?php include_once "footer.php"; ?>
</body>
</html>