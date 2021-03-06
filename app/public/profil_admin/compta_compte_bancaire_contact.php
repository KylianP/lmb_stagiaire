<?php
// *************************************************************************************************************
// ACCUEIL GESTION FACTURES NIVEAUX RELANCES
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


	if (!isset($_REQUEST['ref_contact'])) {
		echo "La r?f?rence du contact n'est pas pr?cis?e";
		exit;
	}

	$contact = new contact ($_REQUEST['ref_contact']);
	if (!$contact->getRef_contact()) {
		echo "La r?f?rence du contact est inconnue";		exit;

	}

//chargement des comptes bancaires
$comptes_bancaires	= compte_bancaire::charger_comptes_bancaires($contact->getRef_contact());

// Pr?parations des variables d'affichage
$profils 	= $contact->getProfils();

//infos pour mini moteur de recherche contact
$profils_mini = array();
foreach ($_SESSION['profils'] as $profil) {
	if ($profil->getActif() != 1) { continue; }
	$profils_mini[] = $profil;
}
unset ($profil);
foreach ($_SESSION['profils'] as $profil) {
	if ($profil->getActif() != 2 ) { continue; }
	$profils_mini[] = $profil;
}
unset ($profil);


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_compte_bancaire_contact.inc.php");

?>