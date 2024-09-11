<?php
include 'connexion.php';
include_once 'function.php';
session_start();

if (
    !empty($_POST['idArt']) &&
    !empty($_POST['idClient']) &&
    !empty($_POST['prixArt']) &&
    !empty($_POST['qtArt'])
) {
    $article = getArticle($_POST['idArt']);

    if (!empty($article) && is_array($article)) {
        if ($_POST['qtArt'] > $article['quantiteArt']) {
            $_SESSION['message']['text'] = "La quantité à vendre n'est pas disponible";
            $_SESSION['message']['type'] = "danger";
        } else {
            $sql = "INSERT INTO vente (idArt, idClient, prixVente, quantite) VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);

            $req->execute(array(
                $_POST['idArt'],
                $_POST['idClient'],
                $_POST['prixArt'],
                $_POST['qtArt']
            ));

            if ($req->rowCount() != 0) {
                $sql = "UPDATE commande SET quantiteArt = quantiteArt - ? WHERE idArt = ?";
                $req = $connexion->prepare($sql);

                $req->execute(array(
                    $_POST['qtArt'],
                    $_POST['idArt']
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Vente effectuée avec succès";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Impossible d'effectuer cette vente";
                    $_SESSION['message']['type'] = "danger";
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la vente";
                $_SESSION['message']['type'] = "danger";
            }
        }
    } else {
        $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/ventes.php');
exit();
?>
