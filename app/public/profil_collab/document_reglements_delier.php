<?php
// *************************************************************************************************************
// DELIER D'UN REGLEMENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

		
if (isset($_REQUEST["ref_reglement"])) {

	if (isset($_REQUEST["ref_doc"])) {

	$document = open_doc($_REQUEST["ref_doc"]);
	//supression du r�glement
	$document->delier_reglement ($_REQUEST["ref_reglement"]);  
	}
	
}


// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************


?>