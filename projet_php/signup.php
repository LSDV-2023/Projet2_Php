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

// Processus d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $sql_signup = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql_signup) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Erreur : " . $sql_signup . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-grid.css">
</head>
<body>
    <header>
        <h1>S'inscrire</h1>
    </header>
    <main>
        <form method="POST" action="">
            <input type="hidden" name="signup" value="1">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="S'inscrire">
        </form>
        <p>Déjà inscrit? <a href="login.php">Se connecter</a></p>
    </main>
</body>
</html>
