
<?php
/*
include 'connexion.php';
include_once 'function.php';
session_start();

if (
    !empty($_POST['idArt']) &&
    !empty($_POST['idClient']) &&
    !empty($_POST['quantiteArt']) &&
    !empty($_POST['prixUnitVente']) &&
    !empty($_POST['dateVente'])
) {
    $article = getArticle($_POST['idArt']);

    if (!empty($article) && is_array($article)) {
        if ($_POST['quantiteArt'] > $article['quantite']) {
            $_SESSION['message']['text'] = "La quantité à vendre n'est pas disponible";
            $_SESSION['message']['type'] = "danger";
        } else {
            $sql = "INSERT INTO vente (idArt, idClient, quantite, prixVente, dateVente) VALUES (?, ?, ?, ?, ?)";
            $req = $connexion->prepare($sql);

            $req->execute(array(
                $_POST['idArt'],
                $_POST['idClient'],
                $_POST['quantiteArt'],
                $_POST['prixUnitVente'],
                $_POST['dateVente']
            ));

            if ($req->rowCount() != 0) {
                $sql = "UPDATE article SET quantiteArt = quantiteArt - ? WHERE idArt = ?";
                $req = $connexion->prepare($sql);

                $req->execute(array(
                    $_POST['quantiteArt'],
                    $_POST['idArt']
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Vente ajoutée avec succès";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Impossible de faire cette vente";
                    $_SESSION['message']['type'] = "danger";
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout de la vente";
                $_SESSION['message']['type'] = "danger";
            }
        }
    } else {
        $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
        $_SESSION['message']['type'] = "danger";
    }
}

header('Location: ../vue/ventes.php');
exit();
?>
///////////////////////////////////////////////////////////
<?php
include 'connexion.php';
include_once 'function.php';

if (
    !empty($_POST['idArt']) &&
    !empty($_POST['idClient']) &&
    !empty($_POST['prixArt']) &&
    !empty($_POST['qtArt'])
) {
    $article = getArticle($_POST['idArt']);

    if(!empty($article) && is_array($article)){
        if($_POST['qtArt']>$article['quantiteArt']){
            $_SESSION['message']['text'] = "la quantite a vendre  n'est pas disponible";
            $_SESSION['message']['type']  = "danger";
        }else{

            $sql = "INSERT INTO vente(idArt, idClient, prixVente, quantite) VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);
        
            $req->execute(array(
                $_POST['idArt'],
                $_POST['idClient'],
                $_POST['prixArt'],
                $_POST['qtArt'],

            ));
        
            if ($req->rowCount() != 0) {
                $sql = "UPDATE article set quantiteArt = quantiteArt - ? WHERE idArt = ?";
                $req = $connexion->prepare($sql);
        
            $req->execute(array(
                $_POST['idArt'],
                $_POST['qtArt']
            ));
            if ($req->rowCount() != 0){

                $_SESSION['message']['text'] = "vente effectuer avec succès";
                $_SESSION['message']['type']  = "success";
            
            } else {
                $_SESSION['message']['text']  = "Impossible d'effectuer cette vente";
                $_SESSION['message']['type']  = "danger";
            }
            }else{
                $_SESSION['message']['text']  = "une erreur s'est produit lors de la vente";
                $_SESSION['message']['type']  = "danger";
        }
    }
}
  
} else {
    $_SESSION['message']['text']  = "une information obligatoire non renseignée";
    $_SESSION['message']['type']  = "danger";
}
header('Location: ../vue/ventes.php')
?>
///////////////////////////////////////////////////////

la somme d'articles selectionner requete : 
SELECT 
    SUM(v.quantite * v.prixVente) AS total_sum
FROM 
    vente v 
JOIN 
    client c ON v.idClient = c.id 
JOIN 
    article a ON v.idArt = a.idArt 
WHERE 
    c.nom = 'karimi';

<td>
                                <input value="" type="text" name="dimArt" id="dimArt">
                            </td>
                            <td>
                                <input value="" type="number" name="qtArt" id="qtArt">
                            </td>
                            <td>
                               <input value="" type="number" name="embArt" id="embArt">
                            </td>
                            <td>
                                <input value="" type="text" name="pcArt" id="pcArt">
                            </td>
                            <td>
                                <input value="" type="number" name="prixArt" id="prixArt">
                            </td>
                            <td>
                                <input value="" type="text" name="origArt" id="origArt">
                            </td>
                            <td>
                                <input value="" type="text" name="origArt" id="origArt">
                            </td>
                            <td>
                            <select  name="catArt" id="catArt">
                                <option value="Local" <?= !empty($_GET['idArt']) && $article['categorieArt'] == 'Local' ? 'selected' : '' ?>>Local</option>
                                    <option value="Local" <?= !empty($_GET['idArt']) && $article['categorieArt'] == 'Importation' ? 'selected' : '' ?>>Importation</option>
                            </select>
                            </td>

                            //////////////////////////////////////////////////////////////////////
                            function getArticle($id = null,$searchData=array()) 
                            elseif (!empty($searchData)) {
        $search = "WHERE 1=1";
        extract($searchData);
        if (!empty($refArt)) $search .= " AND refArt LIKE :refArt";
        if (!empty($catArt)) $search .= " AND categorieArt LIKE :catArt";
        if (!empty($idArt)) $search .= " AND idArt LIKE :idArt";
        if (!empty($qtArt)) $search .= " AND quantiteArt LIKE :qtArt";
        if (!empty($prixArt)) $search .= " AND prixUnitArt LIKE :prixArt";
        
        $sql = "SELECT * FROM article $search";
        $req = $connexion->prepare($sql);
    
        if (!empty($refArt)) $req->bindValue(':refArt', "%$refArt%", PDO::PARAM_STR);
        if (!empty($catArt)) $req->bindValue(':catArt', "%$catArt%", PDO::PARAM_STR);
        if (!empty($idArt)) $req->bindValue(':idArt', "%$idArt%", PDO::PARAM_STR);
        if (!empty($qtArt)) $req->bindValue(':qtArt', "%$qtArt%", PDO::PARAM_INT);
        if (!empty($prixArt)) $req->bindValue(':prixArt', "%$prixArt%", PDO::PARAM_STR);
    
        $req->execute();
        return $req->fetchAll();
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
<label for="catArt">Categorie de l'article</label>
                    <select  name="catArt" id="catArt">
                        <option value="Local" <?= !empty($_GET['idArt']) && $article['categorieArt'] == 'Local' ? 'selected' : '' ?>>Local</option>
                        <option value="Local" <?= !empty($_GET['idArt']) && $article['categorieArt'] == 'Importation' ? 'selected' : '' ?>>Importation</option>
                    </select><br>
                    <br>

//////////////////////////////////
<li>
          <a href="ventes.php">
            <i class='bx bx-shopping-bag'></i>
            <span class="links_name">Ventes</span>
          </a>
        </li>
        <li>
          <a href="client.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Client</span>
          </a>
        </li>
         </li>
        <li>
          <a href="commercial.php">
            <i class='bx bxs-briefcase-alt-2'></i>
            <span class="links_name">Commercial</span>
          </a>
        </li>
    ///////////////////////////////////////////////////
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

echo json_encode(['chart1' => $data1, 'chart2' => $data2, 'lineChart' => $data3]);
?>
/////////////////////////////////////////////////////
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard des Départements</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80%;
            height: 400px;
            margin: auto;
        }
        .home-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php include "entete.php"; ?>
    <h1>Dashboard des Départements</h1>
    
    <div class="chart-container">
        <h2>Quantité Affectée par Département</h2>
        <canvas id="barChart1"></canvas>
    </div>
    <div class="chart-container">
        <h2>Quantité d'Articles Affectés par Département</h2>
        <canvas id="barChart2"></canvas>
    </div>
    <div class="chart-container">
        <h2>Quantité Affectée par Département par Mois</h2>
        <canvas id="lineChart"></canvas>
    </div>

    <script>
        async function fetchData() {
            const response = await fetch('data.php');
            const data = await response.json();
            return data;
        }

        async function createChart1() {
            const data = await fetchData();
            const labels = data.chart1.map(item => item.nomDep);
            const values = data.chart1.map(item => item.totalQtAf);

            const ctx = document.getElementById('barChart1').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Quantité Affectée',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Département',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantité',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        }
                    }
                }
            });
        }

        async function createChart2() {
            const data = await fetchData();
            const articles = [...new Set(data.chart2.map(item => item.desiArt))];
            const departments = [...new Set(data.chart2.map(item => item.nomDep))];

            const colors = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];

            const borderColor = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            const datasets = articles.map((article, index) => {
                return {
                    label: article,
                    data: departments.map(department => {
                        const item = data.chart2.find(d => d.desiArt === article && d.nomDep === department);
                        return item ? item.totalQtAf : 0;
                    }),
                    backgroundColor: colors[index % colors.length],
                    borderColor: borderColor[index % borderColor.length],
                    borderWidth: 1
                };
            });

            const ctx = document.getElementById('barChart2').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: departments,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Département',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Quantité',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        }
                    }
                }
            });
        }

        async function createLineChart() {
            const data = await fetchData();
            const departments = [...new Set(data.lineChart.map(item => item.nomDep))];
            const months = Array.from({length: 12}, (v, k) => k + 1);

            const colors = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            const datasets = departments.map((department, index) => {
                return {
                    label: department,
                    data: months.map(month => {
                        const item = data.lineChart.find(d => d.nomDep === department && d.mois === month);
                        return item ? item.totalQtAf : 0;
                    }),
                    fill: false,
                    borderColor: colors[index % colors.length],
                    tension: 0.1
                };
            });

            const ctx = document.getElementById('lineChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months.map(m => `Mois ${m}`),
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Mois',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantité',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        }
                    }
                }
            });
        }

        window.onload = async () => {
            await createChart1();
            await createChart2();
            await createLineChart();
        };
    </script>
    <?php include 'pied.php'; ?>
</body>
</html>
/////////////////////////////////////////////////////
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

<style>
body {
  background: #ccc;
  padding: 30px;
  font-size: 0.6em;
}

h6 {
  font-size: 1em;
}

.container {
  width: 21cm;
  min-height: 29.7cm;
}

.invoice {
  background: #fff;
  width: 100%;
  padding: 50px;
  border: 1px solid #444; /* Added border to the invoice */
  border-radius: 8px; /* Rounded corners for a smoother look */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.logo {
  width: 4cm;
  display: block;
  margin-bottom: 20px; /* Spacing below the logo */
}

.document-type {
  text-align: right;
  color: #444;
  font-weight: bold; /* Bold text for document type */
  margin-bottom: 20px; /* Spacing below the document type */
}

.conditions {
  font-size: 0.7em;
  color: #666;
  border-top: 1px solid #ddd; /* Top border to separate conditions */
  padding-top: 10px; /* Spacing above the conditions text */
  margin-top: 20px; /* Spacing above the conditions text */
}

.bottom-page {
  font-size: 0.7em;
  text-align: center; /* Centered text for the bottom of the page */
  margin-top: 20px; /* Spacing above the bottom page text */
  padding-top: 10px; /* Spacing above the bottom page text */
  border-top: 1px solid #ddd; /* Top border to separate bottom page */
}

.table {
  width: 100%;
  border-collapse: collapse; /* Collapsed borders for table */
  margin-top: 20px; /* Spacing above the table */
}

.table th, .table td {
  border: 1px solid #ddd; /* Borders for table cells */
  padding: 10px; /* Padding inside table cells */
  text-align: left; /* Left-aligned text in table cells */
}

.table th {
  background: #f5f5f5; /* Light background for table headers */
  font-weight: bold; /* Bold text for table headers */
}

.table td {
  background: #fff; /* White background for table cells */
}

.footer {
  text-align: center; /* Centered text for the footer */
  font-size: 0.7em;
  color: #666;
  margin-top: 20px; /* Spacing above the footer */
  padding-top: 10px; /* Spacing above the footer */
  border-top: 1px solid #ddd; /* Top border to separate footer */
}
</style>

<div class="container">
<div class="invoice">
    <div class="row">
      <div class="col-7">
        <img src="http://mysam.fr/wp-content/uploads/2016/06/logo_facture.jpg" class="logo" />
      </div>
      <div class="col-5">
        <h1 class="document-type display-4">FACTURE</h1>
        <p class="text-right"><strong th:text="${invoiceReference}">Référence facture</strong></p>
      </div>
    </div>
    <div class="row">
      <div class="col-7">
        <p class="addressMySam">
          <strong>Ceramique</strong><br />
          8 avenue de la Martelle<br />
          81150 Terssac
        </p>
      </div>
      <div class="col-5">
        <br /><br /><br />
        <p class="addressDriver">
          <strong th:text="${driver.getCompanyName()}">Société VTC</strong><br />
          Réf. Client <em th:text="${driver.getUserId()}">Référence client</em><br />
          <span th:text="${driver.getFirstName()}">Prénom</span> <span th:text="${driver.getLastName()}">NOM</span><br />
          <span th:text="${driver.getAddress()}">adresse</span><br />
          <span th:text="${driver.getZipCode()}">code postal</span> <span th:text="${driver.getCity()}">VILLE</span>
        </p>
      </div>
    </div>
    <br />
    <br />
    <h6>Frais de services MYSAM du <span th:text="${start}">date</span> au <span th:text="${end}">date</span></h6>
    <br />
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Description</th>
          <!--<th>Quantité</th>-->
          <!--<th>Unité</th>-->
          <!--<th>PU TTC</th>-->
          <th>TVA</th>
          <th class="text-right">Total HT</th>
          <th class="text-right">Total TTC</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Frais de service MySam à 5% pour la période du <span th:text="${start}">date</span> au <span th:text="${end}">date</span></td>
          <!--<td>13</td>-->
          <!--<td>Kilomètres</td>-->
          <!--<td class="text-right">1,20€</td>-->
          <td>20%</td>
          <td class="text-right" th:text="${summaryDriverClientsPayment.get('mysamHT')}">0,00€</td>
          <td class="text-right" th:text="${summaryDriverClientsPayment.get('mysamTTC')}">0,00€</td>
        </tr>
        <tr>
          <td>Frais de service MySam à 10% pour la période du <span th:text="${start}">date</span> au <span th:text="${end}">date</span></td>
          <!--<td>15</td>-->
          <!--<td>Minutes</td>-->
          <!--<td class="text-right">0,25€</td>-->
          <td>20%</td>
          <td class="text-right" th:text="${summaryDriverPayment.get('mysamHT')}">0,00€</td>
          <td class="text-right" th:text="${summaryDriverPayment.get('mysamTTC')}">0,00€</td>
        </tr>
        <tr>
          <td>Pénalités d'annulation</td>
          <!--<td>5</td>-->
          <!--<td>Minutes</td>-->
          <!--<td class="text-right">-10€</td>-->
          <td>20%</td>
          <td class="text-right" th:text="${summaryPenalties.get('driverHT')}">0,00€</td>
          <td class="text-right" th:text="${summaryPenalties.get('driverTTC')}">0,00€</td>
        </tr>
      </tbody>
    </table>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-4">
        <table class="table table-sm text-right">
          <tr>
            <td><strong>Total HT</strong></td>
            <td class="text-right" th:text="${totalHT}">0,00€</td>
          </tr>
          <tr>
            <td>TVA 20%</td>
            <td class="text-right" th:text="${totalTVA}">0,00€</td>
          </tr>
          <tr>
            <td><strong>Total TTC</strong></td>
            <td class="text-right" th:text="${totalTTC}">0,00€</td>
          </tr>
        </table>
      </div>
    </div>

    <p class="conditions">
      En votre aimable règlement
      <br />
      Et avec nos remerciements.
      <br /><br />
      Conditions de paiement : paiement à réception de facture.
      <br />
      Aucun escompte consenti pour règlement anticipé.
      <br />
      Règlement par virement bancaire ou carte bancaire.
      <br /><br />
      En cas de retard de paiement, indemnité forfaitaire pour frais de recouvrement : 40 euros (art. L.4413 et L.4416 code du commerce).
    </p>

    <br />
    <br />
    <br />
    <br />

    <p class="bottom-page text-right">
      MYSAM SAS - N° SIRET 81754802700017 RCS ALBI<br />
      8, avenue de la Martelle - 81150 TERSSAC 06 32 97 00 22 - www.mysam.fr<br />
!>

///////////////////////////////////////////
AJOUT COMMANDE

<?php
include 'connexion.php';
include_once 'function.php';
session_start();

try {
    if (
        !empty($_POST['idArt']) &&
        !empty($_POST['idFour']) &&
        !empty($_POST['prixCom']) &&
        !empty($_POST['qtCom']) &&
        !empty($_POST['dateEntre']) &&
        !empty($_POST['prixUnitCom'])
    ) {
        // Fetch the article to ensure it exists
        $article = getArticle($_POST['idArt']);
        
        if (!$article) {
            throw new Exception("Article not found with idArt: " . $_POST['idArt']);
        }

        // Fetch the fournisseur to ensure it exists
        $fournisseur = getFournisseur($_POST['idFour']);
        
        if (!$fournisseur) {
            throw new Exception("Fournisseur not found with idFour: " . $_POST['idFour']);
        }

        // Insert the commande
        $sql = "INSERT INTO commande (idArt, idFour, prixCom, quantiteCom, dateEntre,prixUnitCom) VALUES (?, ?, ?, ?,?,?)";
        $req = $connexion->prepare($sql);

        $req->execute(array(
            $_POST['idArt'],
            $_POST['idFour'],
            $_POST['prixCom'],
            $_POST['qtCom'],
            $_POST['dateEntre'],
            $_POST['prixUnitCom']
        ));

        if ($req->rowCount() != 0) {
            // Update the article quantity
            $sql = "UPDATE article SET qtEntre = qtEntre + ? WHERE idArt = ?";
            $req = $connexion->prepare($sql);

            $req->execute(array(
                $_POST['qtCom'], // Corrected variable
                $_POST['idArt']
            ));

            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "Commande effectuée avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Impossible d'effectuer cette Commande";
                $_SESSION['message']['type'] = "danger";
            }
        } else {
            $_SESSION['message']['text'] = "Une erreur s'est produite lors de la Commande";
            $_SESSION['message']['type'] = "danger";
        }
    } else {
        $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
        $_SESSION['message']['type'] = "danger";
    }
} catch (Exception $e) {
    $_SESSION['message']['text'] = "Erreur: " . $e->getMessage();
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/commande.php');
exit();
?>
/////////////////////////////////////////////

annulerCommande


<?php
include 'connexion.php';

if(
    !empty($_GET['idCom'])&&
    !empty($_GET['qtCom'])&&
    !empty($_GET['idArt'])
    
   
){
    $sql = "UPDATE commande set etat='0' where idCom=?";
    $req = $connexion->prepare($sql);
    $req->execute(array($_GET['idCom']));

    if($req->rowCount()!=0){
        $sql = "UPDATE article set qtEntre = qtEntre-? where idArt=?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['qtCom'],$_GET['idArt']));

    }
    
}

header('Location: ../vue/commande.php');
////////////////////////////////////////////

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



