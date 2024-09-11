<?php
include 'connexion.php';
session_start(); // Assurez-vous de démarrer la session si ce n'est pas déjà fait

if (!empty($_POST['nomDep']) && !empty($_POST['respDep'])) {
    $sql = "INSERT INTO departement (nomDep, respDep) VALUES (?, ?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nomDep'],
        $_POST['respDep']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Département ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout du département";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/departement.php');
exit(); // Assurez-vous de terminer le script après la redirection
?>
