<?php

include("db.php");

/* Statistiques */
$total = pg_query($conn, "SELECT COUNT(*) AS total FROM etudiants");

if (!$total) {
    die("Erreur : " . pg_last_error($conn));
}

$data = pg_fetch_assoc($total);

/* Liste des étudiants */
$sql = "SELECT * FROM etudiants ORDER BY id DESC";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Erreur : " . pg_last_error($conn));
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Gestion des étudiants</title>

<style>

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

.stats {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    flex: 1;
    background: white;
    padding: 20px;
    text-align: center;
    box-shadow: 0px 0px 5px gray;
    border-radius: 8px;
}

.card h2 {
    color: #2c5aa0;
    font-size: 30px;
}

/* Formulaire */

.form-box {
    background: white;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0px 0px 5px gray;
    border-radius: 8px;
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
    padding: 10px 15px;
    background: #2c5aa0;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 15px;
}

button:hover {
    background: #1f3c88;
}

/* Tableau */

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0px 0px 5px gray;
}

th,
td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background: #2c5aa0;
    color: white;
}

.btn-danger {
    background: red;
    padding: 6px 10px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.btn-danger:hover {
    background: darkred;
}

</style>

</head>

<body>

<h1>Gestion des Étudiants</h1>


<!-- STATISTIQUES -->

<div class="stats">

    <div class="card">

        <h2>
            <?php echo $data['total']; ?>
        </h2>

        <p>Total Étudiants</p>

    </div>

</div>


<!-- FORMULAIRE AJOUT -->

<div class="form-box">

<h2>Ajouter un étudiant</h2>

<form action="traitement_etudiant.php" method="POST">

    <input
        type="text"
        name="nom"
        placeholder="Nom"
        required
    >

    <input
        type="text"
        name="postnom"
        placeholder="Postnom"
        required
    >

    <input
        type="text"
        name="prenom"
        placeholder="Prénom"
        required
    >

    <select name="sexe" required>

        <option value="">
            -- Sélectionner le sexe --
        </option>

        <option value="M">
            Masculin
        </option>

        <option value="F">
            Féminin
        </option>

    </select>

    <input
        type="date"
        name="date_naissance"
    >

    <input
        type="text"
        name="lieu_naissance"
        placeholder="Lieu de naissance"
    >

    <input
        type="text"
        name="matricule"
        placeholder="Matricule"
        required
    >

    <input
        type="text"
        name="faculte"
        placeholder="Faculté"
    >

    <input
        type="text"
        name="departement"
        placeholder="Département"
    >

    <input
        type="text"
        name="promotion"
        placeholder="Promotion"
    >

    <input
        type="text"
        name="adresse"
        placeholder="Adresse"
    >

    <input
        type="text"
        name="telephone"
        placeholder="Téléphone"
    >

    <input
        type="email"
        name="email"
        placeholder="Email"
    >

    <button type="submit" name="enregistrer">
        Ajouter étudiant
    </button>

</form>

</div>


<!-- LISTE DES ETUDIANTS -->

<h2>Liste des étudiants</h2>

<table>

<tr>

    <th>ID</th>
    <th>Nom</th>
    <th>Postnom</th>
    <th>Prénom</th>
    <th>Matricule</th>
    <th>Faculté</th>
    <th>Département</th>
    <th>Promotion</th>
    <th>Action</th>

</tr>


<?php

while ($row = pg_fetch_assoc($result)) {

?>

<tr>

    <td>
        <?php echo htmlspecialchars($row['id']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($row['nom']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($row['postnom']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($row['prenom']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($row['matricule']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($row['faculte']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($row['departement']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($row['promotion']); ?>
    </td>

    <td>

        <a
            class="btn-danger"
            href="supprimer_etudiant.php?id=<?php echo $row['id']; ?>"
            onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');"
        >
            Supprimer
        </a>

    </td>

</tr>

<?php

}

?>

</table>

</body>

</html>