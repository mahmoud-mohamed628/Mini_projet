<?php
session_start();
require 'db.php';
if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user === 'admin' && $pass === 'admin123') {
        $_SESSION['admin_logged'] = true;
        header('Location: accueiladmin.php');
        exit;
    } else {
        $error = 'Identifiants incorrects.';
    }
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
  <h2 style="color: white;">Admin Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Username" class="Q" required><br>
      <input type="password" name="password" placeholder="Password" class="Q" required><br>
      <button type="submit" name="submit" class="Connexion">Connexion</button>
    </form>
    <p><a class="btn" href="index.php">Retour</a></p>
  </div>
</body>
</html>
