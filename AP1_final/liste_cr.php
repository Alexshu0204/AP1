<?php
session_start();

// Connexion à la base de données
$objetPdo = new PDO('mysql:host=localhost;dbname=apcr', 'root', 'root');

// Récupérer les données
$pdoStat = $objetPdo->prepare("SELECT * FROM cr");
$executeIsOk = $pdoStat->execute();
$cr = $pdoStat->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste compte rendu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            text-align: center;
        }

        .action-btn:hover {
            background-color: #0056b3;
        }

        .action-form {
            display: inline;
        }
    </style>
</head>
<body>

    <h1>Liste des comptes rendus</h1>

    <table>
        <thead>
            <tr>
                <th>Date de création</th>
                <th>Description</th>
                <th>Date de modification</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cr as $Cr): ?>
                <tr>
                    <td><?= htmlspecialchars($Cr['datecreation']) ?></td>
                    <td><?= htmlspecialchars($Cr['description']) ?></td>
                    <td><?= htmlspecialchars($Cr['datemodification']) ?></td>
                    <td>
                        <form action="creer_cr.php" method="POST" class="action-form">
                            <input type="hidden" name="id_cr" value="<?= $Cr['id'] ?>">
                            <button type="submit" class="action-btn">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
