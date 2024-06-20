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

// Processus de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql_login = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql_login);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Connexion réussie
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");  // Redirection vers l'accueil
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Adresse email ou mot de passe incorrecte.";
        header("Location: signup.php?incorrect=true");
    }
}

$conn->close();
?>
