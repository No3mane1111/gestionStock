<?php
include 'connexion.php';

if (
    !empty($_GET['idAf']) &&
    !empty($_GET['idArt']) &&
    !empty($_GET['qtAf'])
) {
    try {
        // Démarrer une transaction
        $connexion->beginTransaction();

        // Mettre à jour la quantité de l'article
        $sql = "UPDATE article SET qtEntre = qtEntre + ? WHERE idArt = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['qtAf'], $_GET['idArt']));

        // Supprimer l'affectation
        $sql = "DELETE FROM affectation WHERE idAf = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['idAf']));

        // Commit la transaction si tout s'est bien passé
        $connexion->commit();

        if ($req->rowCount() > 0) {
            $_SESSION['message']['text'] = "L'affectation a été supprimée avec succès et la quantité de l'article a été mise à jour.";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Aucune affectation trouvée à supprimer.";
            $_SESSION['message']['type'] = "danger";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollBack();
        $_SESSION['message']['text'] = "Erreur: " . $e->getMessage();
        $_SESSION['message']['type'] = "danger";
    }
    
    // Redirection vers la page des affectations
    header('Location: ../vue/affectation.php');
    exit();
} else {
    // Gestion des cas où les paramètres ne sont pas fournis
    $_SESSION['message']['text'] = "ID de l'affectation, ID de l'article ou quantité non spécifiée.";
    $_SESSION['message']['type'] = "danger";
    header('Location: ../vue/affectation.php');
    exit();
}
?>
