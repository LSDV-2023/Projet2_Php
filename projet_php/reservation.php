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

if (!isset($_GET['car_id'])) {
    die("ID de voiture non spécifié.");
}

$car_id = $conn->real_escape_string($_GET['car_id']);
$sql = "SELECT id, immatriculation, marque, modele, image, compteur FROM voitures WHERE id = '$car_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Voiture non trouvée.");
}

$car = $result->fetch_assoc();

// Processus de réservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $days = intval($_POST['days']);
    $kilometers = intval($_POST['kilometers']);
    $reservation_date = date('Y-m-d');

    $sql_reserve = "INSERT INTO reservations (user_id, car_id, days, kilometers, reservation_date) VALUES ('$user_id', '$car_id', '$days', '$kilometers', '$reservation_date')";
    if ($conn->query($sql_reserve) === TRUE) {
        echo "Réservation réussie.";
    } else {
        echo "Erreur : " . $sql_reserve . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver une voiture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Réserver la voiture</h1>
    </header>
    <main>
        <div class="car">
            <img src="/projet_php/imagesLocauto/<?php echo $car['image']; ?>" alt="Image de <?php echo $car['marque']; ?>">
            <h2><?php echo $car['marque'] . ' ' . $car['modele']; ?></h2>
            <p>Immatriculation: <?php echo $car['immatriculation']; ?></p>
            <p>Compteur: <?php echo $car['compteur']; ?></p>
        </div>
        <?php if(isset($_SESSION['user_id'])): ?>
            <form method="POST" action="">
                <label for="days">Nombre de jours:</label>
                <input type="number" name="days" id="days" required>
                <label for="kilometers">Nombre de kilomètres:</label>
                <input type="number" name="kilometers" id="kilometers" required>
                <input type="submit" value="Réserver">
            </form>
        <?php else: ?>
            <p>Vous devez être <a href="login.php">connecté</a> pour réserver une voiture.</p>
        <?php endif; ?>
    </main>
</body>
</html>
