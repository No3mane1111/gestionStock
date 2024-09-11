<?php
include "entete.php"; 

if(!empty($_GET['idArt'])){
    $article = getCommande($_GET['idArt']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['idCom']) ? '../model/modifierCommande.php' : '../model/ajouterCommande.php' ?>" method="post">
                <input value="<?= !empty($_GET['idCom']) ? $article['idArt'] : '' ?>" type="hidden" name="idArt" id="idArt">
                
                <label for="idArt">Référence de l'article</label>
                <select name="idArt" id="idArticle">
                    <?php 
                        $articles = getArticle();
                        if (!empty($articles) && is_array($articles)) {
                            foreach ($articles as $key => $value) {
                    ?>
                            <option value="<?= $value['idArt'] ?>"><?= $value['desiArt'] ?></option>            
                    <?php
                            }
                        }
                    ?>
                </select>
                <br><br>

                <label for="idFour">Fournisseur</label>
                <select name="idFour" id="idFournisseur">
                    <?php 
                        $fournisseurs = getFournisseur();
                        if (!empty($fournisseurs) && is_array($fournisseurs)) {
                            foreach ($fournisseurs as $key => $value) {
                    ?>
                            <option value="<?= $value['idFour'] ?>"><?= $value['nomFour'] . " " . $value['prenomFour'] ?></option>            
                    <?php
                            }
                        }
                    ?>
                </select>
                <br><br>

                <label for="qtCom">Quantité de l'article</label>
                <input onkeyup="setPrixCom()" value="<?= !empty($_GET['idCom']) ? $article['quantiteCom'] : '' ?>" type="number" name="qtCom" id="qtCom">
                <br><br>

                <label for="prixUnitCom">Prix Unitaire de l'article Commandé</label>
                <input onkeyup="setPrixCom()" value="" type="number" name="prixUnitCom" id="prixUnitCom">
                <br><br>

                <label for="prixCom">Prix de la Commande</label>
                <input value="" type="number" name="prixCom" id="prixCom">
                <br><br>

                <label for="dateEntre">Date d'Entree</label>
                <input value="" type="date" name="dateEntre" id="dateEntre">
                <br><br>
                
                <button type="submit" class="custom-button">Valider</button>
                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php 
                } ?>
            </form>
        </div>
        <div class="bbox">
            <table class="mmtable">
                <tr>
                    <th>Article</th>
                    <td>Fournisseur</td>
                    <td>Quantité Commandée</td>
                    <td>Prix Unitaire de l'Article</td>
                    <td>Prix de la Commande</td>
                    <td>Date de L'Entree</td>
                    <td>Action</td>
                </tr>
                <?php
                $commande = getCommande();
                if (!empty($commande) && is_array($commande)) {
                    foreach ($commande as $value) {
                ?>
                    <tr>
                        <td><?= $value['desiArt'] ?></td>
                        <td><?= $value['nomFour'] . " " . $value['prenomFour'] ?></td>
                        <td><?= $value['quantiteCom'] ?></td>
                        <td><?= $value['prixUnitCom'] ?></td>
                        <td><?= $value['prixCom'] ?></td>
                        <td><?= $value['dateEntre'] ?></td>
                        <td>
                            <a href="recuCommande.php?idCom=<?= $value['idCom'] ?>"><i class='bx bx-receipt'></i></a>
                            <a onclick="annulerCommande(<?= $value['idCom'] ?>, <?= $value['idArt'] ?>, <?= $value['quantiteCom'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                        </td>
                    </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
</section>

<?php
include 'pied.php';
?>

<script>
    function annulerCommande(idCom, idArt, quantiteCom) {
        
        if (confirm("Voulez-vous vraiment annuler cette Commande 123 ?")) {
            /*alert(idCom+''+idArt+''+quantiteCom);*/
            window.location.href = "../model/annulerCommande.php?idCom=" +idCom+ "&idArt=" +idArt+ "&qtCom=" +quantiteCom;
            
        }
    }

    function setPrixCom() {
        var quantite = document.querySelector('#qtCom');
        var prixUnit = document.querySelector('#prixUnitCom');
        var prixCom = document.querySelector('#prixCom');
        
        prixCom.value = Number(quantite.value) * Number(prixUnit.value);
    }
</script>
