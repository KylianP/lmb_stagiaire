<?php
// *************************************************************************************************************
// FONCTIONS DE GESTION DES STOCKS DE LA SOCIETE
// *************************************************************************************************************

/* LES 2 FONCTIONS SUIVANTES NE SONT PAS UTILISEE
function getStock_entrees ($id_stock, $date_debut, $date_fin, $begin = 0, $nb_fiches_showed = 100) {
	global $bdd;

	$entrees = array();
	$query = "SELECT sm.id_stock, sm.ref_article, sm.qte, sm.ref_doc, sm.date, s.lib_stock, s.abrev_stock
						FROM stocks_moves sm 
							LEFT JOIN stocks s ON sm.id_stock = s.id_stock 
						WHERE sm.id_stock = '".$id_stock."' && qte > 0 && sm.date >= '".$date_debut."' &&  sm.date <= '".$date_fin."'
						ORDE BY sm.date DESC
						LIMIT ".$begin.", ".$nb_fiches_showed;
	$resultat = $bdd->query ($query);
	while ($tmp = $resultat->fetchObject()) { $entrees[] = $tmp; }

	return $entrees;
}


function getStock_sorties ($id_stock, $date_debut, $date_fin, $begin = 0, $nb_fiches_showed = 100) {
	global $bdd;

	$sorties = array();
	$query = "SELECT sm.id_stock, sm.ref_article, sm.qte, sm.ref_doc, sm.date, s.lib_stock, s.abrev_stock
						FROM stocks_moves sm
							LEFT JOIN stocks s ON sm.id_stock = s.id_stock
						WHERE sm.id_stock = '".$id_stock."' && qte < 0 && sm.date >= '".$date_debut."' &&  sm.date <= '".$date_fin."'
						ORDE BY sm.date DESC
						LIMIT ".$begin.", ".$nb_fiches_showed;
	$resultat = $bdd->query ($query);
	while ($tmp = $resultat->fetchObject()) { $sorties[] = $tmp; }

	return $sorties;
}*/

// Affiche un tarif au format désiré
function qte_format($qte) {
	global $ARTICLE_QTE_NB_DEC;
	return round($qte,$ARTICLE_QTE_NB_DEC);
}


