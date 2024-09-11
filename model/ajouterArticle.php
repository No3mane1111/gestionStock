<?php
include 'connexion.php';
include_once 'function.php';
session_start();

if (
    !empty($_POST['desiArt']) &&
    !empty($_POST['codeArt']) &&
    !empty($_POST['qtEntre']) &&
    !empty($_POST['dateEntreStock'])
) {
    try {
        // Vérifiez si l'article existe déjà
        $sql = "SELECT * FROM article WHERE desiArt = ?";
        $req = $connexion->prepare($sql);
        $req->execute([htmlspecialchars($_POST['desiArt'])]);
        $article = $req->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            // L'article existe, mettez à jour la quantité
            $nouvelleQtEntre = $article['qtEntre'] + htmlspecialchars($_POST['qtEntre']);
            $sql = "UPDATE article SET qtEntre = ? WHERE idArt = ?";
            $req = $connexion->prepare($sql);
            $req->execute([$nouvelleQtEntre, $article['idArt']]);
            
            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "Quantité mise à jour avec succès pour l'article existant";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la mise à jour de la quantité";
                $_SESSION['message']['type'] = "danger";
            }
        } else {
            // L'article n'existe pas, insérez un nouvel article
            $sql = "INSERT INTO article (desiArt, codeArt, qtEntre, dateEntreStock) VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);
            $req->execute([
                htmlspecialchars($_POST['desiArt']),
                htmlspecialchars($_POST['codeArt']),
                htmlspecialchars($_POST['qtEntre']),
                htmlspecialchars($_POST['dateEntreStock'])
            ]);

            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "Article ajouté avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout de l'article";
                $_SESSION['message']['type'] = "danger";
            }
        }
    } catch (PDOException $e) {
        $_SESSION['message']['text'] = "Erreur: " . $e->getMessage();
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/article.php');
exit();
?>
