<?php
session_start();
@include 'config.php';



if(!isset($_SESSION['admin_name'])){

}
include_once '../model/function.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title><?php echo ucfirst(str_replace(".php","",basename($_SERVER['PHP_SELF'])));?></title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
       body {
            background: #ccc;
            padding: 0px;
            font-size: 0.6em;
        }

        .chart-container {
            width: 80%;
            max-width: 800px;
            margin: 60px auto; /* Déplacement vers le bas et centrage horizontal */
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-container h2 {
            text-align: center; /* Centrer le titre */
            margin-bottom: 20px; /* Espacement sous le titre */
            color: #333;
        }

        canvas {
            width: 100% !important; /* Largeur complète du conteneur */
            height: 300px !important; /* Hauteur des graphiques */
        }

        /* Autres styles pour les boutons, alertes, tableaux, etc. */
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
        .logo-details {
  display: flex;
  align-items: center;
}

.logo-image {
  height: 50px;
  margin-right: auto;
  margin-left: 30px; /* Add some space between the image and the text */
}

        .custom-button:hover {
            background-color: #45a049;
        }

        .alert {
            margin: 10px;
            padding: 15px;
            color: white;
            border-radius: 10px;
        }

        .alert.danger {
            background-color: #e05260;
        }

        .alert.success {
            background-color: green;
        }

        .alert.warning {
            background-color: #2697ff;
        }

        .bbox {
            padding: 20px;
            border: 2px solid #000;
            margin: 20px auto;
            margin-bottom: 500px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: fit-content;
        }

        .mmtable {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        .mmtable th, .mmtable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
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

        .overview-boxes .box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: calc(100% / 4 - 15px);
            background: #fff;
            padding: 15px 14px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: auto;
        }

        /* Styles pour la barre de navigation et de recherche */
        .search-box {
            display: flex;
            align-items: center;
            position: relative;
        }

        .search-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-right: 10px;
        }

        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-button i {
            font-size: 24px;
            color: #007BFF;
            transition: color 0.3s;
        }

        .icon-button:hover i {
            color: #0056b3;
        }

        nav {
    position: fixed; /* Fixe la navbar en haut */
    top: 0;
    left: 0;
    width: 100%;
    background-color: #fff; /* Couleur de fond de la navbar */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre portée sous la navbar */
    padding: 10px 20px; /* Espacement intérieur */
    z-index: 1000; /* Assure que la navbar est au-dessus des autres éléments */
}

/* Style pour le titre de la navbar */
nav .dashboard {
    font-size: 1.5em; /* Taille du texte */
    font-weight: bold; /* Poids du texte */
}

/* Style pour les éléments de la navbar */
nav form .search-box {
    margin-left: auto; /* Aligne la barre de recherche à droite */
}

/* Style pour les éléments de la navbar */
nav .profile-details {
    font-size: 1em; /* Taille du texte */
}

.search-input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.icon-button i {
    font-size: 24px; /* Taille de l'icône */
}

/* Pour éviter que le contenu ne soit masqué sous la navbar */
.home-section {
    padding-top: 60px; /* Ajustez selon la hauteur de votre navbar */
}



    </style>
  </head>
  <body>
    <?php
      
    ?>
    
    <div class="sidebar hidden-print" >

    <div class="logo-details"><a href="dashboard.php">
    <img src="../public/img/lamalif.png" alt="Logo" class="logo-image"></a>
    
    <span class="logo_name"></span>
</div>

    
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" class="active">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="article.php">
            <i class="bx bx-box"></i>
            <span class="links_name">Articles</span>
          </a>
        </li>
        <li>
          <a href="departement.php">
            <i class='bx bxs-briefcase-alt-2'></i>
            <span class="links_name">Departement</span>
          </a>
        </li>
        <li>
          <a href="affectation.php">
            <i class='bx bx-shopping-bag'></i>
            <span class="links_name">Affectation</span>
          </a>
        </li>
        
        <li>
          <a href="fournisseur.php">
          <i class='bx bxs-badge-dollar'></i>
            <span class="links_name">Fournisseur</span>
          </a>
        </li>
        <li>
          <a href="commande.php">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Commandes</span>
          </a>
        <li>
          <a href="Information.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Information Globale</span>
          </a>
        </li>
        <li>
          <a href="Consultation.php">
            <i class="bx bx-cog"></i>
            <span class="links_name">Consultation</span>
          </a>
        </li>
        
       
        
        <!-- <li>
          <a href="#">
            <i class="bx bx-message" ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart" ></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li> 
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="links_name">Configuration</span>
          </a>
        </li>-->
        <li class="log_out">
          <a href="../loginwebdesigner/login_form.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Déconnexion</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav class="hidden-print">
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard"><?php echo ucfirst(str_replace(".php","",basename($_SERVER['PHP_SELF'])));?></span>
        </div>
        <form action="" method="get">
  
</form>

</form>

      <div class="profile-details">
          <!--<img src="images/profile.jpg" alt="">-->
          <span class="admin_name"><h3><?php echo $_SESSION['admin_name'] ?></h3></span>
          <i class="bx bx-chevron-down"></i>
        </div>
      </nav>