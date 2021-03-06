<?php
// *************************************************************************************************************
// MAJ DU CONTACT D'UN DOCUMENT 
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");



//liste des lieux de stockage
$stocks_liste	= array();
$stocks_liste = $_SESSION['stocks'];



if (isset($_REQUEST['ref_doc'])) {

	// ouverture des infos du document
	$document = open_doc ($_REQUEST['ref_doc']);
	
	//maj ref_contact
	$ref_contact = $_REQUEST['ref_contact'];

	$document->maj_contact ($ref_contact);
	
	$id_type_doc = $document->getID_TYPE_DOC ();
		
	//si un montant est n?gatif
	$montant_negatif = false;
	$montant_positif = 1;
	if (isset($_REQUEST["montant_neg"])) { $montant_negatif = true; $montant_positif = -1;}
			
	if ($document->getACCEPT_REGMT() != 0) {

		//liste des reglements_modes
		$reglements_modes	= array();

		if (($document->getACCEPT_REGMT() == 1 && !$montant_negatif) || ($document->getACCEPT_REGMT() == -1 && $montant_negatif)) {
			$reglements_modes = getReglements_modes ("entrant");
		}
		if (($document->getACCEPT_REGMT() == -1 && !$montant_negatif) || ($document->getACCEPT_REGMT() == 1 && $montant_negatif)) {
			$reglements_modes = getReglements_modes ("sortant");
		}
	
		$liste_reglements = $document->getReglements ();
	}
	
}

// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_documents_edition_block_headoc_".$id_type_doc.".inc.php");

?>