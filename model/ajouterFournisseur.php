<?php
include 'connexion.php';
session_start();

if (
    !empty($_POST['nomFour']) &&
    !empty($_POST['prenomFour']) &&
    !empty($_POST['teleFour']) &&
    !empty($_POST['addFour']) 
) {
    $sql = "INSERT INTO fournisseur (nomFour, prenomFour, teleFour, addFour) VALUES (?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    if ($req->execute(array(
        $_POST['nomFour'],
        $_POST['prenomFour'],
        $_POST['teleFour'],
        $_POST['addFour']
    ))) {
        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Fournisseur ajouté avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout du Fournisseur";
            $_SESSION['message']['type'] = "danger";
        }
    } else {
        $_SESSION['message']['text'] = "Erreur d'exécution de la requête";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/fournisseur.php');
exit();
?>
