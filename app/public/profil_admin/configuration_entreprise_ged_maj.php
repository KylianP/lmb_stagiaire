<?php
// *************************************************************************************************************
// Modification des types de pi�ces jointes
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//mise � jour des donn�es transmises
if(isset($_REQUEST['id_type_piece'])){
	$lib_type = $_REQUEST['lib_type_'.$_REQUEST['id_type_piece']];
	
	maj_types_ged($_REQUEST['id_type_piece'], $lib_type);
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_configuration_entreprise_ged_maj.inc.php");
?>