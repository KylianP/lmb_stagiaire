<?php
// *************************************************************************************************************
// LIVRAISONS fournisseurS NON FACTUREES
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//chargement des livraisons non factur?es
$livraisons = array();
$order = "";
//liste des lieux de stock
$stocks	= fetch_all_stocks();
$stocks_liste = 	array();
foreach ($stocks as $stock) {
	$stocks_liste[$stock->id_stock] = new stock(0, $stock);
}
$livraisons = get_livraisons_fournisseur_to_facture ($_SESSION['magasin']->getId_stock(), $order);
// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_compta_livraisons_fournisseur_nonfacturees.inc.php");

?>