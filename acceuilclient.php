<?php
session_start();
if (empty($_SESSION['employe_logged'])) {
    header('Location: loginclient.php'); exit;
}
require 'db.php';

$employe_id = (int)$_SESSION['employe_logged'];
$taches = $conn->query("SELECT description, date_assignee FROM taches WHERE employe_id=$employe_id ORDER BY date_assignee DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion des Employés</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #16a34a;
            font-size: 24px;
            margin-bottom: 24px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            color: white;
        }

        .logout {
            background-color: #dc2626;
            float: right;
            margin-bottom: 20px;
        }

        .logout:hover {
            background-color: #b91c1c;
        }

        .back {
            background-color: #16a34a;
        }

        .back:hover {
            background-color: #15803d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
        }

        tr:hover {
            background-color: #f3f4f6;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

    </style>
</head>
<body>
    <div class="container">
        <a class="btn logout" href="logout.php">Logout</a>
        <h2>Vos Tâches</h2>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($t = $taches->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $t['description']; ?></td>
                        <td><?php echo $t['date_assignee']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="footer">
            <a class="btn back" href="index.php">Retour</a>
        </div>
    </div>
</body>
</html>
