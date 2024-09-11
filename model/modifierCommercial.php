<?php
include 'connexion.php';

if (
    !empty($_POST['codeUser']) &&
    !empty($_POST['nomUser']) &&
    !empty($_POST['prenomUser']) &&
    !empty($_POST['teleUser']) &&
    !empty($_POST['idUser'])
) {
    $sql = "UPDATE comercial SET codeUser=?, nomUser=?, prenomUser=?, teleUser=? WHERE idUser=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['codeUser'],
        $_POST['nomUser'],
        $_POST['prenomUser'],
        $_POST['teleUser'],
        $_POST['idUser']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Commercial modifié avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Aucune modification";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}
header('Location: ../vue/commercial.php');
?>
