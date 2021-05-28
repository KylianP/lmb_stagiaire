<?php
// *************************************************************************************************************
// FACTURES CLIENTS NON REGLEES
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");

if (!$_SESSION['user']->check_permission ("11")) {
	//on indique l'interdiction et on stop le script
	echo "<br /><span style=\"font-weight:bolder;color:#FF0000;\">Vos droits  d'accés ne vous permettent pas de visualiser ce type de page</span>";
	exit();
}
//infos de recherche 

$form['page_to_show'] = $search['page_to_show'] = 1;
if (isset($_REQUEST['page_to_show'])) {
	$form['page_to_show'] = $_REQUEST['page_to_show'];
	$search['page_to_show'] = $_REQUEST['page_to_show'];
}
$form['fiches_par_page'] = $search['fiches_par_page'] = $COMPTA_FACTURE_TOPAY_SHOWED_FICHES;
if (isset($_REQUEST['fiches_par_page'])) {
	$form['fiches_par_page'] = $_REQUEST['fiches_par_page'];
	$search['fiches_par_page'] = $_REQUEST['fiches_par_page'];
}
$form['orderby'] = $search['orderby'] = "date_creation";
if (isset($_REQUEST['orderby'])) {
	$form['orderby'] = $_REQUEST['orderby'];
	$search['orderby'] = $_REQUEST['orderby'];
}
$form['orderorder'] = $search['orderorder'] = "ASC";
if (isset($_REQUEST['orderorder'])) {
	$form['orderorder'] = $_REQUEST['orderorder'];
	$search['orderorder'] = $_REQUEST['orderorder'];
}
$nb_fiches = 0;
//fin infos

// chargement de la class du profil
contact::load_profil_class($CLIENT_ID_PROFIL);
// Préparations des variables d'affichage
$liste_categories_client = contact_client::charger_clients_categories ();
foreach ($liste_categories_client as $categorie_client) {
	$categorie_client->count_fact = count_factures_to_pay($categorie_client->id_client_categ);
}

$categorie_client_var = $DEFAUT_ID_CLIENT_CATEG;

if (!$nb_fiches) {
 $nb_fiches = count_niveau_factures_to_pay($categorie_client_var);
}
$liste_niveaux_relance = getNiveaux_relance ($categorie_client_var) ;
foreach ($liste_niveaux_relance as $niveau_relance) {
	$niveau_relance->count_fact = count_niveau_factures_to_pay($categorie_client_var, $niveau_relance->id_niveau_relance);
}

$niveau_relance_var = "";

//chargement des factures de $DEFAUT_ID_CLIENT_CATEG
$factures = array();
$factures = get_factures_to_pay ($categorie_client_var, $niveau_relance_var);
$factures_total = get_factures_to_pay_total ($categorie_client_var, $niveau_relance_var);


// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_factures_client_nonreglees.inc.php");

?>