<?php
// *************************************************************************************************************
// MODIFICATION DES INFOS GENERALES D'UN CONTACT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


$ANNUAIRE_CATEGORIES	=	get_categories();


if (isset($_REQUEST['modif_contact'])) {	
	// *************************************************
	// Controle des donn?es fournies par le formulaire
	if (!isset($_REQUEST['nom']) || !isset($_REQUEST['id_categorie']) || !isset($_REQUEST['note'])) {
		$erreur = "Une variable n?cessaire ? la modification du contact n'est pas pr?cis?e.";
		alerte_dev($erreur);
	}

	$infos_generales['id_civilite'] = urldecode($_REQUEST['civilite']);
	$infos_generales['nom'] 			= $_REQUEST['nom'];
	$infos_generales['siret'] 				= $_REQUEST['siret'];
	$infos_generales['id_categorie'] = $_REQUEST['id_categorie'];
	$infos_generales['note'] 			= $_REQUEST['note'];

	$infos_profils = array();
	//if (isset($_REQUEST['profils'])) {
	//	foreach ($_REQUEST['profils'] as $id_profil) {
	//		if (!isset($_SESSION['profils'][$id_profil])) { continue; }

	//		$infos_profils[$id_profil]['id_profil'] = $id_profil;
	//		include_once ("./profil_create_".$_SESSION['profils'][$id_profil]->getCode_profil().".inc.php");
	//	}
	//}
	
	// *************************************************
	// Cr?ation du contact
	$contact = new contact ($_REQUEST['ref_contact']);
	$contact->modification ($infos_generales, $infos_profils);
}
// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_edition_valid_fiche.inc.php");

?>