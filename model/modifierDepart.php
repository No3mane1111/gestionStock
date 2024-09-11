<?php
include 'connexion.php';

if (
    !empty($_POST['nomDep']) &&
    !empty($_POST['respDep']) &&
    !empty($_POST['idDep'])
  
) {
    $sql = "update departement set nomDep=?, respDep=? where idDep=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nomDep'],
        $_POST['respDep'],
        $_POST['idDep']
       
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Departement modifier avec succès";
        $_SESSION['message']['type']  = "success";
    
    } else {
        $_SESSION['message']['text']  = "Aucun modification";
        $_SESSION['message']['type']  = "danger";
    }
} else {
    $_SESSION['message']['text']  = "une information obligatoire non renseignée";
    $_SESSION['message']['type']  = "danger";
}
header('Location: ../vue/departement.php')
?>
