<?php
// *************************************************************************************************************
// ACCUEIL COMPTA automatique des comptes bancaires
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


if (!$_SESSION['user']->check_permission ("13")) {
	//on indique l'interdiction et on stop le script
	echo "<br /><span style=\"font-weight:bolder;color:#FF0000;\">Vos droits  d'acc?s ne vous permettent pas de visualiser ce type de page</span>";
	exit();
}

$comptes_bancaires	= compte_bancaire::charger_comptes_bancaires("" , 1);
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_automatique_comptes_bancaires.inc.php");

?>