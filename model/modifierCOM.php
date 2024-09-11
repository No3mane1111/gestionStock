<?php
include 'connexion.php'; // Assurez-vous d'inclure votre connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idFour = $_POST['idFour'];
    $dateEntre = $_POST['dateEntre'];
    $idCom = !empty($_POST['idCom']) ? $_POST['idCom'] : null;

    $idArts = $_POST['idArt'];
    $qtComs = $_POST['qtCom'];
    $prixUnitComs = $_POST['prixUnitCom'];
    $prixComs = $_POST['prixCom'];

    // Si modification, supprimez d'abord les anciens articles de la commande
    if ($idCom) {
        $query = "DELETE FROM commande_articles WHERE idCom = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $idCom);
        $stmt->execute();
    } else {
        // Insérez la commande pour obtenir un nouvel ID
        $query = "INSERT INTO commande (idFour, dateEntre) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $idFour, $dateEntre);
        $stmt->execute();
        $idCom = $stmt->insert_id;
    }

    // Insérez chaque article dans la commande
    foreach ($idArts as $index => $idArt) {
        $qtCom = $qtComs[$index];
        $prixUnitCom = $prixUnitComs[$index];
        $prixCom = $prixComs[$index];

        $query = "INSERT INTO commande_articles (idCom, idArt, quantiteCom, prixUnitCom, prixCom) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiidd", $idCom, $idArt, $qtCom, $prixUnitCom, $prixCom);
        $stmt->execute();
    }

    // Redirigez ou affichez un message de succès
    header("Location: ../view/commandeTest.php");
}
?>
