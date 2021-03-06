<?php
// *************************************************************************************************************
// Rapprochement Bancaire
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

if (!$_SESSION['user']->check_permission ("10")) {
	//on indique l'interdiction et on stop le script
	echo "<br /><span style=\"font-weight:bolder;color:#FF0000;\">Vos droits  d'acc?s ne vous permettent pas de visualiser ce type de page</span>";
	exit();
}

//chargement des comptes bancaires
$comptes_bancaires	= compte_bancaire::charger_comptes_bancaires("" , 1);

//infos pour mini moteur de recherche contact
$profils_mini = array();
foreach ($_SESSION['profils'] as $profil) {
	if ($profil->getActif() != 1) { continue; }
	$profils_mini[] = $profil;
}
unset ($profil);
foreach ($_SESSION['profils'] as $profil) {
	if ($profil->getActif() != 2 ) { continue; }
	$profils_mini[] = $profil;
}
unset ($profil);


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_compte_bancaire_rapprochement_gestion.inc.php");

?>