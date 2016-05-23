<?php 
/**
 * Lance la connection
 */
session_start(); 

$_SESSION['id_attente'] = $_POST['idFormAdmin'];
if(isset($_POST['Accepter']))
{
	include("DbFonctions.php");
	Accepter();

}
elseif(isset($_POST['Refuser']))
{
	include("DbFonctions.php");
	Refuser();
}
?>