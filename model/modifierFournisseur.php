<?php
include 'connexion.php';

if (
    !empty($_POST['nomFour']) &&
    !empty($_POST['prenomFour']) &&
    !empty($_POST['teleFour']) &&
    !empty($_POST['addFour']) &&
    !empty($_POST['idFour'])
  
) {
    $sql = "update fournisseur set nomFour=?, prenomFour=?, teleFour=?, addFour=? where idFour=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nomFour'],
        $_POST['prenomFour'],
        $_POST['teleFour'],
        $_POST['addFour'],
        $_POST['idFour']
       
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Fournisseur modifier avec succès";
        $_SESSION['message']['type']  = "success";
    
    } else {
        $_SESSION['message']['text']  = "Aucun modification";
        $_SESSION['message']['type']  = "danger";
    }
} else {
    $_SESSION['message']['text']  = "une information obligatoire non renseignée";
    $_SESSION['message']['type']  = "danger";
}
header('Location: ../vue/fournisseur.php')
?>
