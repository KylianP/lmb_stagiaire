<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR CLIENT
// *************************************************************************************************************

$_INTERFACE['MUST_BE_LOGIN'] = 1;
require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");



// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compte_client.inc.php");

?>