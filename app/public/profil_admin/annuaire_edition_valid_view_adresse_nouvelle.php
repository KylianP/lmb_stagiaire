<?php
// *************************************************************************************************************
// [ADMINISTRATEUR] AFFICHAGE D'UNE FICHE DE CONTACT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


// *************************************************************************************************************
// TRAITEMENTS
// *************************************************************************************************************

// Controle

	if (!isset($_REQUEST['ref_contact'])) {
		echo "La r?f?rence du contact n'est pas pr?cis?e";
		exit;
	}

	$contact = new contact ($_REQUEST['ref_contact']);
	if (!$contact->getRef_contact()) {
		echo "La r?f?rence du contact est inconnue";		exit;

	}


// Pr?parations des variables d'affichage
$profils 	= $contact->getProfils();
$civilites = get_civilites ();


//liste des pays pour affichage dans select
$listepays = getPays_select_list ();

$adresse	=	new adresse ($_REQUEST['ref']); 
$caiu	= $_REQUEST['compte_info'];
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_view_edition_adresse.inc.php");

?>