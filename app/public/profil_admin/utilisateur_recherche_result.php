<?php
// *************************************************************************************************************
// RECHERCHE DES CONNEXIONS DES UTILISATEURS
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");



// *************************************************************************************************************
// TRAITEMENTS
// *************************************************************************************************************

	// *************************************************
// Profils ? afficher
$profils = array();
foreach ($_SESSION['profils'] as $profil) {
	if ($profil->getActif() != 1) { continue; }
	$profils[] = $profil;
}
unset ($profil);


// *************************************************
// Donn?es pour le formulaire && la requete
$form['page_to_show'] = $search['page_to_show'] = 1;
if (isset($_REQUEST['page_to_show'])) {
	$form['page_to_show'] = $_REQUEST['page_to_show'];
	$search['page_to_show'] = $_REQUEST['page_to_show'];
}
$form['fiches_par_page'] = $search['fiches_par_page'] = $ANNUAIRE_RECHERCHE_SHOWED_FICHES;
if (isset($_REQUEST['fiches_par_page'])) {
	$form['fiches_par_page'] = $_REQUEST['fiches_par_page'];
	$search['fiches_par_page'] = $_REQUEST['fiches_par_page'];
}
$form['orderby'] = $search['orderby'] = "pseudo";
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

$form['nom'] = "";
if (isset($_REQUEST['nom'])) {
	$form['nom'] = trim(urldecode($_REQUEST['nom']));
	$search['nom'] = trim(urldecode($_REQUEST['nom']));
}
$form['id_profil'] = 0;
if (isset($_REQUEST['id_profil'])) {
	$form['id_profil'] = $_REQUEST['id_profil'];
	$search['id_profil'] = $_REQUEST['id_profil'];
}

// *************************************************
// R?sultat de la recherche
$fiches = array();
if (isset($_REQUEST['recherche'])) {
	// Pr?paration de la requete
	$query_join 	= "";
	$query_where 	= "date_archivage IS NULL";
	$query_limit	= (($search['page_to_show']-1)*$search['fiches_par_page']).", ".$search['fiches_par_page'];

	
	// Nom
	if ($search['nom']) {
		$libs = explode (" ", $search['nom']);
		if ($query_where) { $query_where .= " && "; }
		$query_where 	.= " ( ";
		for ($i=0; $i<count($libs); $i++) {
			$lib = trim($libs[$i]);
			$query_where 	.= " nom LIKE '%".addslashes($lib)."%' ||    u.pseudo LIKE '%".addslashes($lib)."%' ||  a.ref_contact LIKE '%".addslashes($lib)."%'  ||  co.email LIKE '%".addslashes($lib)."%'   "; 
			if ( isset($libs[$i+1]) ) { $query_where 	.= " && "; }
		}
		$query_where 	.= " ) ";
	}
	// Profils
	if ($search['id_profil']) { 
		$query_join 	.= " LEFT JOIN annuaire_profils ap ON a.ref_contact = ap.ref_contact "; 
		if ($query_where) { $query_where .= " && "; }
		$query_where 	.= "ap.id_profil = '".$search['id_profil']."'";
	}
	// Recherche
	$query = "SELECT u.ref_user, u.pseudo, u.master, u.actif, a.ref_contact, nom, lib_civ_court,
									 text_adresse, ad.code_postal, ad.ville, ad.ordre, 
									 tel1, tel2, fax, co.email, co.ordre,
									 url, si.ordre
						FROM users u
							LEFT JOIN annuaire a ON a.ref_contact = u.ref_contact
							LEFT JOIN civilites c ON a.id_civilite = c.id_civilite 
							LEFT JOIN adresses ad ON a.ref_contact = ad.ref_contact 
							LEFT JOIN coordonnees co ON a.ref_contact = co.ref_contact 
							LEFT JOIN sites_web si ON a.ref_contact = si.ref_contact 
							".$query_join."
						WHERE ".$query_where."
						GROUP BY u.ref_user
						ORDER BY ".$search['orderby']." ".$search['orderorder'].",  ad.ordre ASC, co.ordre ASC, si.ordre ASC
						LIMIT ".$query_limit;
	$resultat = $bdd->query($query);
	while ($fiche = $resultat->fetchObject()) { $fiches[] = $fiche; }
	//echo nl2br ($query);
	unset ($fiche, $resultat, $query);
	
	// Comptage des r?sultats
	$query = "SELECT u.ref_user
						FROM users u 
							LEFT JOIN annuaire a ON a.ref_contact = u.ref_contact
							LEFT JOIN coordonnees co ON a.ref_contact = co.ref_contact 
							".$query_join."
						WHERE ".$query_where."
						GROUP BY u.ref_user";
	$resultat = $bdd->query($query);
	while ($result = $resultat->fetchObject()) { $nb_fiches ++; }
	//echo "<br><hr>".nl2br ($query);
	unset ($result, $resultat, $query);
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_utilisateur_recherche_result.inc.php");

?>