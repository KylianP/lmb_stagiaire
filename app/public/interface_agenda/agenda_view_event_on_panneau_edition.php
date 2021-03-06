<?php
// *************************************************************************************************************
// PANNEAU AFFICHE EN BAS DE L'INTERFACE DE CAISSE
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//@TODO D?finir $event_duree_moyenne
$event_duree_moyenne = 1800; // = 30 min

$Udate_event_deb 	= time();
$Udate_event_fin 	= time()+$event_duree_moyenne;

define("VIERGE", 0, true);
define("EDITION", 1, true);
define("VALIDATION", 2, true);
define("CREATION", 3, true);
define("PAS_DROIT", 4, true);


$bt_maj_visible = VIERGE;

if(!isset($_REQUEST["echelle"]) || $_REQUEST["echelle"] == ""){
	echo "L'?chelle de l'agenda n'est pas sp?cifi?e";
	exit;
}
$echelle = $_REQUEST["echelle"]; //JOUR, SEMAINE, MOIS

// L'EVENT existe d?j? en BD ***************************************************************
if(!isset($_REQUEST["ref_event"]) || $_REQUEST["ref_event"] == ""){
	echo "La r?f?rence de l'?v?nement n'est pas sp?cifi?e";
	exit;
}

$event = new Event($_REQUEST["ref_event"]);	
if(!$event->getRef_event($_SESSION["agenda"]["GestionnaireEvenements"])){
	echo "La r?f?rence de l'?v?nement est mal format?e";
	exit;
}

if(!isset($_REQUEST["id_graphic_event"]) || !is_numeric($_REQUEST["id_graphic_event"])){
	echo "L'identifiant graphique de l'?v?nement n'est pas sp?cifi?";
	exit;
}
$id_graphic_event = $_REQUEST["id_graphic_event"];

if(isset($_REQUEST["Udate_event"]) && is_numeric($_REQUEST["Udate_event"]) ){
	$event->setUdate_event(intval($_REQUEST["Udate_event"]/1000), $_SESSION["agenda"]["GestionnaireEvenements"]);
}


if(isset($_REQUEST["duree_event"]) && is_numeric($_REQUEST["duree_event"]) ){
	$event->setDuree_event(round(intval($_REQUEST["duree_event"])/60), $_SESSION["agenda"]["GestionnaireEvenements"]);
}

if($_SESSION["agenda"]["GestionnaireEvenements"]->modifier_type_event($event)){
	$bt_maj_visible = EDITION;
}else{
	$bt_maj_visible = PAS_DROIT;
}

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_agenda_view_event_on_panneau_edition.inc.php");

?>