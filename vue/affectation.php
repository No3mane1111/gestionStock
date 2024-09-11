<?php
include "entete.php"; 

if (!empty($_GET['idAf'])) {
    $article = getAffect($_GET['idAf']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['idAf']) ? "../model/modifierAffect.php" : "../model/ajouterAffect.php" ?>" method="post">
            
                <input value="<?= !empty($_GET['idAf']) ? htmlspecialchars($article['idAf']) : "" ?>" type="hidden" name="idAf" id="idAf">
                
                <label for="idArt">Article disponible</label>
                <select name="idArticle" id="idArticle">
                    <?php 
                        $articles = getArticle();  
                        if (!empty($articles) && is_array($articles)) {
                            foreach ($articles as $value) {
                                $selected = !empty($article['idArt']) && $article['idArt'] == $value['idArt'] ? 'selected' : '';
                    ?>
                                <option value="<?= htmlspecialchars($value['idArt']) ?>" <?= $selected ?>><?= htmlspecialchars($value['desiArt'])." - ".htmlspecialchars($value['qtEntre'])." disponible" ?></option>            
                    <?php
                            }
                        }
                    ?>
                </select><br><br>

                <label for="idDep">Département</label>
                <select name="idDep" id="idDep">
                    <?php 
                        $dep = getDep();
                        if (!empty($dep) && is_array($dep)) {
                            foreach ($dep as $value) {
                                $selected = !empty($article['idDep']) && $article['idDep'] == $value['idDep'] ? 'selected' : '';
                    ?>
                                <option value="<?= htmlspecialchars($value['idDep']) ?>" <?= $selected ?>><?= htmlspecialchars($value['nomDep'])." / ".htmlspecialchars($value['respDep']) ?></option>            
                    <?php
                            }
                        }
                    ?>
                </select><br><br>
                
                <label for="qtAf">Quantité à affecter</label>
                <input value="<?= !empty($article['qtAf']) ? htmlspecialchars($article['qtAf']) : "" ?>" type="number" name="qtAf" id="qtAf"><br><br>
                
                <label for="dateSortie">Date de Sortie</label>
                <input value="<?= !empty($article['dateAf']) ? htmlspecialchars($article['dateAf']) : "" ?>" type="date" name="dateSortie" id="dateSortie"><br><br>

                <button type="submit" class="custom-button">
                    <?= !empty($_GET['idAf']) ? "Modifier" : "Valider" ?>
                </button>
                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= htmlspecialchars($_SESSION['message']['type']) ?>">
                        <?= htmlspecialchars($_SESSION['message']['text']) ?>
                    </div>
                <?php 
                }
                ?>      
            </form>
        </div>
        
        <div class="bbox">
            <table class="mmtable">
                <tr>
                    <th>Article</th>
                    <th>Affectation</th>
                    <th>Quantité</th>
                    <th>Date de Sortie</th>
                    <th>Action</th>
                </tr>
                <?php
                $affect = getAffect();
                if (!empty($affect) && is_array($affect)) {
                    foreach ($affect as $value) {
                ?>
                        <tr>
                            <td><?= htmlspecialchars($value['desiArt']) ?></td>
                            <td><?= htmlspecialchars($value['nomDep']) ?></td>
                            <td><?= htmlspecialchars($value['qtAf']) ?></td>
                            <td><?= htmlspecialchars($value['dateAf']) ?></td>
                            <td>
                                <a href="?idAf=<?= htmlspecialchars($value['idAf']) ?>"><i class='bx bx-edit-alt'></i></a>
                                <a onclick="annulerAff(<?= htmlspecialchars($value['idAf']) ?>, <?= htmlspecialchars($value['idArt']) ?>, <?= htmlspecialchars($value['qtAf']) ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
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

<?php
include 'pied.php';
?>

<script>
    function annulerAff(idAf, idArt, qtAf){
        if (confirm("Voulez-vous vraiment annuler cette Affectation ?")) {
            window.location.href = "../model/annulerAff.php?idAf=" + idAf + "&idArt=" + idArt + "&qtAf=" + qtAf;
        }
    }
</script>
