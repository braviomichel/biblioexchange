<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="livre1.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            BiblioExchange Admin
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="acceuil.php"><i class="fa-solid fa-bars"></i>Tableau de Bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userManagement.php"><i class="fas fa-users"></i> Gestion des Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bookManagement.php"><i class="fas fa-book"></i> Gestion des Livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="messageManagement.php"><i class="fas fa-envelope"></i> Gestion des Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reportManagement.php"><i class="fas fa-exclamation-triangle"></i> Gestion des Signalements</a>
                </li>
                <!-- Ajout du menu déroulant pour les paramètres -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="statistics.html"><i class="fas fa-chart-bar"></i> Statistiques</a>
                        <a class="dropdown-item" href="../Back-end/logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

