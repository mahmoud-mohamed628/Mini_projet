<?php
session_start();
require 'db.php';
if (isset($_POST['submit'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $res = $conn->query("SELECT * FROM employes WHERE username='$u'");
    if ($res->num_rows) {
        $user = $res->fetch_assoc();
        if ($p===$user['password']) {
            $_SESSION['employe_logged'] = $user['id'];
            header('Location: acceuilclient.php'); exit;
        }
    }
    $error = 'Identifiants invalides.';
}
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Gestion des Employés</title>
<link rel="stylesheet" href="Styles/Stylelogin.css">
</head>
<body>
  <div class="container">
  <h2 style="color: white;">Employé Login</h2>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" class="Q" required><br>
        <input type="password" name="password" placeholder="Password" class="Q" required><br>
        <button type="submit" name="submit" class="Connexion">Connexion</button>
    </form>
    <p><a class="btn" href="index.php">Retour</a></p>
  </div>
</body></html>
