<?php
include 'controlers/Connexion.php';
EstConnecte();

Deconnexion();
header('Location: login.php');
exit;