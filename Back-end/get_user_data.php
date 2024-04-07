<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'/biblioexchange/Database/connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/biblioexchange/Back-end/get_id.php'; // user id is in $user_id


// Requête SQL préparée pour récupérer les informations de l'utilisateur à partir de la table utilisateurs
$sql_user = "SELECT * FROM utilisateurs WHERE id_utilisateur = ?";
$stmt_user = $mysqli->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
    // L'utilisateur est connecté
    $user_info = $result_user->fetch_assoc();
    $nom = $user_info["nom_utilisateur"];
    $prenoms = $user_info["prenom_utilisateur"];
    $email = $user_info["email"];
    $dateNaissance = $user_info["date_naissance"];
    $tel = $user_info["telephone"];
    $niveauEtude = $user_info["niveau_etude"];
    $bio = $user_info["biographie"];
    $sexe = $user_info["sexe"];
    $password = $user_info["mot_de_passe"];
    $role = $user_info["role_utilisateur"];
    $image_url = $user_info["image_profil"];
    //$genresPref = $user_info["genre_prefere"];

} else {
    $message = "Aucune information utilisateur trouvée.";
    $errortype = "danger";
}