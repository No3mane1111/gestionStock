<?php

include 'connexion.php';




function getDep($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT * FROM departement WHERE idDep = ?"; 
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch(); 
    } else {
        $sql = "SELECT * FROM departement"; 
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll(); 
    }
}
function getArticle($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT * FROM article WHERE idArt = ?"; // username=a or 1=1 --
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch(); 
    } else {
        $sql = "SELECT * FROM article"; 
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll(); 
    }
}


function getClient($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getFournisseur($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE idFour = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getCommercial($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT * FROM comercial WHERE idUser = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM comercial";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getVente($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT 
                    a.idArt,
                    a.desiArt,
                    c.id,
                    c.nom,
                    c.prenom,
                    c.tele,
                    c.adr,
                    v.quantite,
                    v.prixVente,
                    v.dateVente,
                    v.idVente
                FROM 
                    vente v
                JOIN 
                    client c ON v.idClient = c.id
                JOIN 
                    article a ON v.idArt = a.idArt
                WHERE 
                    v.idVente = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT
                    a.idArt,
                    a.desiArt,
                    c.nom,
                    c.prenom,
                    v.quantite,
                    v.prixVente,
                    v.dateVente,
                    v.idVente
                FROM 
                    vente v
                JOIN 
                    client c ON v.idClient = c.id
                JOIN 
                    article a ON v.idArt = a.idArt
                WHERE 
                    v.etat = ?";
        $req = $connexion->prepare($sql);
        $req->execute([1]);
        return $req->fetchAll();
    }
}

function getCommande($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT 
                    a.idArt,
                    a.desiArt,
                    f.idFour,
                    f.nomFour,
                    f.prenomFour,
                    f.teleFour,
                    f.addFour,
                    c.quantiteCom,
                    c.prixCom,
                    c.prixUnitCom,
                    c.dateEntre,
                    c.idCom
                FROM 
                    commande c
                JOIN 
                    fournisseur f ON c.idFour = f.idFour
                JOIN 
                    article a ON c.idArt = a.idArt
                WHERE 
                    c.idCom = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT 
                    a.idArt,
                    a.desiArt,
                    f.idFour,
                    f.nomFour,
                    f.prenomFour,
                    f.teleFour,
                    f.addFour,
                    c.quantiteCom,
                    c.prixCom,
                    c.prixUnitCom,
                    c.dateEntre,
                    c.idCom
                FROM 
                    commande c
                JOIN 
                    fournisseur f ON c.idFour = f.idFour
                JOIN 
                    article a ON c.idArt = a.idArt
               WHERE 
                    c.etat = ?";
        $req = $connexion->prepare($sql);
        $req->execute([1]);
        return $req->fetchAll();
    }
}

function getAffect($id = null) {
    global $connexion;
    
    if (!empty($id)) {
        $sql = "SELECT 
                    a.idArt,
                    a.desiArt,
                    d.idDep,
                    d.nomDep,
                    d.respDep,
                    af.idAf,
                    af.qtAf,
                    af.dateAf
                FROM 
                    affectation af
                JOIN 
                    article a ON af.idArt = a.idArt
                JOIN 
                    departement d ON af.idDep = d.idDep
                WHERE 
                    af.idAf = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch(); // Utilisation de FETCH_ASSOC pour obtenir un tableau associatif
    } else {
        $sql = "SELECT 
                    a.idArt,
                    a.desiArt,
                    d.idDep,
                    d.nomDep,
                    d.respDep,
                    af.idAf,
                    af.qtAf,
                    af.dateAf
                FROM 
                    affectation af
                JOIN 
                    article a ON af.idArt = a.idArt
                JOIN 
                    departement d ON af.idDep = d.idDep
                WHERE 
                    af.etat = ?";
        $req = $connexion->prepare($sql);
        $req->execute([1]);
        return $req->fetchAll(); // Utilisation de FETCH_ASSOC pour obtenir un tableau associatif
    }
}

function getCommande2($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT 
                    a.idArt,
                    a.desiArt,
                    f.idFour,
                    f.nomFour,
                    f.prenomFour,
                    f.teleFour,
                    f.addFour,
                    c.ticketCom,
                    c.quantiteCom,
                    c.prixCom,
                    c.prixUnitCom,
                    c.dateEntre
                FROM 
                    commandetest c
                JOIN 
                    fournisseur f ON c.idFour = f.idFour
                JOIN 
                    article a ON c.idArt = a.idArt
                WHERE 
                    c.ticketCom = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetchAll();
    } else {
        $sql = "SELECT 
                    a.idArt,
                    a.desiArt,
                    f.idFour,
                    f.nomFour,
                    f.prenomFour,
                    f.teleFour,
                    f.addFour,
                    c.ticketCom,
                    c.quantiteCom,
                    c.prixCom,
                    c.prixUnitCom,
                    c.dateEntre
                FROM 
                    commandetest c
                JOIN 
                    fournisseur f ON c.idFour = f.idFour
                JOIN 
                    article a ON c.idArt = a.idArt";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}


function getPrixTTC($id = null) {
    global $connexion;
    if (!empty($id)) {
        $sql = "SELECT 
                    SELECT SUM(prixCom) from commandetest WHERE ticketCom=?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetchAll();
    }
}

?>

