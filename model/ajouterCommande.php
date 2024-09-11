<?php
include 'connexion.php';
include_once 'function.php';
session_start();

try {
    if (
        !empty($_POST['idArt']) &&
        !empty($_POST['idFour']) &&
        !empty($_POST['prixCom']) &&
        !empty($_POST['qtCom']) &&
        !empty($_POST['dateEntre']) &&
        !empty($_POST['prixUnitCom'])
    ) {
        // Fetch the article to ensure it exists
        $article = getArticle($_POST['idArt']);
        
        if (!$article) {
            throw new Exception("Article not found with idArt: " . $_POST['idArt']);
        }

        // Fetch the fournisseur to ensure it exists
        $fournisseur = getFournisseur($_POST['idFour']);
        
        if (!$fournisseur) {
            throw new Exception("Fournisseur not found with idFour: " . $_POST['idFour']);
        }

        // Insert the commande
        $sql = "INSERT INTO commande (idArt, idFour, prixCom, quantiteCom, dateEntre,prixUnitCom) VALUES (?, ?, ?, ?,?,?)";
        $req = $connexion->prepare($sql);

        $req->execute(array(
            $_POST['idArt'],
            $_POST['idFour'],
            $_POST['prixCom'],
            $_POST['qtCom'],
            $_POST['dateEntre'],
            $_POST['prixUnitCom']
        ));

        if ($req->rowCount() != 0) {
            // Update the article quantity
            $sql = "UPDATE article SET qtEntre = qtEntre + ? WHERE idArt = ?";
            $req = $connexion->prepare($sql);

            $req->execute(array(
                $_POST['qtCom'], // Corrected variable
                $_POST['idArt']
            ));

            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "Commande effectuée avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Impossible d'effectuer cette Commande";
                $_SESSION['message']['type'] = "danger";
            }
        } else {
            $_SESSION['message']['text'] = "Une erreur s'est produite lors de la Commande";
            $_SESSION['message']['type'] = "danger";
        }
    } else {
        $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
        $_SESSION['message']['type'] = "danger";
    }
} catch (Exception $e) {
    $_SESSION['message']['text'] = "Erreur: " . $e->getMessage();
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/commande.php');
exit();
?>