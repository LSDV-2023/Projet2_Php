<?php
session_start();

// Connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "locauto";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Traiter la recherche
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT id, immatriculation, marque, modele, image, compteur FROM voitures";
if ($search) {
    $sql .= " WHERE marque LIKE '%$search%' OR modele LIKE '%$search%' OR immatriculation LIKE '%$search%' OR compteur LIKE '%$search%'";
}

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Voitures</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Liste des Voitures</h1>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Rechercher par modèle, marque, etc." />
            <input type="submit" value="Rechercher" />
        </form>
        <div class="button-container">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="button">Se déconnecter</a>
            <?php else: ?>
                <a href="login.php" class="button">Se connecter</a>
                <a href="signup.php" class="button">S'inscrire</a>
            <?php endif; ?>
        </div>
        <div class="button-container">
            <a href="index.php" class="button">Accueil</a>
        </div>
    </header>
    <main>
        <section id="car-list">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='car'>";
                    echo "<a href='reservation.php?car_id={$row['id']}'>";
                    echo "<img src='imagesLocauto/{$row['image']}' alt='Image de {$row['marque']}'>";
                    echo "<h2>{$row['marque']} {$row['modele']}</h2>";
                    echo "<p>Immatriculation: {$row['immatriculation']}</p>";
                    echo "<p>Compteur: {$row['compteur']}</p>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "Aucune voiture disponible.";
            }
            ?>
        </section>
    </main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<footer>
    <p>Réalisé par Lucas Eveillard et Louis Bouhours</p>
</footer>
</html>
