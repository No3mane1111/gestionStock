<?php
include "entete.php"; 

// Récupération du fournisseur si idFour est défini
if (!empty($_GET['idFour'])) {
    $fournisseur = getFournisseur($_GET['idFour']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['idFour']) ? "../model/modifierFournisseur.php" : "../model/ajouterFournisseur.php" ?>" method="post">
                <label for="prenomFour">Prénom du Fournisseur</label>
                <input value="<?= !empty($_GET['idFour']) ? htmlspecialchars($fournisseur['prenomFour']) : "" ?>" type="text" name="prenomFour" id="prenomFour">
                <input value="<?= !empty($_GET['idFour']) ? htmlspecialchars($fournisseur['idFour']) : "" ?>" type="hidden" name="idFour" id="idFour">
                <br><br>
                <label for="nomFour">Nom du Fournisseur</label>
                <input value="<?= !empty($_GET['idFour']) ? htmlspecialchars($fournisseur['nomFour']) : "" ?>" type="text" name="nomFour" id="nomFour">
                <br><br>
                <label for="teleFour">Téléphone du Fournisseur</label>
                <input value="<?= !empty($_GET['idFour']) ? htmlspecialchars($fournisseur['teleFour']) : "" ?>" type="number" name="teleFour" id="teleFour">
                <br><br>
                <label for="addFour">Adresse du Fournisseur</label>
                <input value="<?= !empty($_GET['idFour']) ? htmlspecialchars($fournisseur['addFour']) : "" ?>" type="text" name="addFour" id="addFour"><br>
                <br>
                <button type="submit" class="custom-button">
                    <?= !empty($_GET['idFour']) ? "Modifier" : "Valider" ?>
                </button>
                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= htmlspecialchars($_SESSION['message']['type']) ?>">
                        <?= htmlspecialchars($_SESSION['message']['text']) ?>
                    </div>
                <?php 
                } ?>      
            </form>
        </div>
        <div class="bbox">
            <table class="mmtable">
                <tr>
                    <th>Prénom du Fournisseur</th>
                    <th>Nom du Fournisseur</th>
                    <th>Téléphone du Fournisseur</th>
                    <th>Adresse du Fournisseur</th>
                    <th>Action</th>
                </tr>
                <?php
                $fournisseurs = getFournisseur();
                if (!empty($fournisseurs) && is_array($fournisseurs)) {
                    foreach ($fournisseurs as $value) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($value['prenomFour']) ?></td>
                        <td><?= htmlspecialchars($value['nomFour']) ?></td>
                        <td><?= htmlspecialchars($value['teleFour']) ?></td>
                        <td><?= htmlspecialchars($value['addFour']) ?></td>
                        <td><a href="?idFour=<?= htmlspecialchars($value['idFour']) ?>"><i class='bx bx-edit-alt'></i></a></td>
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
