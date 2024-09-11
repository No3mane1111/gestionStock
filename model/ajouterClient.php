<?php
include 'connexion.php';
session_start();

if (
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['tele']) &&
    !empty($_POST['adr']) 
) {
    $sql = "INSERT INTO client (nom, prenom, tele, adr) VALUES (?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    if ($req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['tele'],
        $_POST['adr']
    ))) {
        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Client ajouté avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout du client";
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

header('Location: ../vue/client.php');
exit();
?>
