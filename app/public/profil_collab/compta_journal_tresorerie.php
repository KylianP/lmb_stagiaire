<?php
// *************************************************************************************************************
// journal des ventes
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


if (!$_SESSION['user']->check_permission ("13")) {
	//on indique l'interdiction et on stop le script
	echo "<br /><span style=\"font-weight:bolder;color:#FF0000;\">Vos droits  d'acc�s ne vous permettent pas de visualiser ce type de page</span>";
	exit();
}
$compta_e = new compta_exercices ();

$compta_e->check_exercice();
//chargement des exercices
$liste_exercices	= $compta_e->charger_compta_exercices();

if (isset($_REQUEST["ref_contact"])) {
	$contact = new contact ($_REQUEST['ref_contact']);
	if (!$contact->getRef_contact()) {
		echo "La r�f�rence du contact est inconnue";		exit;

	}
}

$liste_journaux = charger_liste_journaux_treso ();
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_journal_tresorerie.inc.php");

?>