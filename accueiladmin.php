<?php
session_start();
if (empty($_SESSION['admin_logged'])) {
    header('Location: loginadmin.php'); exit;
}
require 'db.php';

if (isset($_POST['add_employe'])) {
    $u =$_POST['username'];
    $p =$_POST['password'];
    $conn->query("INSERT INTO employes (username, password) VALUES ('$u','$p')");
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM employes WHERE id=$id");
}

if (isset($_POST['assign_task'])) {
    $employe_id = (int)$_POST['employe_id'];
    $desc = $conn->real_escape_string($_POST['description']);
    $conn->query("INSERT INTO taches (employe_id, description) VALUES ($employe_id,'$desc')");
}

$employes = $conn->query("SELECT * FROM employes");
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Gestion des Employés</title>
  <link rel="stylesheet" href="Styles/Styleacheuiladm.css">
</head>
<body>
    
  <div class="container">
    <h2>Bienvenue Admin</h2>
    <a class="btn logout" href="logout.php">Déconnexion</a>

    <h3>Nouveau Employé</h3>
    <form method="post">
        <input type="text" name="username" placeholder="Nom d'employé" required>
        <input type="password" name="password" placeholder="Clé d entrée " required>
        <button type="submit" name="add_employe" class="btn">Ajouter</button>
    </form>

    <h3>Liste des Employés</h3>
    <table>
      <tr><th>ID</th><th>Nom</th><th>Action</th></tr>
      <?php while($row = $employes->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['username'] ?></td>
          <td><a class="btn delete" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a></td>

        </tr>
      <?php endwhile; ?>
    </table>

    <h3>Assigner Les Tâche</h3>
    <form method="post">
        <select name="employe_id" required>
            <option value="">Choisir un employé </option>
            <?php
            $res = $conn->query("SELECT id, username FROM employes");
            while($e = $res->fetch_assoc()) {
                echo "<option value='{$e['id']}'>{$e['username']}</option>";
            }
            ?>
        </select><br>
        <textarea name="description" placeholder="Description de la tâche" required></textarea><br>
        <button type="submit" name="assign_task" class="btn">Assigner</button>
    </form>
  </div>
</body>
</html>
