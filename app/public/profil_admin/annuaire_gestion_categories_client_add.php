<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

// chargement de la class du profil
contact::load_profil_class($CLIENT_ID_PROFIL);
// Préparations des variables 

	$infos	=	array();
	$infos['note']				=	$_REQUEST["note"];
	$infos['id_tarif']			=	$_REQUEST["id_tarif"];
	$infos['lib_client_categ']	=	$_REQUEST["lib_client_categ"];
	$infos['factures_par_mois']	=	$_REQUEST["factures_par_mois"];
	$infos['delai_reglement']	=	$_REQUEST["delai_reglement"];
	$infos['ref_commercial']	=	$_REQUEST["ref_commercial"];
	$infos['defaut_encours']	= 	$_REQUEST["defaut_encours"];
	//création de la catégorie
	contact_client::create_client_categorie ($infos);

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************
include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_gestion_categories_client_add.inc.php");

?>