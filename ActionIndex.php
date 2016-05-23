<?php

/**
 * Lance la session si il n'y en a pas 
 */

if (!isset($_SESSION)) {
    session_start();
}

              if (isset($_POST['submit2'])) {
                  extract($_POST);
                  $j = 0;
                  $message3 = "";

                  if (empty($login) || !preg_match("#[A-Za-z-\s]+#", $login)) {
                      $j++;
                      $message3 .= "Votre identifiant est vide ou non conforme<br />";
                  }
                  if (empty($motdepasse) || !preg_match("#[A-Za-z0-9-\s]+#", $motdepasse)) {
                      $j++;
                      $message3 .= "Votre mot de passe est vide ou non conforme<br />";
                  }

                  if ($j > 0) {
                      $message4 = "Vous avez $i erreur(s) <br/>";
                      $_SESSION['message4'] = $message4;
                      $_SESSION['message3'] = $message3;
                      header('Location:index.php#service');
                  } elseif ($j == 0) {
                      $motdepasse = sha1($motdepasse);
                      $_SESSION['login'] = $login;
                      $_SESSION['mdp'] = $motdepasse;
                      include("Requete.php");
                      RechercheTousUtilisateurs();
                  }
              }


          if (isset($_POST['submit'])) {
              extract($_POST);
              $i = 0;
              $message = "";


              if (empty($nom) || !preg_match("#[A-Z-\s]+#", $nom)) {
                  $i++;
                  $message .= "Votre nom est vide ou non conforme<br />";
              }
              if (empty($prenom) || !preg_match("#[A-Za-z-\s]+#", $prenom)) {
                  $i++;
                  $message .= "Votre identifiant est vide ou non conforme<br />";
              }
              if (empty($mail) || !preg_match("#^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$#", $mail)) {
                  $i++;
                  $message .= "Votre mail est vide ou non conforme<br />";
              }
              if (empty($mdp)|| !preg_match("#[A-Za-z0-9-\s]+#", $mdp)) {
                  $i++;
                  $message .= "Votre mot de passe est vide ou non conforme<br />";
              }
              if (empty($message)) {
                  $ii;
                  $message .= "Votre message<br />";
              }
              if ($i > 0) {
                  $message2 = "Vous avez $i erreur(s) <br/>";
                  $_SESSION['message2'] = $message2;
                  $_SESSION['message'] = $message;
                  header('Location:index.php#contact');
              } elseif ($i == 0) {
                  include("Requete.php");
                  $_SESSION['nom'] = $_POST['nom'];
                  $_SESSION['prenom'] = $_POST['prenom'];
                  $_SESSION['mail'] =  $_POST['mail'];
                  $mdp = sha1($mdp); //cryptage
                            $_SESSION['mdp'] =  $mdp;
                  VerifInscription();
                  if (!isset($_SESSION['$messageErreurInscription'])) {
                      InsertInscription();
                  }
              }
          }
