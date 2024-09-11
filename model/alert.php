<?php
include 'connexion.php';

try {
    // Préparation et exécution de la requête pour récupérer les articles avec qtEntre < 10
    $sql = "SELECT * FROM article WHERE qtEntre < 10";
    $req = $connexion->prepare($sql);
    $req->execute();
    
    // Récupération des résultats
    $articles = $req->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
