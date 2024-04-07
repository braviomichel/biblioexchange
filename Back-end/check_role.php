<?php

include_once $_SERVER['DOCUMENT_ROOT']."/biblioexchange/Back-end/get_user_data.php";

//Récupérer le path auquel le user veut accéder : s'il contient admin et role != admin rediction vers acceuil.php

$current_page = $_SERVER['REQUEST_URI'];

if (strpos($current_page, 'Administrateur') !== false && $role !== "admin") {
    $url = "Location: ../acceuil.php";
    header($url);
    exit;
}
elseif($role === "admin" && strpos($current_page, 'Administrateur') === false)
{
    $url = "Location: Administrateur/accueil.php";
    header($url);
    exit;
}
?>