<?php
// *************************************************************************************************************
// [ADMINISTRATEUR] AFFICHAGE D'UNE LISTE DE COORDONNEES
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");





// *************************************************************************************************************
// TRAITEMENTS
// *************************************************************************************************************

// Controle

	if (!isset($_REQUEST['ref_contact'])) {
		echo "La r�f�rence du contact n'est pas pr�cis�e";
		exit;
	}

	$contact = new contact ($_REQUEST['ref_contact']);
	if (!$contact->getRef_contact()) {
		echo "La r�f�rence du contact est inconnue";		exit;

	}


// Pr�parations des variables d'affichage
$adresses = $contact->getAdresses();

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_liste_choix_adresse.inc.php");

?>