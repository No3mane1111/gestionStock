<?php
include "entete.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Articles</title>
    <link rel="stylesheet" href="path/to/boxicons.min.css"> <!-- Assurez-vous d'avoir inclus les icônes de Boxicons -->
    <style>
        .search-box {
            display: flex;
            align-items: center;
            margin-bottom: 20px; /* Ajout d'un espace sous la barre de recherche */
        }
        .search-input {
            padding: 5px;
            font-size: 16px;
            width: 200px; /* Ajustez la largeur selon vos besoins */
        }
        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            font-size: 20px;
        }
        .icon-button i {
            color: #333;
        }
        .alertt {
            padding: 10px;
            background-color: #f44336;
            color: white;
            margin-bottom: 15px;
            width: 300px;
            position: fixed;
            bottom: 10px;
            right: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            z-index: 1000;
        }
        .closebtnn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .closebtnn:hover {
            color: black;
        }
        .mmtable th, .mmtable td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<?php
try {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $search = htmlspecialchars($search); // Sécuriser le terme de recherche

    // Requête pour récupérer les articles
    if (!empty($search)) {
        $sql = "SELECT * FROM article WHERE desiArt LIKE :search";
        $req = $connexion->prepare($sql);
        $req->execute(['search' => '%' . $search . '%']);
    } else {
        $sql = "SELECT * FROM article";
        $req = $connexion->prepare($sql);
        $req->execute();
    }

    $articles = $req->fetchAll(PDO::FETCH_ASSOC);

    // Afficher une alerte si des articles avec qtEntre < 10 sont trouvés
    if (empty($search)) {
        $sqlLowStock = "SELECT * FROM article WHERE qtEntre < 10";
        $reqLowStock = $connexion->prepare($sqlLowStock);
        $reqLowStock->execute();
        $lowStockArticles = $reqLowStock->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($lowStockArticles)) {
            echo '<div class="alertt">';
            echo '<span class="closebtnn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
            echo '<strong>Attention!</strong> Les articles suivants ont une quantité inférieure à 10:<br>';
            foreach ($lowStockArticles as $article) {
                echo htmlspecialchars($article['desiArt']) . " - " . htmlspecialchars($article['qtEntre']) . " en stock.<br>";
            }
            echo '</div>';
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

if(!empty($_GET['idArt'])){
    $article = getArticle($_GET['idArt']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?=  !empty($_GET['idArt']) ? "../model/modifierArticle.php" : "../model/ajouterArticle.php" ?>" method="post">
                <input value="<?=  !empty($_GET['idArt']) ? $article['idArt'] : "" ?>" type="hidden" name="idArt" id="idArt">
                <label for="refArt">Designation de l'article</label>
                <input value="<?=  !empty($_GET['idArt']) ? $article['desiArt'] : "" ?>" type="text" name="desiArt" id="desiArt">
                <br><br>
                <label for="dimArt">Code de l'article</label>
                <input value="<?=  !empty($_GET['idArt']) ? $article['codeArt'] : "" ?>" type="text" name="codeArt" id="codeArt">
                <br><br>
                <label for="dimArt">Quantite de l'article</label>
                <input value="<?=  !empty($_GET['idArt']) ? $article['qtEntre'] : "" ?>" type="number" name="qtEntre" id="qtEntre">
                <br><br>
                <label for="dimArt">Date de l'Entree Stock</label>
                <input value="<?=  !empty($_GET['idArt']) ? $article['dateEntreStock'] : "" ?>" type="date" name="dateEntreStock" id="dateEntreStock">
                <button type="submit" class="custom-button">
                    <?= !empty($_GET['idArt']) ? "Modifier" : "Valider" ?>
                </button>
                <?php
                if(!empty($_SESSION['message']['text'])){
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php 
                }?>      
            </form>
        </div>
        <div class="bbox">
            <table class="mmtable">
                <tr>
                    <th>Designation de l'Article</th>
                    <th>Code de l'Article</th>
                    <th>Quantite de l'Article</th>
                    <th>Date Entree Stock</th>
                    <th>Action</th>
                </tr>
                <?php
                if (!empty($articles) && is_array($articles)) {
                    foreach ($articles as $value) {
                ?>
                        <tr>
                            <td><?= htmlspecialchars($value['desiArt']) ?></td>
                            <td><?= htmlspecialchars($value['codeArt']) ?></td>
                            <td><?= htmlspecialchars($value['qtEntre']) ?></td>
                            <td><?= htmlspecialchars($value['dateEntreStock']) ?></td>
                            <td><a href="?idArt=<?= htmlspecialchars($value['idArt']) ?>"><i class='bx bx-edit-alt'></i></a></td>
                        </tr>
                <?php 
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
</section>
<?php 
include 'pied.php';
?>
</body>
</html>
