<?php
header('Content-Type: application/json');

// Configuration de la connexion à la base de données
$nomServeur = "localhost";
$nomBasedonne = "gestionstock";
$user = "root";
$motDePass = "";

try {
    $connexion = new PDO("mysql:host=$nomServeur;dbname=$nomBasedonne", $user, $motDePass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$query1 = "
    SELECT d.nomDep, SUM(a.qtAf) AS totalQtAf
    FROM affectation a
    JOIN departement d ON a.idDep = d.idDep
    GROUP BY d.nomDep
";
$stmt1 = $connexion->prepare($query1);
$stmt1->execute();
$data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$query2 = "
    SELECT a.idArt, ar.desiArt, d.nomDep, SUM(a.qtAf) AS totalQtAf
    FROM affectation a
    JOIN article ar ON a.idArt = ar.idArt
    JOIN departement d ON a.idDep = d.idDep
    GROUP BY a.idArt, d.nomDep
";
$stmt2 = $connexion->prepare($query2);
$stmt2->execute();
$data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$query3 = "
    SELECT d.nomDep, MONTH(a.dateAf) AS mois, SUM(a.qtAf) AS totalQtAf
    FROM affectation a
    JOIN departement d ON a.idDep = d.idDep
    GROUP BY d.nomDep, MONTH(a.dateAf)
    ORDER BY d.nomDep, mois
";
$stmt3 = $connexion->prepare($query3);
$stmt3->execute();
$data3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

$query4 = "
    SELECT d.nomDep, SUM(c.prixUnitCom*a.qtAf) AS totalPrixCom
    FROM commande c
    JOIN article ar ON c.idArt = ar.idArt
    JOIN affectation a ON ar.idArt = a.idArt
    JOIN departement d ON a.idDep = d.idDep
    GROUP BY d.nomDep
";
$stmt4 = $connexion->prepare($query4);
$stmt4->execute();
$data4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['chart1' => $data1, 'chart2' => $data2, 'lineChart' => $data3, 'chart4' => $data4]);
?>
