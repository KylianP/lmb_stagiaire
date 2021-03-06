<?php
// *************************************************************************************************************
// PANNEAU AFFICHE EN BAS DE L'INTERFACE DE CAISSE
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");
//
//
// ************************************************************************************
// RECUPERATION ET VERIFICATION DES DONNNES
// ************************************************************************************
if(!isset($_REQUEST["scale_used"])){
	echo "l'?chelle n'est pas sp?cifi?e";
	exit;
}
$scale_used = $_REQUEST["scale_used"];

if(!isset($_REQUEST["id_graphic_event"])){
	echo "l'identifiant de l'?v?nement graphique n'est pas sp?cifi?";
	exit;
}
$id_graphic_event = $_REQUEST["id_graphic_event"];

// ************************************************************************************
// CREATION DE L'obj Event
// ************************************************************************************
if(!isset($_REQUEST["ref_event"]) || $_REQUEST["ref_event"] == ""){
	echo "la r?f?rence de l'?v?nement n'est pas sp?cifi?e";
	exit;
}
$ref_event = $_REQUEST["ref_event"];
$event = new Event($ref_event);
// ************************************************************************************

// ************************************************************************************
// VERIFICATIONS DES DROITS
// ************************************************************************************
/*
if(!$_SESSION["agenda"]["GestionnaireAgendas"]->addEvent($event->getRef_agenda(), $event->getId_type_event())){
	echo "Vous n'avez pas les droits de supprimer cet ?v?nement";
	exit;
}
*/
// ************************************************************************************



if(!$event->deleteOnCascade($_SESSION["agenda"]["GestionnaireEvenements"]))
{echo "Vous n'avez pas le droit de supprimer cet ?v?nement";}
unset($event);

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

switch ($scale_used){
	case "jour" 		:
	case "semaine" 	: { unset($scale_used); include ($DIR.$_SESSION['theme']->getDir_theme()."page_agenda_operation_delete_event_jour_semaine.inc.php"); break; }
	case "mois" 		: { unset($scale_used); include ($DIR.$_SESSION['theme']->getDir_theme()."page_agenda_operation_delete_event_mois.inc.php"); break; }
}

?>