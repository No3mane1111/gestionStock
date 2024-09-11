<?php
include 'connexion.php';

if (
    
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['tele']) &&
    !empty($_POST['adr']) &&
    !empty($_POST['id'])
  
) {
    $sql = "update client set nom=?, prenom=?, tele=?, adr=? where id=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['tele'],
        $_POST['adr'],
        $_POST['id']
       
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Client modifier avec succès";
        $_SESSION['message']['type']  = "success";
    
    } else {
        $_SESSION['message']['text']  = "Aucun modification";
        $_SESSION['message']['type']  = "danger";
    }
} else {
    $_SESSION['message']['text']  = "une information obligatoire non renseignée";
    $_SESSION['message']['type']  = "danger";
}
header('Location: ../vue/client.php')
?>
