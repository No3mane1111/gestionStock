<?php
include 'entete2.php';
// Assuming this sets up $connexion

// Variables pour stocker les termes de recherche
$searchTerm = '';
$searchType = 'desiArt';

if (isset($_POST['search']) && isset($_POST['type'])) {
    $searchTerm = $_POST['search'];
    $searchType = $_POST['type'];
}

try {
    // Préparation de la requête SQL avec les conditions de recherche
    $sql = "
        SELECT 
            a.codeArt,
            a.desiArt,
            a.qtEntre,
            a.dateEntreStock,
            af.qtAf,
            af.DateAf AS dateSortie,
            d.nomDep
        FROM 
            article a
        JOIN 
            affectation af ON a.idArt = af.idArt
        JOIN 
            departement d ON af.idDep = d.idDep
    ";

    $conditions = [];
    $params = [];
    
    if ($searchTerm) {
        if ($searchType == 'codeArt') {
            $conditions[] = "a.codeArt LIKE :searchTerm";
            $params[':searchTerm'] = '%' . $searchTerm . '%';
        } elseif ($searchType == 'desiArt') {
            $conditions[] = "a.desiArt LIKE :searchTerm";
            $params[':searchTerm'] = '%' . $searchTerm . '%';
        } elseif ($searchType == 'nomDep') {
            $conditions[] = "d.nomDep LIKE :searchTerm";
            $params[':searchTerm'] = '%' . $searchTerm . '%';
        }
    }

    if (!empty($conditions)) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }

    $req = $connexion->prepare($sql);

    foreach ($params as $key => $value) {
        $req->bindValue($key, $value);
    }
    
    $req->execute();
    
    // Récupération des résultats pour la table
    $articles = $req->fetchAll(PDO::FETCH_ASSOC);

    // Regroupement des articles par nomDep
    $groupedArticles = [];
    foreach ($articles as $article) {
        $groupedArticles[$article['nomDep']][] = $article;
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Affectations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table-container {
            margin-top: 50px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 16px; /* Taille de la police des cellules */
        }
        .table th {
            background-color: #4CAF50;
            color: white;
            font-size: 18px; /* Taille de la police de l'en-tête */
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #ddd;
        }
        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 16px;
        }
        .search-bar select {
            padding: 10px;
            font-size: 16px;
        }
        .search-bar input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .search-bar input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Liste des Affectations</h2>

<div class="search-bar">
    <form method="POST" action="">
        <input type="text" name="search" placeholder="Rechercher un article" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <select name="type">
            <option value="desiArt" <?php if ($searchType == 'desiArt') echo 'selected'; ?>>Désignation</option>
            <option value="codeArt" <?php if ($searchType == 'codeArt') echo 'selected'; ?>>Code</option>
            <option value="nomDep" <?php if ($searchType == 'nomDep') echo 'selected'; ?>>Nom Département</option>
        </select>
        <input type="submit" value="Rechercher">
    </form>
</div>



<div class="table-container">
    <?php
    // Affichage de la table
    if (!empty($groupedArticles)) {
        echo '<table class="table">';
        echo '<tr><th>Nom Département</th><th>Code Article</th><th>Designation Article</th><th>Quantité stock</th><th>Date Entrée Stock</th><th>Quantité Affectée</th><th>Date Sortie</th></tr>';
        foreach ($groupedArticles as $nomDep => $articles) {
            $rowspan = count($articles);
            $first = true;
            foreach ($articles as $article) {
                echo '<tr>';
                if ($first) {
                    echo '<td rowspan="' . $rowspan . '">' . htmlspecialchars($nomDep) . '</td>';
                    $first = false;
                }
                echo '<td>' . htmlspecialchars($article['codeArt']) . '</td>';
                echo '<td>' . htmlspecialchars($article['desiArt']) . '</td>';
                echo '<td>' . htmlspecialchars($article['qtEntre']) . '</td>';
                echo '<td>' . htmlspecialchars($article['dateEntreStock']) . '</td>';
                echo '<td>' . htmlspecialchars($article['qtAf']) . '</td>';
                echo '<td>' . htmlspecialchars($article['dateSortie']) . '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    } else {
        echo 'Aucune affectation trouvée.';
    }
    ?>
</div>

</body>
</html>
