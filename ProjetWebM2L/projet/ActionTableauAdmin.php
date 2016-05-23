<?php 
/**
 * Lance la connection
 */
session_start(); 

$_SESSION['id_attente'] = $_POST['idFormAdmin'];
if(isset($_POST['Accepter']))
{
	include("Requete.php");
	Accepter();

}
elseif(isset($_POST['Refuser']))
{
	include("Requete.php");
	Refuser();
}






?>