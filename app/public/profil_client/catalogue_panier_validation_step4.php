<?php
// *************************************************************************************************************
// CATALOGUE CLIENT PANIER validation
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");


$GLOBALS['_OPTIONS']['CREATE_DOC']['ref_contact'] = $_SESSION['user']->getRef_contact ();
$panier = open_client_panier ();
$liste_contenu = array();

setcookie("panier_interface_".$_INTERFACE['ID_INTERFACE'], "", time() - 3600);
if (isset($_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']])) {
	interface_del_panier();
}
unset($_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]);


$panier->maj_etat_doc (42);


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_panier_validation_step4.inc.php");

?>