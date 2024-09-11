<?php
include "entete.php"; 

if(!empty($_GET['idArt'])){
    $article = getVente($_GET['idArt']);
}
?>
<div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action=<?=  !empty($_GET['idArt'])?  "../model/modifierVente.php" : "../model/ajouterVente.php"?> method="post">
                <input value="<?=  !empty($_GET['idArt'])? $article['idArt'] : "" ?>" type="hidden" name="idArt" id="idArt">
                    
                <label for="idArt">Categorie de l'article</label>
                    <select  name="idArt" id="idArticle">
                        <?php 
                                $articles = getArticle();
                                if(!empty($articles) && is_array($articles)){
                                    foreach ($articles as $key => $value){
                                    ?>
                                        <option data-prix="<?= $value['prixUnitArt']?>" value="<?= $value['idArt']?>"><?= $value['desiArt']." - ".$value['quantiteArt']." disponible"?></option>            
                                    <?php
                                    }
                                }
                        ?>
                    </select><br>
                    <br>

                    <label for="idClient">Client</label>
                    <select  name="idClient" id="idClient">
                        <?php 
                                $clients = getClient();
                                if(!empty($clients) && is_array($clients)){
                                    foreach ($clients as $key => $value){
                                    ?>
                                        <option  value="<?= $value['id']?>"><?= $value['nom']."  ".$value['prenom']?></option>            
                                    <?php
                                    }
                                }
                        ?>
                        </select>
                    <br><br>
                    <label for="qtArt">Quantite de l'article</label>
                    <input onkeyup="setPrix()" value="<?=  !empty($_GET['idArt'])? $article['quantiteArt'] : "" ?>" type="number" name="qtArt" id="qtArt">
                    <br><br>
                    <label for="prixArt">Prix unitaire de l'article</label>
                    <input value="<?=  !empty($_GET['idArt'])? $article['prixUnitArt'] : "" ?>" type="number" name="prixArt" id="prixArt"><br>
                    <br>
                   
                   
                    

                    <button type="submit" class="custom-button">Valider</button>
                    <?php
                    if(!empty($_SESSION['message']['text'])){
                    ?>
                        <div class="alert <?= $_SESSION['message']['type'] ?>">
                            <?= $_SESSION['message']['text'] ?>
                            </div>
                        <?php 
                        }?>      
                </form>

            </div>
            <div class = "bbox">
                <table class = "mmtable">
                    <tr>
                        <th>Article</th>
                        <td>Client</td>
                        <td>Quantite </td>
                        <td>Prix</td>
                        <td>Date</td>
                        <td>Action</td>
                    </tr>
                    <?php
$vente = getVente();

if(!empty($vente) && is_array($vente)){
    foreach ($vente as $value){
?>
        <tr>
            <td><?= $value['desiArt']?></td>
            <td><?= $value['nom']."   ".$value['prenom']?></td>
            <td><?= $value['quantite']?></td>
            <td><?= $value['prixVente']?></td>
            <td><?= $value['dateVente']?></td>
            <td>
                <a href="recuVente.php?idVente=<?= $value['idVente']?>"><i class='bx bx-receipt'></i></a>
                <a onclick="annulerVente(<?= $value['idVente']?>,<?= $value['idArt']?>,<?= $value['quantite']?>)" class="color: red;"><i class='bx bx-stop-circle'></i></a>
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
    function annulerVente(idVente, idArt, quantite){
        if(confirm("Voulez-vous vraiment annuler cette vente ?")){
            window.location.href = "../model/annulerVente.php?idVente=" +idVente+ "&idArt=" +idArt+ "&quantite=" +quantite;
        }
    }

    function setPrix(){
        var article = document.querySelector('#idArticle');
        var quantite = document.querySelector('#qtArt');
        var prix = document.querySelector('#prixArt');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>



