<?php
// *************************************************************************************************************
// MODIFICATION DE L'UTILISATEUR CLIENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ("_interface.config.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");

//$interface = new interfaces ($ID_INTERFACE);

gestion_panier();
$liste_contenu = $_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]["contenu"];


if (isset($_REQUEST["id_contact_tmp"]) && isset($_REQUEST["code_validation"])) {
	$validation = $_SESSION['interfaces'][$_INTERFACE['ID_INTERFACE']]->modification_contact_confirmation($_REQUEST["id_contact_tmp"], $_REQUEST["code_validation"]);
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

if ($MODIFICATION_ALLOWED == 1 && $validation  ) {
	include ($DIR.$_SESSION['theme']->getDir_theme()."page_modification_valide.inc.php");
} else {
	header ("Location: _user_infos.php");
}

?>