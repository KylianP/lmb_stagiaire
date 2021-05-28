<?php
// *************************************************************************************************************
// INSCRIPTION DE L'UTILISATEUR CLIENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ("_interface.config.php");
$_INTERFACE['MUST_BE_LOGIN'] = 0;
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");

gestion_panier();
$liste_contenu = $_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]["contenu"];

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************
if (!$INSCRIPTION_ALLOWED) {
include ($DIR.$_SESSION['theme']->getDir_theme()."page_index.inc.php");
} else {
include ($DIR.$_SESSION['theme']->getDir_theme()."page_inscription.inc.php");
}

?>