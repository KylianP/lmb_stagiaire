<?php
// *************************************************************************************************************
// FACTURES CLIENTS NON REGLEES
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");

ini_set("memory_limit","40M");

if (!$_SESSION['user']->check_permission ("11")) {
	//on indique l'interdiction et on stop le script
	echo "<br /><span style=\"font-weight:bolder;color:#FF0000;\">Vos droits  d'accés ne vous permettent pas de visualiser ce type de page</span>";
	exit();
}
//infos de recherche (pour généraliser l'affichage à l'ensemble des résultats

$form['page_to_show'] = $search['page_to_show'] = 1;

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

$categorie_client_var = "";
$lib_client_categ = "";
// chargement de la class du profil
contact::load_profil_class($CLIENT_ID_PROFIL);
// Chargement des catégories de client (récupération du libéllé de la categ client pour impression
$liste_categories_client = contact_client::charger_clients_categories ();
foreach ($liste_categories_client as $categorie_client) {
	if (isset($_REQUEST["id_client_categ"])) {
		$categorie_client_var = $_REQUEST["id_client_categ"];
		$lib_client_categ = $categorie_client->lib_client_categ;
	}
}


//Chargement des niveau de relance pour récupérer le nombre d'enregistrement et le lib du niveau de relance
if (!$nb_fiches) {
 $nb_fiches = count_niveau_factures_to_pay($categorie_client_var);
}
$lib_niveau_relance = "Non transmise";
$liste_niveaux_relance = getNiveaux_relance ($categorie_client_var) ;
foreach ($liste_niveaux_relance as $niveau_relance) {
	$niveau_relance->count_fact = count_niveau_factures_to_pay($categorie_client_var, $niveau_relance->id_niveau_relance);
	if (isset($_REQUEST["id_niveau_relance"]) && $_REQUEST["id_niveau_relance"] == $niveau_relance->id_niveau_relance ) {
		$nb_fiches = $niveau_relance->count_fact;
		$lib_niveau_relance = $niveau_relance->lib_niveau_relance;
	}
}

$form['fiches_par_page'] = $search['fiches_par_page'] = $nb_fiches;

$niveau_relance_var = "";
if (isset($_REQUEST["id_niveau_relance"])) {
	$niveau_relance_var = $_REQUEST["id_niveau_relance"];
}
//chargement des factures
$factures = array();
$factures = get_factures_to_pay ($categorie_client_var, $niveau_relance_var);

//deux cas de figure soit on imprime les résultat (comme sur la page) soit les documents factures
$GLOBALS['PDF_OPTIONS']['HideToolbar'] = 0;
$GLOBALS['PDF_OPTIONS']['AutoPrint'] = 0;

if (isset($_REQUEST["print_fact"])) {
	$pdf = new PDF_etendu ();
	//on liste les documents pour les imprimer
	foreach ($factures as $facture) {
	$GLOBALS['_OPTIONS']['CREATE_DOC']['no_charge_all_sn'] = 1;
		$document = open_doc ($facture->ref_doc);
		// Ajout du document au PDF
		$pdf->add_doc ("", $document);
	}
} else {
	//on affiche les resultats comme sur le listing des factures non réglées
	include_once ($PDF_MODELES_DIR."factures_apayer.class.php");
	$class = "pdf_factures_apayer";
	$pdf = new $class;
	$pdf->create_pdf($factures, $lib_client_categ, $lib_niveau_relance);
}
// Sortie
$pdf->Output();


?>