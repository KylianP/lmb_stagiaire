<?php
// *************************************************************************************************************
// GESTION DES EVENEMENTS (ajout d'un type d'?v?nement)
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

if (isset($_REQUEST["lib_comm_event_type"])) {
	//cr?ation d'un type d'?venement
	contact::add_types_evenements ($_REQUEST["lib_comm_event_type"]);
}
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_gestion_evenements_contact_add.inc.php");

?>