<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
        // Redirection vers la page signup.php avec le paramètre registered=true
        header("Location: signup.php?registered=true");
        exit();
    } else {
        echo "Erreur : " . $sql_signup . "<br>" . $conn->error;
    }
}

$conn->close();
?>
