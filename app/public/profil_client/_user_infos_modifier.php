<?php
// *************************************************************************************************************
// INSCRIPTION DE L'UTILISATEUR CLIENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ("_interface.config.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");

//$interface = new interfaces ($ID_INTERFACE);

gestion_panier();
$liste_contenu = $_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]["contenu"];

$liste_reponse = array();
$email = "";
foreach ($_REQUEST as $key=>$value) {
	$liste_reponse[$key] = $key."=".$value;
	if ($key == "admin_emaila") { $email = $value;}
	if ($key == "ref_contact") { $ref_contact = $value;}
}

if (count($liste_reponse) && $email) {
	$message_mail = $_SESSION['interfaces'][$_INTERFACE['ID_INTERFACE']]->modification_contact($liste_reponse, $ref_contact, $email);
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_user_infos_modifier.inc.php");


?>