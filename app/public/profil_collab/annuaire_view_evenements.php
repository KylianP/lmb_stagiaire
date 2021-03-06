<?php
// *************************************************************************************************************
// AFFICHAGE DES EVENEMENTS D'UNE FICHE DE CONTACT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");
require ($DIR.$_SESSION['theme']->getDir_theme()."_theme.config.php" );

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


//chargement des evenements
$evenements = $contact->getEvenements ();


//infos pour mini moteur de recherche contact
$profils_mini = array();
foreach ($_SESSION['profils'] as $profil) {
	if ($profil->getActif() != 1) { continue; }
	$profils_mini[] = $profil;
}
unset ($profil);

$ANNUAIRE_CATEGORIES	=	get_categories();

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_view_evenements.inc.php");

?>