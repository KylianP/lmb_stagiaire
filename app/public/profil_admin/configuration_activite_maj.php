<?php
// *************************************************************************************************************
// CONFIGURATION DES DONN?ES activite
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");



//mise ? jour des donn?es transmises

if (isset($_REQUEST["entreprise_date_creation"])) {
	maj_configuration_file ("config_generale.inc.php", "maj_line", "\$ENTREPRISE_DATE_CREATION =", "\$ENTREPRISE_DATE_CREATION = \"".date_Fr_to_US($_REQUEST["entreprise_date_creation"])."\"; ", $CONFIG_DIR);
}

if (isset($_REQUEST["defaut_id_pays"]) && $_REQUEST["defaut_id_pays"] != $DEFAUT_ID_PAYS) {
	
	maj_configuration_file ("config_generale.inc.php", "maj_line", "\$DEFAUT_ID_PAYS 		=", "\$DEFAUT_ID_PAYS 		= \"".$_REQUEST["defaut_id_pays"]."\"; 			// Pays utilis? par d?faut ", $CONFIG_DIR);
	
	maj_configuration_file ("config_generale.inc.php", "maj_line", "\$DEFAUT_ID_TVA				=", "\$DEFAUT_ID_TVA				= \"0\";								// Taux de TVA par d?faut pour les cat?gories d'articles", $CONFIG_DIR);
	
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_configuration_activite_maj.inc.php");
?>