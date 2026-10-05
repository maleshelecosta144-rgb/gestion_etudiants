<?php

include("db.php");

/* Vérifier si l'ID existe */
if (!isset($_GET['id'])) {
    die("ID de l'étudiant manquant.");
}

$id = $_GET['id'];

/* Récupérer l'étudiant */
$sql = "SELECT * FROM etudiants WHERE id = $1";
$result = pg_query_params($conn, $sql, [$id]);

if (!$result) {
    die("Erreur : " . pg_last_error($conn));
}

$etudiant = pg_fetch_assoc($result);

if (!$etudiant) {
    die("Étudiant introuvable.");
}


/* Enregistrer les modifications */
if (isset($_POST['modifier'])) {

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

    $sql = "UPDATE etudiants SET
        nom = $1,
        postnom = $2,
        prenom = $3,
        sexe = $4,
        date_naissance = $5,
        lieu_naissance = $6,
        matricule = $7,
        faculte = $8,
        departement = $9,
        promotion = $10,
        adresse = $11,
        telephone = $12,
        email = $13
        WHERE id = $14";

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
        $email,
        $id
    ]);

    if ($result) {

        header("Location: LISTEeTUDIANT.php");
        exit;

    } else {

        echo "Erreur lors de la modification : ";
        echo pg_last_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Modifier un étudiant</title>

<style>

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 20px;
}

.container {
    width: 600px;
    margin: 30px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px gray;
}

h1 {
    text-align: center;
    color: #2c5aa0;
}

input,
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 12px;
    background: #2c5aa0;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #1f3c88;
}

.retour {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: #2c5aa0;
}

</style>

</head>

<body>

<div class="container">

<h1>Modifier un étudiant</h1>

<form method="POST">

<input
    type="text"
    name="nom"
    placeholder="Nom"
    value="<?php echo htmlspecialchars($etudiant['nom']); ?>"
    required
>

<input
    type="text"
    name="postnom"
    placeholder="Postnom"
    value="<?php echo htmlspecialchars($etudiant['postnom']); ?>"
    required
>

<input
    type="text"
    name="prenom"
    placeholder="Prénom"
    value="<?php echo htmlspecialchars($etudiant['prenom']); ?>"
    required
>

<select name="sexe" required>

<option value="">-- Sélectionner le sexe --</option>

<option value="M"
<?php if ($etudiant['sexe'] == 'M') echo 'selected'; ?>>
Masculin
</option>

<option value="F"
<?php if ($etudiant['sexe'] == 'F') echo 'selected'; ?>>
Féminin
</option>

</select>

<input
    type="date"
    name="date_naissance"
    value="<?php echo htmlspecialchars($etudiant['date_naissance'] ?? ''); ?>"
>

<input
    type="text"
    name="lieu_naissance"
    placeholder="Lieu de naissance"
    value="<?php echo htmlspecialchars($etudiant['lieu_naissance'] ?? ''); ?>"
>

<input
    type="text"
    name="matricule"
    placeholder="Matricule"
    value="<?php echo htmlspecialchars($etudiant['matricule']); ?>"
    required
>

<input
    type="text"
    name="faculte"
    placeholder="Faculté"
    value="<?php echo htmlspecialchars($etudiant['faculte'] ?? ''); ?>"
>

<input
    type="text"
    name="departement"
    placeholder="Département"
    value="<?php echo htmlspecialchars($etudiant['departement'] ?? ''); ?>"
>

<input
    type="text"
    name="promotion"
    placeholder="Promotion"
    value="<?php echo htmlspecialchars($etudiant['promotion'] ?? ''); ?>"
>

<input
    type="text"
    name="adresse"
    placeholder="Adresse"
    value="<?php echo htmlspecialchars($etudiant['adresse'] ?? ''); ?>"
>

<input
    type="text"
    name="telephone"
    placeholder="Téléphone"
    value="<?php echo htmlspecialchars($etudiant['telephone'] ?? ''); ?>"
>

<input
    type="email"
    name="email"
    placeholder="Email"
    value="<?php echo htmlspecialchars($etudiant['email'] ?? ''); ?>"
>

<button type="submit" name="modifier">
    Enregistrer les modifications
</button>

</form>

<a class="retour" href="LISTEeTUDIANT.php">
    ← Retour à la liste des étudiants
</a>

</div>

</body>

</html>