<?php
// *************************************************************************************************************
// EDITION D'UN REGLEMENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


if (isset($_REQUEST["ref_reglement"])) {

	if (isset($_REQUEST["ref_doc"]) && $_REQUEST["ref_doc"] != "") {
		$ref_doc = $_REQUEST["ref_doc"];
	}
	if (isset($_REQUEST["ref_contact"]) && $_REQUEST["ref_contact"] != "") {
		$ref_contact = $_REQUEST["ref_contact"];
	}
	//maj de la tache
	$reglement = new reglement ($_REQUEST["ref_reglement"]);
	$lettrages = $reglement->getLettrages ();
	
	$reglements_infos = get_infos_reglement_type ($reglement->getId_reglement_mode(), $_REQUEST["ref_reglement"]);
}

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_reglements_edition.inc.php");

?>