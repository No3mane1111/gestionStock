<?php
include "entete.php"; 

$vente = array();

if (!empty($_GET['idCom'])) {
    $commande = getCommande($_GET['idCom']);
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Styles pour l'impression */
        @media print {
            body * {
                visibility: hidden; /* Cacher tous les éléments */
            }
            .page, .page * {
                visibility: visible; /* Montrer uniquement la page */
            }
            .page {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                font-size: 18px; /* Taille de police pour l'impression */
            }
            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 0; /* Supprime les marges par défaut de la page */
            }
            @page :left {
                margin: 0;
            }
            @page :right {
                margin: 0;
            }
            @top-right {
                content: none; /* Supprime le contenu en haut à droite */
            }
            @bottom-right {
                content: none; /* Supprime le contenu en bas à droite */
            }
        }

        /* Styles pour la facture */
        body {
            background: #fff;
            font-family: Arial, sans-serif;
            padding: px;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .cote-a-cote {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .bbox {
            padding: 20px;
            border: 1px solid #000;
            margin: 20px 5;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: fit-content;
        }

        .mmtable {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        .mmtable th, .mmtable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 18px; /* Taille de police pour le tableau */
        }

        .mmtable th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        .mmtable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .mmtable tr:hover {
            background-color: #ddd;
        }

        .mmtable td {
            color: #333;
        }

        .home-content {
            padding-top: 60px; /* Espace pour la barre de navigation fixe si nécessaire */
        }

        /* Styles pour les boutons */
        .custom-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
        }

        .custom-button:hover {
            background-color: #45a049;
        }

        /* Styles pour le bouton d'impression */
        #btnPrintCom {
            position: relative;
            left: 45%;
            margin-bottom: 20px;
        }

        /* Styles pour la barre de navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            z-index: 1000;
        }

        nav .dashboard {
            font-size: 1.5em;
            font-weight: bold;
        }

        nav form .search-box {
            margin-left: auto;
        }

        nav .profile-details {
            font-size: 1em;
        }

        .search-input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .icon-button i {
            font-size: 24px;
        }

        .logo-details {
            display: flex;
            align-items: center;
        }

        .logo-image {
            height: 40px;
            margin-bottom: 30px;
            margin-left: 40px; /* Add some space between the image and the text */
        }
    </style>
</head>
<body>
    

    <!-- Contenu principal -->
    <div class="home-content">
        <button class="hidden-print custom-button" id="btnPrintCom"> <i class='bx bxs-printer'></i> Imprimer</button>
        <div class="overview-boxes">
            <div class="page">
                <div class="cote-a-cote">
                    <div class="logo-details">
                        <img src="../public/img/lamalif.png" alt="Logo" class="logo-image">
                        <span class="logo_name"></span>
                    </div>
                    <div>
                        <?php if (isset($commande['idCom'])) { ?>
                            <p>Reçu N° # : <?= $commande['idCom']?> </p>
                            <p>Date : <?= date('d/m/Y H:i:s', strtotime($commande['dateEntre']))?> </p>
                        <?php } else { ?>
                            <p>Reçu N° : Non disponible</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="cote-a-cote" style="width: 50%">
                    <div>
                        <?php if (isset($commande['idCom'])) { ?>
                            <p>Nom : <?= $commande['nomFour'] . " " . $commande['prenomFour']?> </p>
                        <?php } else { ?>
                            <p>Reçu N° : Non disponible</p>
                        <?php } ?>
                    </div>
                </div>

                <div class="cote-a-cote" style="width: 50%">
                    <div>
                        <?php if (isset($commande['idCom'])) { ?>
                            <p>Téléphone : <?= $commande['teleFour']?> </p><br>
                            <p>Adresse : <?= $commande['addFour']?> </p>
                        <?php } else { ?>
                            <p>Reçu N° : Non disponible</p>
                        <?php } ?>
                    </div>
                </div>

                <div class="bbox">
                    <table class="mmtable">
                        <tr>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Prix HT</th>
                            <th>TVA</th>
                            <th>Prix TTC</th>
                        </tr>
                        <?php 
                            $tva = ($commande['prixUnitCom'] * $commande['quantiteCom']) * 0.2;
                            $prixTTC = ($commande['prixUnitCom'] * $commande['quantiteCom']) + $tva; 
                        ?>
                        <tr>
                            <td><?= $commande['desiArt']?></td>
                            <td><?= $commande['quantiteCom']?></td>
                            <td><?= $commande['prixUnitCom']?></td>
                            <td><?= $commande['prixUnitCom'] * $commande['quantiteCom']?> Dh</td>
                            <td>20 %</td>
                            <td><?= $prixTTC?> Dh</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        var btnPrint = document.querySelector('#btnPrintCom');
        btnPrint.addEventListener("click", () => {
            window.print();
        });

        function setPrix() {
            var article = document.querySelector('#idArticle');
            var quantite = document.querySelector('#qtArt');
            var prix = document.querySelector('#prixArt');
            var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
            prix.value = Number(quantite.value) * Number(prixUnitaire);
        }
    </script>
</body>
</html>
