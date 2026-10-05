<?php

include("db.php");

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
        nom,
        postnom,
        prenom,
        sexe,
        date_naissance,
        lieu_naissance,
        matricule,
        faculte,
        departement,
        promotion,
        adresse,
        telephone,
        email
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