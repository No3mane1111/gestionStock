<?php
include 'connexion.php';
include_once 'function.php';
session_start();

if (
    !empty($_POST['idArticle']) &&
    !empty($_POST['idDep']) &&
    !empty($_POST['qtAf']) &&
    !empty($_POST['dateSortie']) &&
    !empty($_POST['idAf'])
) {
    try {
        $sql = "UPDATE affectation SET idArt = ?, idDep = ?, qtAf = ?, dateAf = ? WHERE idAf = ?";
        $req = $connexion->prepare($sql);

        $req->execute(array(
            htmlspecialchars($_POST['idArticle']),
            htmlspecialchars($_POST['idDep']),
            htmlspecialchars($_POST['qtAf']),
            htmlspecialchars($_POST['dateSortie']),
            htmlspecialchars($_POST['idAf'])
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Affectation modifiée avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Aucune modification";
            $_SESSION['message']['type'] = "danger";
        }
    } catch (PDOException $e) {
        $_SESSION['message']['text'] = "Erreur lors de la modification: " . $e->getMessage();
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/affectation.php');
exit();
?>
