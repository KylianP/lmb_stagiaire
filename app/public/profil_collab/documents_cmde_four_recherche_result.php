<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

if (isset($_COOKIE["tarig"])) {
	$tarig = $_COOKIE["tarig"]; 
	} else {
	$tarig = $DEFAUT_APP_TARIFS_CLIENT; }
setcookie("tarig", $tarig, time()+ $COOKIE_LOGIN_LT, '/');

$_REQUEST['recherche'] = 1;

// Moteur de recherche pour les commandes en cours

// *************************************************
// Donn?es pour le formulaire && la requete
$form['page_to_show'] = $search['page_to_show'] = 1;
if (isset($_REQUEST['page_to_show'])) {
	$form['page_to_show'] = $_REQUEST['page_to_show'];
	$search['page_to_show'] = $_REQUEST['page_to_show'];
}
$form['fiches_par_page'] = $search['fiches_par_page'] = $DOCUMENT_RECHERCHE_SHOWED_FICHES;
if (isset($_REQUEST['fiches_par_page'])) {
	$form['fiches_par_page'] = $_REQUEST['fiches_par_page'];
	$search['fiches_par_page'] = $_REQUEST['fiches_par_page'];
}
$form['orderby'] = $search['orderby'] = "date_doc";
if (isset($_REQUEST['orderby'])) {
	$form['orderby'] = $_REQUEST['orderby'];
	$search['orderby'] = $_REQUEST['orderby'];
}
$form['orderorder'] = $search['orderorder'] = "DESC";
if (isset($_REQUEST['orderorder'])) {
	$form['orderorder'] = $_REQUEST['orderorder'];
	$search['orderorder'] = $_REQUEST['orderorder'];
}
$nb_fiches = 0;

$form['id_type_doc'] = $search['id_type_doc'] = 0;
if (isset($_REQUEST['id_type_doc'])) {
	$form['id_type_doc'] = $_REQUEST['id_type_doc'];
	$search['id_type_doc'] = $_REQUEST['id_type_doc'];
}

$form['ref_constructeur'] = $search['ref_constructeur'] = "";
if (isset($_REQUEST['ref_constructeur'])) {
	$form['ref_constructeur'] = $_REQUEST['ref_constructeur'];
	$search['ref_constructeur'] = $_REQUEST['ref_constructeur'];
}

$form['ref_fournisseur'] = $search['ref_fournisseur'] = "";
if (isset($_REQUEST['ref_fournisseur'])) {
	$form['ref_fournisseur'] = $_REQUEST['ref_fournisseur'];
	$search['ref_fournisseur'] = $_REQUEST['ref_fournisseur'];
}

$form['id_name_stock'] = $search['id_name_stock'] = "";
if (isset($_REQUEST['id_name_stock'])) {
	$form['id_name_stock'] = $_REQUEST['id_name_stock'];
	$search['id_name_stock'] = $_REQUEST['id_name_stock'];
}
$form['id_name_categ_art'] = $search['id_name_categ_art'] = "";
if (isset($_REQUEST['id_name_categ_art'])) {
	$form['id_name_categ_art'] = $_REQUEST['id_name_categ_art'];
	$search['id_name_categ_art'] = $_REQUEST['id_name_categ_art'];
}

$form['cmdecours'] = $search['cmdecours'] = 0;
if ($_REQUEST['cmdecours']) {
	$form['cmdecours'] = 1;
	$search['cmdecours'] = 1;
}

$form['cmderec'] = $search['cmderec'] = 0;
if ($_REQUEST['cmderec']) {
	$form['cmderec'] = 1;
	$search['cmderec'] = 1;
}

$form['cmderetard'] = $search['cmderetard'] = 0;
if ($_REQUEST['cmderetard']) {
	$form['cmderetard'] = 1;
	$search['cmderetard'] = 1;
}




// *************************************************
// R?sultat de la recherche
$fiches = array();
if (isset($_REQUEST['recherche'])) {
	// Pr?paration de la requete
	$query_join 	= "";
	$query_where 	= "1 ";
	$query_limit	= (($search['page_to_show']-1)*$search['fiches_par_page']).", ".$search['fiches_par_page'];
	}

	// bouton radio : toutes les commandes en cours
	if ($search['cmdecours']) {
		$query_where 	.= " && (d.id_etat_doc = 27 OR d.id_etat_doc = 25)";
	}
	
	// bouton radio : uniquement les commandes r?centes
	if ($search['cmderec']) {
		$query_where .= " && TO_DAYS(NOW()) - TO_DAYS(d.date_creation_doc) <= '".$DELAI_COMMANDE_FOURNISSEUR_RECENTE."' ";
	}
	
	// bouton radio : uniquement les commandes en retard        
	if ($search['cmderetard']) {
		$query_where .= " && (TO_DAYS(NOW()) - TO_DAYS(d.date_creation_doc) >= '".$DELAI_COMMANDE_FOURNISSEUR_RETARD."' )";
	}
	
	
	
	// liste d?roulante : par fabriquant
	if ($search['ref_constructeur']) {
		$query_where 	.=  " && d.ref_doc IN ( SELECT ref_doc FROM docs_lines WHERE ref_article 
											IN ( SELECT ref_article 
												FROM articles 
												WHERE ref_constructeur = '".$search['ref_constructeur']."'))";
	}
	
	// liste d?roulante : par stock de d?part
	if ($search['id_name_stock']) {
		$query_where 	.= " && dd.id_stock = '".$search['id_name_stock']."'";
		$query_join 	.= "LEFT JOIN doc_cdf dd ON dd.ref_doc = d.ref_doc";
	}
	// liste d?roulante : par cat?gorie d'article

	if ($search['id_name_categ_art']) {
		$liste_categories = "";
		$liste_categs = array();
		$liste_categs = get_child_categories ($liste_categs, $search['id_name_categ_art']);
		foreach ($liste_categs as $categ) {
			if ($liste_categories) { $liste_categories .= ", "; }
			$liste_categories .= " '".$categ."' ";
		}
		
		$query_where 	.= " && d.ref_doc IN ( SELECT ref_doc FROM docs_lines WHERE ref_article 
											IN ( SELECT ref_article 
												FROM articles 
												WHERE ref_art_categ 
													IN ( ".$liste_categories." ))) ";
													}
	// liste d?roulante : par fournisseur
	if ($search['ref_fournisseur']) {
		$query_where 	.= " && d.ref_contact = '".$search['ref_fournisseur']."'";
	}
	// champ cach?, ne retient que les commandes
	if ($search['id_type_doc']) { 
		$query_where 	.= "&& ((d.id_etat_doc = 25 OR d.id_etat_doc = 27) && (d.id_type_doc = '".$search['id_type_doc']."') )";
	}
	
	// Recherche : s?lection des commandes
	$query = "SELECT d.ref_doc, d.id_type_doc, dt.lib_type_doc, d.id_etat_doc, de.lib_etat_doc, d.ref_contact, d.nom_contact, dc.id_stock,

										( SELECT SUM(qte * pu_ht * (1-remise/100) * (1+tva/100))
									 		FROM docs_lines dl
									 		WHERE d.ref_doc = dl.ref_doc && ISNULL(dl.ref_doc_line_parent) && visible = 1 ) as montant_ttc,
											
										( SELECT SUM(qte * pu_ht * (1-remise/100) )
									 		FROM docs_lines dl
									 		WHERE d.ref_doc = dl.ref_doc && ISNULL(dl.ref_doc_line_parent) && visible = 1 ) as montant_ht,

									 		d.date_creation_doc as date_doc

						FROM documents d 
							LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc 
							LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc 
							LEFT JOIN docs_lines dl ON d.ref_doc = dl.ref_doc
							LEFT JOIN doc_cdf dc ON d.ref_doc = dc.ref_doc
							
							".$query_join."

						WHERE ".$query_where."
						GROUP BY d.ref_doc 
						ORDER BY ".$search['orderby']." ".$search['orderorder']."
						LIMIT ".$query_limit;
	$resultat = $bdd->query($query);
	while ($fiche = $resultat->fetchObject()) { $fiches[] = $fiche; }
	//echo nl2br ($query);
	unset ($fiche, $resultat, $query);
	
	// Comptage des r?sultats
	$query = "SELECT d.ref_doc 
						FROM documents d 
							".$query_join."
						WHERE ".$query_where."
						GROUP BY d.ref_doc " ;
	$resultat = $bdd->query($query);
	while ($result = $resultat->fetchObject()) { $nb_fiches ++; }
	//echo "<br><hr>".nl2br ($query);
	unset ($result, $resultat, $query);

	// s?lection des articles
	foreach ($fiches as $fiche) {
	$query = "SELECT dl.ref_doc_line, dl.ref_doc, dl.ref_article, dl.lib_article, dl.desc_article, dl.qte, dl.pu_ht,
					    a.modele, (dl.pu_ht * (1+tva/100)) as pu_ttc,
										( SELECT SUM(sa.qte) 
									 		FROM stocks_articles sa
									 		WHERE sa.ref_article = dl.ref_article && sa.id_stock = '".$fiche->id_stock."'
									 	) as qte_stock 
				FROM docs_lines dl
				LEFT JOIN articles a ON dl.ref_article = a.ref_article
				WHERE ref_doc = '".$fiche->ref_doc."' 
				GROUP BY ref_doc_line ";
	$resultat = $bdd->query($query);
	while ($article = $resultat->fetchObject()) { $detail_art[] = $article; }
	unset ($article, $resultat, $query);
				
	}

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_documents_cmde_four_recherche_result.inc.php");
?>