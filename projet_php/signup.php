<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <div class="main">    
        <input type="checkbox" id="chk" aria-hidden="true" <?php if (isset($_GET['registered']) && $_GET['registered'] == 'true') echo 'checked'; ?>>

        <div class="signup">
            <form method="POST" action="process_signup.php">
                <label for="username" aria-hidden="true">Inscription</label>
                <input type="text" name="username" id="username" placeholder="Utilisateur" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Mot de passe" required="">
                <button type="submit" name="signup">Inscription</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="process_login.php">
                <label for="email" aria-hidden="true">Connexion</label>
                <input type="email" name="email" id="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Mot de passe" required="">
                <button type="submit">Connexion</button>
            </form>
        </div>
    </div>
    <p>Déjà inscrit? <a href="signup.php?registered=true">Se connecter</a></p>
</main>
<div class="button-container">
        <a href="index.php" class="button">Accueil</a>
    </div>
</body>
</html>
