<?php
// *************************************************************************************************************
// Ajout d'un type de pièce jointe
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//traitement des données transmises
if(isset($_REQUEST['lib_type_add'])){
	$lib_type = $_REQUEST['lib_type_add'];
	
	$systeme = 0;
	if(isset($_REQUEST['systeme'])){
		$systeme = 1;
	}
	
	add_types_ged($lib_type, $systeme);
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_configuration_entreprise_ged_add.inc.php");
?>