<?php

$database_url = getenv("DATABASE_URL");

if (!$database_url) {
    die("Erreur : DATABASE_URL n'est pas configurée.");
}

$conn = pg_connect($database_url);

if (!$conn) {
    die("Erreur de connexion à la base de données.");
}

?>
