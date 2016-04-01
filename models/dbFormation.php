<?php
include_once(dirname(__FILE__)."/../models/dbInit.php");

/**
 * Recherche toutes les formations sauf celles qui ont déjà été sélectionnées par l'employé auparavant.
 * @param l'identifiant d'un salarié
 * @return le tableau contenant les formations
 */
	function RechercheToutesFormations($idEmploye)
	{
		//Connexion à la base
		$base = Initialisation();

	
		//SELECT avec FETCHALL()
		$sql="select idFormation, titre, date, duree,credit from formation where 
				idFormation not in (select idFormation from selectionner where idEmploye = :idEmploye) ";
		$stmt = $base->prepare($sql);
		
		$stmt->BindValue(':idEmploye', $idEmploye);

		$retour = $stmt->execute();


		if ($retour)
		{
			$retour = $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		
		//Libération de la ressource
		$base = NULL;

		return $retour;

	}
	/**
	 * Recherche toutes les formations d'un utilisateur
	 * @param l'identifiant d'un salarié
	 * @return le tableau contenant les formations
	 */
	function RechercheFormationUtilisateur($id)
	{
		//Connexion à la base
		$base = Initialisation();

		//SELECT avec FETCHALL()
		$sql="SELECT formation.idFormation,employe.idEmploye, nom, titre, date, etat, duree from employe inner join selectionner on employe.idEmploye = selectionner.idEmploye 
		inner join formation on formation.idFormation = selectionner.idFormation where employe.idEmploye= :idEmploye";
		$stmt = $base->prepare($sql);

		$stmt->BindValue(':idEmploye', $id);

		$retour = $stmt->execute();


		if ($retour)
		{
			$retour = $stmt->fetchAll(PDO::FETCH_OBJ);
		}


		//Libération de la ressource
		$base = NULL;

		return $retour;

	}



