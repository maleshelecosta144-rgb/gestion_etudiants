<?php

$conn = pg_connect(getenv("DATABASE_URL"));

if (!$conn) {
    die("Erreur de connexion à la base de données.");
}

?>
