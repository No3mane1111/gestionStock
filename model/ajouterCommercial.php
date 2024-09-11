<?php
include 'connexion.php';
session_start();

if (
    !empty($_POST['nomUser']) &&
    !empty($_POST['prenomUser']) &&
    !empty($_POST['teleUser']) &&
    !empty($_POST['codeUser']) 
) {
    $sql = "INSERT INTO comercial (nomUser, prenomUser, teleUser, codeUser) VALUES (?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    if ($req->execute(array(
        $_POST['nomUser'],
        $_POST['prenomUser'],
        $_POST['teleUser'],
        $_POST['codeUser']
    ))) {
        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Commercial ajouté avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout du Commercial";
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

header('Location: ../vue/commercial.php');
exit();
?>
