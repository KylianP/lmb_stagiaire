<?php
// *************************************************************************************************************
// IDENTIFICATION DE L'UTILISATEUR CLIENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ("_interface.config.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");

//$interface = new interfaces ($ID_INTERFACE);

check_email_present ($_REQUEST["email"]);
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************
if (isset($GLOBALS['_ALERTES']['email_used'])) {
	echo "email dejà présent";
}
?>