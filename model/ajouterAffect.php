<?php
include 'connexion.php';
include_once 'function.php';
session_start();

if (
    !empty($_POST['idArticle']) &&
    !empty($_POST['idDep']) &&
    !empty($_POST['qtAf']) &&
    !empty($_POST['dateSortie'])
) {
    $article = getArticle($_POST['idArticle']);

    if (!empty($article) && is_array($article)) {
        if ($_POST['qtAf'] > $article['qtEntre']) {
            $_SESSION['message']['text'] = "La quantité à affecter n'est pas disponible";
            $_SESSION['message']['type'] = "danger";
        } else {
            $sql = "INSERT INTO affectation (idArt, idDep, qtAf, dateAf) VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);

            $req->execute([
                $_POST['idArticle'],
                $_POST['idDep'],
                $_POST['qtAf'],
                $_POST['dateSortie']
            ]);

            if ($req->rowCount() != 0) {
                $sql = "UPDATE article SET qtEntre = qtEntre - ? WHERE idArt = ?";
                $req = $connexion->prepare($sql);

                $req->execute([
                    $_POST['qtAf'],
                    $_POST['idArticle']
                ]);

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Affectation effectuée avec succès";
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
        $_SESSION['message']['text'] = "L'article spécifié n'existe pas";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/affectation.php');
exit();
?>
