<?php
include "entete.php"; 

if(!empty($_GET['idUser'])){
    $commercial = getCommercial($_GET['idUser']);
}
?>
<div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action=<?=  !empty($_GET['idUser'])?  "../model/modifierCommercial.php" : "../model/ajouterCommercial.php"?> method="post">
                    <label for="prenomFour">Prenom du Commercial</label>
                    <input value="<?=  !empty($_GET['idUser'])? $commercial['prenomUser'] : "" ?>" type="text" name="prenomUser" id="prenomUser">
                    <input value="<?=  !empty($_GET['idUser'])? $commercial['idUser'] : "" ?>" type="hidden" name="idUser" id="idUser">
                    <br><br>
                    <label for="nomFour">Nom du Commercial</label>
                    <input value="<?=  !empty($_GET['idUser'])? $commercial['nomUser'] : "" ?>" type="text" name="nomUser" id="nomUser">
                    <br><br>
                    <label for="teleUser">Telephone du Commercial</label>
                    <input value="<?=  !empty($_GET['idUser'])? $commercial['teleUser'] : "" ?>" type="number" name="teleUser" id="teleUser">
                    <br><br>
                    <label for="addFour">Code du Commercial</label>
                    <input value="<?=  !empty($_GET['idUser'])? $commercial['codeUser'] : "" ?>" type="text" name="codeUser" id="codeUser"><br>
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
                        <th>Prenom des Commercial</th>
                        <td>Nom des Commercial</td>
                        <td>Telephone des Commercial</td>
                        <td>Code des Commercial</td>
                        <td>Action</td>
                    </tr>
                    <?php
                    $commercial = getCommercial();

                    if(!empty($commercial)&& is_array($commercial)){
                        foreach ($commercial as $key => $value){
                    ?>
                            <tr>
                                <td><?= $value ['prenomUser']?></td>
                                <td><?= $value ['nomUser']?></td>
                                <td><?= $value ['teleUser']?></td>
                                <td><?= $value ['codeUser']?></td>
                                <td><a href="?idUser=<?= $value['idUser']?>"><i class='bx bx-edit-alt' ></i></a></td>
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