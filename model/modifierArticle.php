<?php
include 'connexion.php';

if (
    !empty($_POST['desiArt']) &&
    !empty($_POST['codeArt']) &&
    !empty($_POST['qtEntre']) &&
    !empty($_POST['dateEntreStock']) &&
    !empty($_POST['idArt'])
) {
    $sql = "update article set desiArt=?, codeArt=?,qtEntre=?,dateEntreStock=? where idArt=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['desiArt'],
        $_POST['codeArt'],
        $_POST['qtEntre'],
        $_POST['dateEntreStock'],
        $_POST['idArt']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "article modifier avec succès";
        $_SESSION['message']['type']  = "success";
    
    } else {
        $_SESSION['message']['text']  = "Rien a modifier";
        $_SESSION['message']['type']  = "danger";
    }
} else {
    $_SESSION['message']['text']  = "une information obligatoire non renseignée";
    $_SESSION['message']['type']  = "danger";
}
header('Location: ../vue/article.php')
?>
