<?php
include 'connexion.php';

if(
    !empty($_GET['idCom'])&&
    !empty($_GET['qtCom'])&&
    !empty($_GET['idArt'])
    
   
){
    $sql = "UPDATE commande set etat='0' where idCom=?";
    $req = $connexion->prepare($sql);
    $req->execute(array($_GET['idCom']));

    if($req->rowCount()!=0){
        $sql = "UPDATE article set qtEntre = qtEntre-? where idArt=?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['qtCom'],$_GET['idArt']));

    }
    
}

header('Location: ../vue/commande.php');