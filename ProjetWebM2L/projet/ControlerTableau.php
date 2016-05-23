<?php 
session_start(); 

$_SESSION['FkFormation']=$_POST['idForm'];
include("DbFonctions.php");
tableauInsertAttente()

?>