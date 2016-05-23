<?php

/**
 * Lance la session si il n'y en a pas 
 */

 if(!isset($_SESSION))
			{
session_start();
			}

/**
 * Connexion à la BDD
 */

$user = 'root';
$pass = '';
$hote = 'localhost';
$port = '3306';
$base = 'formationm2l';
$sql="mysql:$hote;port=$port;dbname=$base";

/**
 * Try/Catch
 */

try
{
	$bdd = new PDO($sql, $user, $pass);
	$bdd->query('SET NAMES utf8');
}
catch (PDOException $e)
{
	$error ='Erreur de connexion avec la BDD';
	die($error);
 }

?>
