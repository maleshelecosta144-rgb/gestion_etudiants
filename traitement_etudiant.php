<?php

include("db.php");

/* Création automatique de la table */
$create_table = "
CREATE TABLE IF NOT EXISTS etudiants (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    postnom VARCHAR(100),
    prenom VARCHAR(100),
    sexe VARCHAR(20),
    date_naissance DATE,
    lieu_naissance VARCHAR(150),
    matricule VARCHAR(100),
    faculte VARCHAR(150),
    departement VARCHAR(150),
    promotion VARCHAR(100),
    adresse VARCHAR(255),
    telephone VARCHAR(50),
    email VARCHAR(150)
)";

if (!pg_query($conn, $create_table)) {
    die("Erreur lors de la création de la table : " . pg_last_error($conn));
}

if (isset($_POST['enregistrer'])) {

    $nom = $_POST['nom'];
    $postnom = $_POST['postnom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $matricule = $_POST['matricule'];
    $faculte = $_POST['faculte'];
    $departement = $_POST['departement'];
    $promotion = $_POST['promotion'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO etudiants
    (
        nom, postnom, prenom, sexe, date_naissance,
        lieu_naissance, matricule, faculte, departement,
        promotion, adresse, telephone, email
    )
    VALUES
    (
        $1, $2, $3, $4, $5, $6, $7,
        $8, $9, $10, $11, $12, $13
    )";

    $result = pg_query_params($conn, $sql, [
        $nom,
        $postnom,
        $prenom,
        $sexe,
        $date_naissance,
        $lieu_naissance,
        $matricule,
        $faculte,
        $departement,
        $promotion,
        $adresse,
        $telephone,
        $email
    ]);

    if ($result) {

        header("Location: LISTEeTUDIANT.php");
        exit;

    } else {

        echo "Erreur lors de l'enregistrement : ";
        echo pg_last_error($conn);

    }
}

?>
