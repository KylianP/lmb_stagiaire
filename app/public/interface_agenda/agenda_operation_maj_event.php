<?php
// *************************************************************************************************************
// PANNEAU AFFICHE EN BAS DE L'INTERFACE DE CAISSE
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

// ************************************************************************************
// RECUPERATION DES DONNEES MINIMALES POUR LA VERIFICATION DES DROITS
// ************************************************************************************
if(!isset($_REQUEST["ref_agenda"])){
	echo "la r?f?rence de l'agenda n'est pas sp?cifi?e";
	exit;
}
$ref_agenda = $_REQUEST["ref_agenda"];

if(!isset($_REQUEST["id_type_event"])){
	echo "l'identifiant du type d'?v?nement n'est pas sp?cifi?";
	exit;
}
$id_type_event = intval($_REQUEST["id_type_event"]);
// ************************************************************************************


// ************************************************************************************
// VERIFICATIONS DES DROITS
// ************************************************************************************
if(!$_SESSION["agenda"]["GestionnaireAgendas"]->addEvent($ref_agenda, $id_type_event)){
	echo "Vous n'avez pas les droits d'ajouter ou de modifier cet ?v?nement";
	exit;
}
// ************************************************************************************


// ************************************************************************************
// RECUPERATION ET VERIFICATION DES DONNNES DU FORMULAIRE 
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

if(!isset($_REQUEST["event_lib"])){
	echo "le lib?l? de l'?v?nement n'est pas sp?cifi?";
	exit;
}
$event_lib = utf8_decode($_REQUEST["event_lib"]);

if(!isset($_REQUEST["sdate_deb"])){
	echo "la date de commencement de l'?v?nement n'est pas sp?cifi?e";
	exit;
}
$sdate_deb = $_REQUEST["sdate_deb"];

if(!isset($_REQUEST["sdate_fin"])){
	echo "la date de fin de l'?v?nement n'est pas sp?cifi?e";
	exit;
}
$sdate_fin = $_REQUEST["sdate_fin"];

if(!isset($_REQUEST["sheure_deb"])){
	echo "l'heure de commencement de l'?v?nement n'est pas sp?cifi?e";
	exit;
}
$sheure_deb = $_REQUEST["sheure_deb"];

if(!isset($_REQUEST["sheure_fin"])){
	echo "l'heure de fin de l'?v?nement n'est pas sp?cifi?e";
	exit;
}
$sheure_fin = $_REQUEST["sheure_fin"];

$date_deb = date_Fr_to_Us($sdate_deb)." ".$sheure_deb.":00";
$date_fin = date_Fr_to_Us($sdate_fin)." ".$sheure_fin.":00";

$Udate_deb = strtotime($date_deb);
$Udate_fin = strtotime($date_fin);

if($Udate_deb > $Udate_fin){
	echo "l'heure de fin de l'?v?nement est avant l'heure de commencement";
	exit;
}
$duree = round( ($Udate_fin - $Udate_deb) / 60 ); //dur?e en minutes


if(isset($_REQUEST["note"]))
{			$note = utf8_decode($_REQUEST["note"]);}
else{	$note = "";}
// ************************************************************************************


// ************************************************************************************
// CREATION DE L'obj Event
// ************************************************************************************
if(!isset($_REQUEST["ref_event"])){
	echo "la r?f?rence de l'?v?nement n'est pas sp?cifi?e";
	exit;
}
$ref_event = $_REQUEST["ref_event"];
$event = new Event($ref_event);
// ************************************************************************************

if(!$event->setLib_event($event_lib, $_SESSION["agenda"]["GestionnaireEvenements"]))
{echo "Vous n'avez pas le droit de modifier le lib?l? de l'?v?nement";}

// ************************************************************************************
// MISES A JOUR DE l'?v?nement
// ************************************************************************************
//if(!$event->setLib_event($event_lib, $_SESSION["agenda"]["GestionnaireEvenements"]))
//{echo "Vous n'avez pas le droit de modifier le lib?l? de l'?v?nement";}

if(!$event->setRef_Agenda($ref_agenda, $_SESSION["agenda"]["GestionnaireEvenements"]))
{echo "Vous n'avez pas le droit de changer l'?v?nement d'agenda";}

if(!$event->setId_type_event($id_type_event, $_SESSION["agenda"]["GestionnaireEvenements"]))
{echo "Vous n'avez pas le droit de changer l'?v?nement de type";}

if(!$event->setUdate_event($Udate_deb, $_SESSION["agenda"]["GestionnaireEvenements"]) || !$event->setDuree_event($duree, $_SESSION["agenda"]["GestionnaireEvenements"]))
{echo "Vous n'avez pas le droit de mlettre ? jour l'heure de l'?v?nement";}

if(!$event->setNote_event($note, $_SESSION["agenda"]["GestionnaireEvenements"]))
{echo "Vous n'avez pas le droit de modifier les notes de l'?v?nement";}

$jour_semaine = strftime("%w", $Udate_deb);

if($jour_semaine == "0")
{				$jour_semaine = 6;}
else{		$jour_semaine = $jour_semaine - 1;}




$canBeShown = $_SESSION["agenda"]["GestionnaireEvenements"]->canBeShown($event);

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

switch ($scale_used){
	case "jour" 		: { unset($scale_used); include ($DIR.$_SESSION['theme']->getDir_theme()."page_agenda_operation_maj_event_jour.inc.php"); break;}
	case "semaine" 	: { unset($scale_used); include ($DIR.$_SESSION['theme']->getDir_theme()."page_agenda_operation_maj_event_semaine.inc.php"); break;}
	case "mois" 		: { unset($scale_used); include ($DIR.$_SESSION['theme']->getDir_theme()."page_agenda_operation_maj_event_mois.inc.php"); break;}
}

?>