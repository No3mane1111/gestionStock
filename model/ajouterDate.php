<?php
include 'connexion.php';

if (
    
    !empty($_POST['datee']) 
   
    
) {
    $sql = "INSERT INTO datee (datee) VALUES (?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        
        $_POST['datee'],
       
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Date ajouté avec succès";
        $_SESSION['message']['type']  = "success";
    
    } else {
        $_SESSION['message']['text']  = "une erreur d'ajout du Date";
        $_SESSION['message']['type']  = "danger";
    }
} else {
    $_SESSION['message']['text']  = "une information obligatoire non renseignée";
    $_SESSION['message']['type']  = "danger";
}
header('Location: ../vue/Date.php')
?>