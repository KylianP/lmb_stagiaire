<?php
// *************************************************************************************************************
// COMMANDES CLIENTS EN COURS
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//chargement des commandes en cours
$commandes = array();
$commandes = get_commandes_clients ($_SESSION['magasin']->getId_stock());

$stock_vu = $_SESSION['magasin']->getId_stock();
// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_documents_commandes_clients_encours.inc.php");

?>