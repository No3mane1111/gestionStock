<?php
include "entete.php"; 

if(!empty($_GET['id'])){
    $client = getClient($_GET['id']);
}
?>
<div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action=<?=  !empty($_GET['id'])?  "../model/modifierClient.php" : "../model/ajouterClient.php"?> method="post">
                    <label for="">Prenom du Client</label>
                    <input value="<?=  !empty($_GET['id'])? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom">
                    <input value="<?=  !empty($_GET['id'])? $client['id'] : "" ?>" type="hidden" name="id" id="id">
                    <br><br>
                    <label for="dimArt">Nom du Client</label>
                    <input value="<?=  !empty($_GET['id'])? $client['nom'] : "" ?>" type="text" name="nom" id="nom">
                    <br><br>
                    <label for="qtArt">telephone</label>
                    <input value="<?=  !empty($_GET['id'])? $client['tele'] : "" ?>" type="number" name="tele" id="tele">
                    <br><br>
                    <label for="pcArt">Addresse</label>
                    <input value="<?=  !empty($_GET['id'])? $client['adr'] : "" ?>" type="text" name="adr" id="adr"><br>
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
                        <th>Prenom des Clients</th>
                        <td>Nom des Clients</td>
                        <td>Telephone des Clients</td>
                        <td>Addresse des Clients</td>
                        <td>Action</td>
                    </tr>
                    <?php
                    $articles = getClient();

                    if(!empty($articles)&& is_array($articles)){
                        foreach ($articles as $key => $value){
                    ?>
                            <tr>
                                <td><?= $value ['prenom']?></td>
                                <td><?= $value ['nom']?></td>
                                <td><?= $value ['tele']?></td>
                                <td><?= $value ['adr']?></td>
                                <td><a href="?id=<?= $value['id']?>"><i class='bx bx-edit-alt' ></i></a></td>
                            </tr>
                        <?php }
                    }?>
                </table>
            </div>
        </div>
      </div>
    </section>

<?php
include 'pied.php';
?>