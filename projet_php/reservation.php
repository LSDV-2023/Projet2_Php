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

// Récupérer les détails de la voiture
$car_id = isset($_GET['car_id']) ? (int)$_GET['car_id'] : 0;
$sql = "SELECT immatriculation, marque, modele, image, compteur FROM voitures WHERE id = $car_id";
$result = $conn->query($sql);
$car = $result->fetch_assoc();

// Variables pour les prix
$prix_par_jour = 75;
$prix_par_100km = 50;
$jours = isset($_POST['jours']) ? (int)$_POST['jours'] : 0;
$kilometres = isset($_POST['kilometres']) ? (int)$_POST['kilometres'] : 0;
$prix = ($jours * $prix_par_jour) + (ceil($kilometres / 100) * $prix_par_100km);

// Enregistrer la réservation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reserver'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $reservation_date = date('Y-m-d');

        $sql_reserve = "INSERT INTO reservations (user_id, car_id, days, kilometers, reservation_date, total_price) VALUES ('$user_id', '$car_id', '$jours', '$kilometres', '$reservation_date', '$prix')";
        if ($conn->query($sql_reserve) === TRUE) {
            $message = "Réservation réussie.";
        } else {
            $message = "Erreur : " . $conn->error;
        }
    } else {
        $message = "Vous devez être connecté pour réserver une voiture.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de voiture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Réservation de voiture</h1>
        <div class="button-container">
            <a href="index.php" class="button">Accueil</a>
        </div>
    </header>
    <main>
        <div class="car-details">
            <?php if ($car): ?>
                <img src="imagesLocauto/<?php echo $car['image']; ?>" alt="Image de <?php echo $car['marque']; ?>">
                <h2><?php echo $car['marque'] . ' ' . $car['modele']; ?></h2>
                <p>Immatriculation: <?php echo $car['immatriculation']; ?></p>
                <p>Compteur: <?php echo $car['compteur']; ?></p>
            <?php else: ?>
                <p>Voiture non trouvée.</p>
            <?php endif; ?>
        </div>
        <div class="reservation-form">
            <form method="POST" action="">
                <label for="jours">Nombre de jours:</label>
                <input type="number" id="jours" name="jours" value="<?php echo $jours; ?>" required>
                <label for="kilometres">Nombre de kilomètres:</label>
                <input type="number" id="kilometres" name="kilometres" value="<?php echo $kilometres; ?>" required>
                <input type="submit" name="calculer" value="Calculer le prix">
                <input type="submit" name="reserver" value="Réserver">
            </form>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                <div class="prix">
                    <p>Prix total: <?php echo $prix; ?> €</p>
                    <?php if (isset($message)): ?>
                        <p><?php echo $message; ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
