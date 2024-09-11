<?php
/*session_start();*/

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
?>
