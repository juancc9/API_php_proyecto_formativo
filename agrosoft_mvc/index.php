<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "router/router.php";

// Si no hay un recurso en la URL, mostrar la vista de inicio
if (!isset($_GET['resource'])) {
    require_once "views/home.php";
    exit; // Evita que siga ejecutando el router
}

// Si hay un recurso, se usa el router


?>
