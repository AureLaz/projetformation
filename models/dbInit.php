<?php
/**
 * Connexion à la BDD
 */
	function Initialisation()
	{
		$user = 'root';
		$pass = '';
		$hote = 'localhost:81';
		$port = '3306';
		$base = 'formationppe';
		$sql="mysql:$hote;port=$port;dbname=$base";
		
/**
 * Try/Catch
 * @return message d'erreur
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
		return $bdd;	
	}