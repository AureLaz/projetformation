<?php

/**
 * Lance la session si il n'y en a pas 
 */

 if (!isset($_SESSION)) {
     session_start();
 }


function RechercheTousUtilisateurs()
{
    include("DbInit.php");
    $req = "SELECT * FROM salarie";
    $reponse = $bdd->query($req);
    while ($ligne = $reponse->fetch()) {
        if ($_SESSION['login'] == $ligne['prenom_salarie'] && $_SESSION['mdp'] == $ligne['password_salarie']) {
            echo $j;
            $_SESSION['id'] = $ligne['id_salarie'];
            $_SESSION['prenom'] =$_SESSION['login']; // Le prenom = login pour se connecter
            $_SESSION['credit'] = $ligne['credit_salarie'];
            $_SESSION['jour'] = $ligne['jour_salarie'];
            $_SESSION['accesUtilisateur'] = "OPEN";
            header("Location:InterfaceUtilisateur.php");
        }
        if ($_SESSION['login'] == $ligne['prenom_salarie'] && $_SESSION['mdp'] == $ligne['password_salarie'] && $ligne['rang_salarie'] == "2") {
            $_SESSION['id'] = $ligne['id_salarie'];
            $_SESSION['prenom'] = $_SESSION['login'];
            $_SESSION['credit'] = $ligne['credit_salarie'];
            $_SESSION['jour'] = $ligne['jour_salarie'];
            $_SESSION['accesAdmin'] = "OPENADMIN";
            header("Location:InterfaceAdmin.php");
        }
    }
}

function Tableau()
{
    include("DbInit.php");
    $req = "SELECT * from formation, prestataire WHERE date_formation > CURRENT_DATE";
    $reponse = $bdd->query($req); 
    while ($ligne = $reponse->fetch()) {
        echo"<form action='ControlerTableau.php' method='post' role='form'>";
        echo"<tr class ='tabtr'>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['date_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['contenu_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['nbHeures_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['lieu_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['requis_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['nom_prestataire'])))) . "</font> <br />";
        echo"</td>";
        echo"<td class ='tabtr'>";
        echo "<input type='submit' value='Choisir' class='form-control'>";
        echo"</td>";
        echo"</tr>";
        echo "<input name='idForm'type='hidden' value='".$ligne['id_formation']."' >";
        echo "</form>";
    }
}

function TableauConfirme()
{
    include("DbInit.php");
    $req = "SELECT * from formation, salarie, prestataire, attente where validation = '1'  and pk_formation=id_formation and id_salarie = '".$_SESSION['id']."' ";
    $reponse = $bdd->query($req);
    while ($ligne = $reponse->fetch()) {
        echo"<tr class ='tabtr'>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['date_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['contenu_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['nbHeures_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['lieu_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['requis_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['nom_prestataire'])))) . "</font> <br />";
        echo"</td>";
        echo"</tr>";
    }
}
function TableauAdmin()
{
    include("DbInit.php");
    $req = "SELECT id_attente,nom_prestataire,lieu_formation,nbHeures_formation,nom_salarie,contenu_formation from prestataire,formation,salarie, attente where validation='0'  and pk_formation=id_formation  group by contenu_formation";
    $reponse = $bdd->query($req);
    while ($ligne = $reponse->fetch()) {
        //test
        echo"<form action='ControlerTableauAdmin.php' method='post' role='form'>";
        echo"<tr class ='tabtr'>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['nom_salarie'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['contenu_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['nbHeures_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['lieu_formation'])))) . "</font> <br />";
        echo"</td>";
        echo"<td>";
        echo " <font color=\"black\">".utf8_encode(ucwords(strtolower(($ligne['nom_prestataire'])))) . "</font> <br />";
        echo"</td>";
        echo"<td class ='tabtr'>";
        echo "<input type='submit' name='Accepter' value='Accepter' class='form-control'>";
        echo"</td>";
        echo"<td class ='tabtr'>";
        echo "<input type='submit' name='Refuser' value='Refuser' class='form-control'>";
        echo"</td>";
        echo "<input name='idFormAdmin'type='hidden' value='".$ligne['id_attente']."' >";
        echo"</tr>";
        echo "</form>";
    }
}

function tableauInsertAttente()
{
    include("DbInit.php");
    $sql = "INSERT INTO attente (pk_salarie, pk_formation,validation) VALUES (:idsalarie,:pkformation,0)";
    $requete = $bdd->prepare($sql);
    $requete->bindParam(':idsalarie', $_SESSION['id']);
    $requete->bindParam(':pkformation', $_SESSION['FkFormation']);
    $requete->execute();
    header("Location:InterfaceUtilisateur.php");
}
function InsertInscription()
{
    include("DbInit.php");
    $sql = "INSERT INTO salarie (nom_salarie,prenom_salarie,password_salarie,email_salarie, rang_salarie, credit_salarie,jour_salarie) VALUES (:nom,:prenom,:password,:email,1,5000,15)";
    $requete = $bdd->prepare($sql);
    $requete->bindParam(':nom', $_SESSION['nom']);
    $requete->bindParam(':prenom', $_SESSION['prenom']);
    $requete->bindParam(':password', $_SESSION['mdp']);
    $requete->bindParam(':email', $_SESSION['mail']);
    $requete->execute();
    echo $sql;
    $messageinscription = "Vous avez valider votre inscription";
    $_SESSION['messageinscription'] =  $messageinscription;
    header("Location:index.php#contact");
}

function Accepter()
{
    include("DbInit.php");
    // $req = "SELECT credit_formation from salarie, formation where id_salarie = '".$_SESSION['id']."' and pk_formation= ";
        // $reponse = $bdd->query($req);
        // while($ligne = $reponse->fetch())
        // {

        // }
$sql = "UPDATE attente  SET validation = '1' where id_attente = '".$_SESSION['id_attente']."' ";
    $requete = $bdd->prepare($sql);
    $requete->execute();
    header("Location:InterfaceAdmin.php");
}
function Refuser()
{
    include("DbInit.php");
    $sql = "DELETE FROM attente where id_attente = '".$_SESSION['id_attente']."' ";
    $requete = $bdd->prepare($sql);
    $requete->execute();
    header("Location:InterfaceAdmin.php");
}

function VerifInscription()
{
    include("DbInit.php");
    $req = "SELECT nom_salarie,prenom_salarie,password_salarie,email_salarie from salarie";
    $reponse = $bdd->query($req);
    while ($ligne = $reponse->fetch()) {
        $i = 0;
        $messageErreurInscription = "";
        if ($_SESSION['prenom'] == $ligne['prenom_salarie']) {
            $i++;
            $messageErreurInscription .= "identifiant déjà pris <br />";
        }
        if ($_SESSION['mail'] == $ligne['email_salarie']) {
            $i++;
            $messageErreurInscription .= "email déjà pris <br />";
        }
    }
    if ($i > 0) {
        $message5 = "Vous avez $i erreur(s) <br/>";
        $_SESSION['message5'] = $message5;
        $_SESSION['$messageErreurInscription'] = $messageErreurInscription;
        header('Location:index.php#contact');
    }
}
