<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


if (isset($_REQUEST['site_ref'.$_REQUEST['ref_idform']])) {	
	// *************************************************
	// cr�ation d'une coordonn�e
	$site_ref  = $_REQUEST['site_ref'.$_REQUEST['ref_idform']];
	$lib_site_web	= $_REQUEST['site_lib'.$_REQUEST['ref_idform']];
	$url = $_REQUEST['site_url'.$_REQUEST['ref_idform']];
	$login = $_REQUEST['site_login'.$_REQUEST['ref_idform']];
	$pass 	= $_REQUEST['site_pass'.$_REQUEST['ref_idform']];
	$note		= $_REQUEST['site_note'.$_REQUEST['ref_idform']];
	

	$site = new site ($site_ref);
	$site->modification ($lib_site_web, $url, $login, $pass, $note);
}
// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_edition_valid_site.inc.php");

?>