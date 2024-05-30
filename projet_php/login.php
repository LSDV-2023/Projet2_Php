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

// Processus de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql_login = "SELECT id, password FROM users WHERE username='$username'";
    $result_login = $conn->query($sql_login);

    if ($result_login->num_rows > 0) {
        $row = $result_login->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            $login_error = "Mot de passe incorrect.";
        }
    } else {
        $login_error = "Aucun utilisateur trouvé avec ce name d'utilisateur.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Se connecter</h1>
    </header>
    <main>
        <form method="POST" action="">
            <input type="hidden" name="login" value="1">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Se connecter">
            <?php if (isset($login_error)) { echo "<p style='color: red;'>$login_error</p>"; } ?>
        </form>
        <p>Pas encore inscrit? <a href="signup.php">S'inscrire</a></p>
    </main>
</body>
</html>
