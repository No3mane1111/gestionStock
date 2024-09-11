<?php
include 'entete.php';

try {
    // Préparation et exécution de la requête pour la première table
    $sql = "
        SELECT 
            d.nomDep, 
            d.respDep, 
            SUM(a.qtAf) AS maxQtAf
        FROM 
            affectation a
        JOIN 
            departement d ON a.idDep = d.idDep
        GROUP BY 
            d.nomDep, d.respDep
        ORDER BY 
            maxQtAf DESC, d.nomDep ASC
    ";
    $req = $connexion->prepare($sql);
    $req->execute();
    
    // Récupération des résultats pour la première table
    $departements = $req->fetchAll(PDO::FETCH_ASSOC);

    // Préparation et exécution de la requête pour la seconde table
    $sql2 = "
        SELECT 
            d.nomDep,
            ar.desiArt,
            DATE_FORMAT(a.dateAf, '%Y-%m') AS mois,
            SUM(a.qtAf) AS qtAfMensuelle
        FROM 
            affectation a
        JOIN 
            departement d ON a.idDep = d.idDep
        JOIN 
            article ar ON a.idArt = ar.idArt
        GROUP BY 
            d.nomDep, ar.desiArt, mois
        ORDER BY 
            d.nomDep, ar.desiArt, mois
    ";
    $req2 = $connexion->prepare($sql2);
    $req2->execute();
    
    // Récupération des résultats pour la seconde table
    $articlesParMois = $req2->fetchAll(PDO::FETCH_ASSOC);

    // Regroupement des articles par nomDep
    $groupedArticles = [];
    foreach ($articlesParMois as $article) {
        $groupedArticles[$article['nomDep']][] = $article;
    }

    // Préparation et exécution de la requête pour le prix des commandes
    $sql3 = "
        SELECT 
            d.nomDep,
            DATE_FORMAT(c.dateCom, '%Y-%m') AS mois,
            SUM(c.prixCom) AS totalPrixCom
        FROM 
            commande c
        JOIN 
            departement d ON c.idArt = d.idDep
        GROUP BY 
            d.nomDep, mois
        ORDER BY 
            d.nomDep, mois
    ";
    $req3 = $connexion->prepare($sql3);
    $req3->execute();
    
    // Récupération des résultats pour le prix des commandes
    $prixComParMois = $req3->fetchAll(PDO::FETCH_ASSOC);

    // Regroupement des prix par nomDep
    $groupedPrixCom = [];
    foreach ($prixComParMois as $prixCom) {
        $groupedPrixCom[$prixCom['nomDep']][] = $prixCom;
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
            font-family: Arial, sans-serif; /* Police pour une meilleure lisibilité */
        }
        .table-container {
            margin-top: 50px; /* Décale le tableau vers le bas */
            width: 80%; /* Largeur du conteneur */
            margin-left: auto;
            margin-right: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f9f9f9; /* Couleur d'arrière-plan du tableau */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Ombre légère */
            border-radius: 8px; /* Coins arrondis */
            margin-bottom: 30px; /* Espace entre les tableaux */
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 16px; /* Taille de la police des cellules */
        }
        .table th {
            background-color: #4CAF50; /* Couleur de l'en-tête */
            color: white; /* Couleur du texte de l'en-tête */
            font-size: 18px; /* Taille de la police de l'en-tête */
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2; /* Couleur des lignes paires */
        }
        .table tr:hover {
            background-color: #ddd; /* Couleur de survol des lignes */
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Liste des Affectations</h2>

<div class="table-container">
    <?php
    // Affichage du premier tableau
    if (!empty($departements)) {
        echo '<table class="table">';
        echo '<tr><th>Nom du Département</th><th>Responsable</th><th>Quantité Affectée</th></tr>';
        foreach ($departements as $departement) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($departement['nomDep']) . '</td>';
            echo '<td>' . htmlspecialchars($departement['respDep']) . '</td>';
            echo '<td>' . htmlspecialchars($departement['maxQtAf']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Aucune affectation trouvée.';
    }

    // Affichage du second tableau
    if (!empty($groupedArticles)) {
        echo '<table class="table">';
        echo '<tr><th>Nom du Département</th><th>Article</th><th>Mois</th><th>Quantité Affectée</th></tr>';
        foreach ($groupedArticles as $nomDep => $articles) {
            $rowspan = count($articles);
            $first = true;
            foreach ($articles as $article) {
                echo '<tr>';
                if ($first) {
                    echo '<td rowspan="' . $rowspan . '">' . htmlspecialchars($nomDep) . '</td>';
                    $first = false;
                }
                echo '<td>' . htmlspecialchars($article['desiArt']) . '</td>';
                echo '<td>' . htmlspecialchars($article['mois']) . '</td>';
                echo '<td>' . htmlspecialchars($article['qtAfMensuelle']) . '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    } else {
        echo 'Aucune donnée trouvée pour les articles par mois.';
    }

    // Affichage du tableau pour le prix des commandes
    if (!empty($groupedPrixCom)) {
        echo '<table class="table">';
        echo '<tr><th>Nom du Département</th><th>Mois</th><th>Prix des Commandes</th></tr>';
        foreach ($groupedPrixCom as $nomDep => $prixComs) {
            $rowspan = count($prixComs);
            $first = true;
            foreach ($prixComs as $prixCom) {
                echo '<tr>';
                if ($first) {
                    echo '<td rowspan="' . $rowspan . '">' . htmlspecialchars($nomDep) . '</td>';
                    $first = false;
                }
                echo '<td>' . htmlspecialchars($prixCom['mois']) . '</td>';
                echo '<td>' . htmlspecialchars($prixCom['totalPrixCom']) . '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    } else {
        echo 'Aucune donnée trouvée pour les prix des commandes.';
    }
    ?>
</div>

</body>
</html>
