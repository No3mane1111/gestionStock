<?php
include "entete.php"; 
if(!empty($_GET['idDep'])){
    $dep = getDep($_GET['idDep']);
}

// Préparation de la requête
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = htmlspecialchars($search); // Sécuriser le terme de recherche

// Connexion à la base de données
try {
    // Préparation de la requête avec filtrage
    $sql = "
        SELECT * 
        FROM departement
        WHERE nomDep LIKE :search
    ";
    $req = $connexion->prepare($sql);
    $req->execute(['search' => '%' . $search . '%']);
    
    // Récupération des résultats
    $deps = $req->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['idDep']) ? '../model/modifierDepart.php' : '../model/ajouterDepart.php' ?>" method="post">
                <label for="nomDep">Nom Département</label>
                <input value="<?= !empty($_GET['idDep']) ? htmlspecialchars($dep['nomDep']) : '' ?>" type="text" name="nomDep" id="nomDep">
                <input value="<?= !empty($_GET['idDep']) ? htmlspecialchars($dep['idDep']) : '' ?>" type="hidden" name="idDep" id="idDep">
                <br><br>
                <label for="respDep">Responsable Département</label>
                <input value="<?= !empty($_GET['idDep']) ? htmlspecialchars($dep['respDep']) : '' ?>" type="text" name="respDep" id="respDep">
                
                <button type="submit" class="custom-button">
                    <?= !empty($_GET['idDep']) ? "Modifier" : "Valider" ?>
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
                    <th>Nom Département</th>
                    <th>Responsable Département</th>
                    <th>Action</th>
                </tr>
                <?php
                if (!empty($deps) && is_array($deps)) {
                    foreach ($deps as $value) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($value['nomDep']) ?></td>
                        <td><?= htmlspecialchars($value['respDep']) ?></td>
                        <td><a href="?idDep=<?= htmlspecialchars($value['idDep']) ?>"><i class='bx bx-edit-alt'></i></a></td>
                    </tr>
                <?php }
                } ?>
            </table>
        </div>
    </div>
</div>

<?php
include 'pied.php';
?>
