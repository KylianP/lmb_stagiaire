<?php
// *************************************************************************************************************
// AJOUT D'UN REGLEMENT NON ATTRIBU� � UNE FACTURE
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

		
if (isset($_REQUEST["ref_doc"])) {
	
	//Ouverture du reglement
	$reglement = new reglement($_REQUEST['ref_reglement']);
	
	//rapprochement du reglement  au document cibl�
	$document = open_doc ($_REQUEST['ref_doc']);
	 $document->rapprocher_reglement ($reglement);
}




?>