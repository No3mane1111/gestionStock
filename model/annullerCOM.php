<?php

include 'connexion.php';

if (
    !empty($_GET['ticketCom']) &&
    !empty($_GET['idArt']) &&
    !empty($_GET['qtCom'])
) {
    try {
        // Démarrer une transaction
        $connexion->beginTransaction();

        // Mettre à jour la quantité de l'article
        $sql = "UPDATE article SET qtEntre = qtEntre - ? WHERE idArt = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['quantiteCom'], $_GET['idArt']));

        // Supprimer l'affectation
        $sql = "DELETE FROM commandetest WHERE ticketCom = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['ticketCom']));

        // Commit la transaction si tout s'est bien passé
        $connexion->commit();

        if ($req->rowCount() > 0) {
            $_SESSION['message']['text'] = "La commande a été supprimée avec succès et la quantité de l'article a été mise à jour.";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Aucune commande trouvée à supprimer.";
            $_SESSION['message']['type'] = "danger";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollBack();
        $_SESSION['message']['text'] = "Erreur: " . $e->getMessage();
        $_SESSION['message']['type'] = "danger";
    }
    
    // Redirection vers la page des affectations
    header('Location: ../vue/commande.php');
    exit();
} else {
    // Gestion des cas où les paramètres ne sont pas fournis
    $_SESSION['message']['text'] = "ticket de Commmande, ID de l'article ou quantité non spécifiée.";
    $_SESSION['message']['type'] = "danger";
    header('Location: ../vue/commande.php');
    exit();
}
?>
