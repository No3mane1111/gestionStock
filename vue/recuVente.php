<?php
include "entete.php"; 

$vente = array();

if(!empty($_GET['idVente'])){
$vente = getVente($_GET['idVente']);
}

?>



<div class="home-content">
    
        <button class="hidden-print" id="btnPrint" style="position : relative; left:45%"> <i class='bx bxs-printer'></i> Imprimer</button>
    
        <div class="overview-boxes">
       
           
        <div class="page">
            <div class="cote-a-cote">
                <h2>Ceramique</h2>
                <div>
                     <?php if(isset($vente['idVente'])) {?>

                    <p>Recu N° # : <?= $vente['idVente']?> </p>
                    <p>Date : <?= date('d/m/Y H:i:s' , strtotime($vente['dateVente']))?> </p>

                <?php } else {?>

                    <p>Recu N° : Non disponible</p>

                <?php }?>
                </div>
            </div>

            <div class="cote-a-cote" style="width : 50%">
                
                <div>
                     <?php if(isset($vente['idVente'])) {?>

                    <p>Nom : <?= $vente ['nom']."   ".$vente['prenom']?> </p>

                <?php } else {?>

                    <p>Recu N° : Non disponible</p>

                <?php }?>
                </div>
            </div>


            <div class="cote-a-cote" style="width : 50%">
                
                <div>
                     <?php if(isset($vente['idVente'])) {?>

                    <p>Telephone : <?= $vente ['tele']?> </p>
                    
                    <p>Adresse : <?= $vente ['adr']?> </p>
                    

                <?php } else {?>

                    <p>Recu N° : Non disponible</p>

                <?php }?>
                </div>

            </div>
            <div class = "bbox">
                <table class = "mmtable">
                    <tr>
                        <th>Article</th>
                        <td>Quantite </td>
                        <td>Prix Unitaire</td>
                        <td>Prix HT</td>
                        <td>TVA</td>
                        <td>Prix TTC</td>
                    </tr>
                    <?php $tva = ($vente ['prixVente'] * $vente ['quantite']) * 0.2;
                          $prixTTC = ($vente ['prixVente'] * $vente ['quantite']) + $tva ;                    ?>
                            <tr>
                                <td><?= $vente ['refArt']?></td>
                                <td><?= $vente ['quantite']?></td>
                                <td><?= $vente ['prixVente']?></td>
                                <td><?= $vente ['prixVente'] * $vente ['quantite']?> Dh</td>
                                <td>20 %</td>
                                <td><?= $prixTTC?> Dh</td>
                            </tr>
                        
                </table>
                
            </div>

        </div>

        
     
        </div>

        </div>

          
        </div>
      </div>
    </section>

<?php
include 'pied.php';
?>

<script>
    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click",()=>{
        window.print();
    });
      
    function setPrix(){
        var article =document.querySelector('#idArticle');
        var quantite =document.querySelector('#qtArt');
        var prix =document.querySelector('#prixArt');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>



