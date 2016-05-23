<?php 
session_start(); 

$_SESSION['FkFormation']=$_POST['idForm'];
include("Requete.php");
tableauInsertAttente()

?>