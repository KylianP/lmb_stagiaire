<?php
// *************************************************************************************************************
// LIVRAISONS CLIENTS NON FACTUREES
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//chargement des livraisons non factur?es
$livraisons = array();
$order = "";
if (isset($_REQUEST['orderorder']) && isset($_REQUEST['orderby']) && $_REQUEST['orderorder'] != "" && $_REQUEST['orderby'] != "") {
$order = $_REQUEST['orderby']." ".$_REQUEST['orderorder'];
}

$stocks_liste	= fetch_all_stocks();

if (isset($_SESSION['stocks'][$_REQUEST['id_stock']])) {
$stocks = $_SESSION['stocks'][$_REQUEST['id_stock']];
} else {
$stocks = new stock(0, $stocks_liste[$_REQUEST['id_stock']]);
}



$livraisons = get_livraisons_fournisseur_to_facture ($_REQUEST['id_stock'], $order);
// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_livraisons_fournisseur_nonfacturees_liste.inc.php");

?>