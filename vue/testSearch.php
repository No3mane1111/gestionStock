<?php
include_once '../model/function.php';

// Assurez-vous que $connexion est défini dans function.php
global $connexion;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Bar using PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #007bff;
            padding: 10px 20px;
        }
        .navbar img {
            height: 40px;
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .navbar li {
            margin-left: 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }
        .navbar a:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>

<div class="navbar">
    <img src="logo.png" alt="Logo">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="articles.php">Articles</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
    </ul>
</div>

<div class="container">
    <form method="post">
        <label for="search">Search by Reference</label>
        <input type="text" name="search" id="search">
        <input type="submit" name="submit" value="Search">
    </form>

    <?php
    if (isset($_POST["submit"])) {
        $str = $_POST["search"];
        // Utilisation d'une requête paramétrée pour éviter les injections SQL
        $sth = $connexion->prepare("SELECT * FROM article WHERE refArt = :refArt");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->execute([':refArt' => $str]);

        $results = $sth->fetchAll();
        if ($results) {
            ?>
            <table>
                <tr>
                    <th>Reference</th>
                    <th>Dimension</th>
                    <th>Quantite</th>
                    <th>Emballage</th>
                    <th>Piece</th>
                    <th>Prix Unitaire</th>
                    <th>Origine</th>
                    <th>Categorie</th>
                    <th>Nombre de Points</th>
                </tr>
                <?php foreach ($results as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row->refArt); ?></td>
                    <td><?php echo htmlspecialchars($row->dimArt); ?></td>
                    <td><?php echo htmlspecialchars($row->quantiteArt); ?></td>
                    <td><?php echo htmlspecialchars($row->embalArt); ?></td>
                    <td><?php echo htmlspecialchars($row->pieceArt); ?></td>
                    <td><?php echo htmlspecialchars($row->prixUnitArt); ?></td>
                    <td><?php echo htmlspecialchars($row->origArt); ?></td>
                    <td><?php echo htmlspecialchars($row->categorieArt); ?></td>
                    <td><?php echo htmlspecialchars($row->nbrPoint); ?></td>
                </tr>
                <?php } ?>
            </table>
            <?php
        } else {
            echo "No articles found with the given reference.";
        }
    }
    ?>
</div>

</body>
</html>
