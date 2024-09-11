<?php
/*session_start();*/
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
      .custom-button {
        background-color: #4CAF50; /* Green background */
        border: none; /* Remove borders */
        color: white; /* White text */
        padding: 15px 32px; /* Some padding */
        text-align: center; /* Centered text */
        text-decoration: none; /* Remove underline */
        display: inline-block; /* Make the button inline */
        font-size: 16px; /* Increase font size */
        margin: 4px 2px; /* Add some margin */
        cursor: pointer; /* Pointer/hand icon on hover */
        border-radius: 12px; /* Rounded corners */
      }

      .custom-button:hover {
        background-color: #45a049; /* Darker green on hover */
      }

      .alert{
  margin: 10px;
  padding: 15px; ;
  color: white;
  border-radius:10px ;
}

.alert.danger{
  background-color: #e05260;
}

.alert.success{
background-color: green;  
}

.alert.warning{
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
  margin-bottom: auto
}
/////////////////////////////////////////
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

  .cote-a-cote {
display: flex; justify-content: space-between;
}
/*source http://jsfiddle.net/mturjak/2wk60/1949/*/
.page {
width: 210mm;
min-height: 297mm;
padding: 20mm;
margin: 10mm auto;
border: 1px #d3d3d3 solid;
I border-radius: 5px;
background:white;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
padding: 1cm;
border: 5px red solid;
height: 257mm;
outline: 2cm #ffeaea solid;
}
@media print {
.hidden-print,
.hidden-print {
display: none !important:
}
}
@page {
size: A4;
margin: 0;
}

@media print {
html,
body {
width: 210mm;
height: 297mm;
}
.hidden-print,
.hidden-print * {
display: none !important;
}
.page{
margin: 0;
border: initial;
border-radius: initial;
width: initial;
min-height: initial;
box-shadow: initial;
background: initial;
page-break-after: always:
}
}
.search-box{
  width: fit-content;
  height: fit-content;
  position: relative;
}
.input-search{
  height: 50px;
  width: 50px;
  border-style: none;
  padding: 10px;
  font-size: 18px;
  letter-spacing: 2px;
  outline: none;
  border-radius: 25px;
  transition: all .5s ease-in-out;
  background-color: #22a6b3;
  padding-right: 40px;
  color:#fff;
}
.input-search::placeholder{
  color:rgba(255,255,255,.5);
  font-size: 18px;
  letter-spacing: 2px;
  font-weight: 100;
}
.btn-search{
  width: 50px;
  height: 50px;
  border-style: none;
  font-size: 20px;
  font-weight: bold;
  outline: none;
  cursor: pointer;
  border-radius: 50%;
  position: absolute;
  right: 0px;
  color:#ffffff ;
  background-color:transparent;
  pointer-events: painted;  
}
.btn-search:focus ~ .input-search{
  width: 300px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid rgba(255,255,255,.5);
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}
.input-search:focus{
  width: 300px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid rgba(255,255,255,.5);
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}






    </style>
  </head>
  <body>
    <?php
      echo ucfirst(str_replace(".php","",basename($_SERVER['PHP_SELF'])));
    ?>
    
    <div class="sidebar hidden-print">
   
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">LAMALIF</span>
      </div>
    <form action="" method="get">
      <div class="search-box">
    <button class="search-btn"><i class="fas fa-search"></i></button>
    <input type="text" class="input-search" placeholder="Type to Search..."value="<?= isset($_GET['btn-search']) ? htmlspecialchars($_GET['btn-search']) : '' ?>">
        </div>
  </form>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" class="active">
            <i class="bx bx-grid-alt"></i>
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
          <a href="#">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Analyses</span>
          </a>
        </li>
        <li>
          <a href="Information.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Information Globale</span>
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
        </li> -->
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="links_name">Configuration</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
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
        <div class="search-box">
          <input type="text" placeholder="Recherche..." />
          <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
          <!--<img src="images/profile.jpg" alt="">-->
          <span class="admin_name">Komche</span>
          <i class="bx bx-chevron-down"></i>
        </div>
      </nav>
      <!--
        <form action="" method="get" class="search-form">
    <input type="text" name="search" placeholder="Rechercher un département..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" class="search-input">
    <button type="submit" class="custom-button search-button">Rechercher</button>
</form>

        -->