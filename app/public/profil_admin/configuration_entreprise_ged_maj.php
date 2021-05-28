<?php
// *************************************************************************************************************
// Modification des types de pièces jointes
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//mise à jour des données transmises
if(isset($_REQUEST['id_type_piece'])){
	$lib_type = $_REQUEST['lib_type_'.$_REQUEST['id_type_piece']];
	
	maj_types_ged($_REQUEST['id_type_piece'], $lib_type);
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_configuration_entreprise_ged_maj.inc.php");
?>