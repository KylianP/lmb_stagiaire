<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


$ANNUAIRE_CATEGORIES	=	get_categories();


if (isset($_REQUEST['create_contact'])) {	
	// *************************************************
	// Controle des donn?es fournies par le formulaire
	if (!isset($_REQUEST['nom']) || !isset($_REQUEST['id_categorie']) || !isset($_REQUEST['note'])) {
		$erreur = "Une variable n?cessaire ? la cr?ation du contact n'est pas pr?cis?e.";
		alerte_dev($erreur);
	}

	$civilite = '';
	if (isset($_REQUEST['civilite'])) { $civilite = $_REQUEST['civilite']; }
	$infos_generales['id_civilite']		= $civilite;
	$infos_generales['nom'] 					= $_REQUEST['nom'];
	$infos_generales['siret'] 				= $_REQUEST['siret'];
	$infos_generales['tva_intra'] 		= $_REQUEST['tva_intra'];
	$infos_generales['id_categorie']	= $_REQUEST['id_categorie'];
	$infos_generales['note'] 					= $_REQUEST['note'];
	$infos_generales['adresses']			= array();
	$infos_generales['coordonnees']		= array();
	$infos_generales['sites']					= array();
	
	for ($i = 0; $i <= $_REQUEST['compte_info']; $i++) {
		if (isset($_REQUEST['adresse_lib'.$i])) {
			$adresse_ville = '';
			if (isset($_REQUEST['adresse_ville'.$i])) { $adresse_ville = $_REQUEST['adresse_ville'.$i]; }
			$infos_generales['adresses'][] = array('lib_adresse' => $_REQUEST['adresse_lib'.$i], 'text_adresse' => $_REQUEST['adresse_adresse'.$i], 'code_postal' => $_REQUEST['adresse_code'.$i], 'ville' =>  $adresse_ville, 'id_pays' => $_REQUEST['adresse_id_pays'.$i], 'note' => $_REQUEST['adresse_note'.$i]);		
		}

		if (isset($_REQUEST['coordonnee_lib'.$i])) {
			$email_user_creation = 0;
			if (isset($_REQUEST['email_user_creation'.$i])) { $email_user_creation = $_REQUEST['email_user_creation'.$i]; }
			$infos_generales['coordonnees'][]	= array('lib_coord' => $_REQUEST['coordonnee_lib'.$i], 'tel1' => $_REQUEST['coordonnee_tel1'.$i], 'tel2' => $_REQUEST['coordonnee_tel2'.$i], 'fax' => $_REQUEST['coordonnee_fax'.$i], 'email' => $_REQUEST['coordonnee_email'.$i], 'note' => $_REQUEST['coordonnee_note'.$i], 'ref_coord_parent' => NULL, 'email_user_creation' => $email_user_creation );
		}
	
		if (isset($_REQUEST['site_lib'.$i])) {
			$infos_generales['sites'][] = array('lib_site_web' => $_REQUEST['site_lib'.$i], 'url' => $_REQUEST['site_url'.$i], 'login' => $_REQUEST['site_login'.$i], 'pass' => $_REQUEST['site_pass'.$i], 'note' => $_REQUEST['site_note'.$i], );
		}
	}
	
	$infos_profils = array();
	if (isset($_REQUEST['profils'])) {
		foreach ($_REQUEST['profils'] as $id_profil) {
			if (!isset($_SESSION['profils'][$id_profil])) { continue; }
			$infos_profils[$id_profil]['id_profil'] = $id_profil;
			include_once ("./profil_create_".$_SESSION['profils'][$id_profil]->getCode_profil().".inc.php");
		}
	}
	
	// *************************************************
	// Cr?ation du contact
	$contact = new contact ();
	$contact->create ($infos_generales, $infos_profils);
	
	
	
	$profils 	= $contact->getProfils();
	//chargement de la class contact_collab
	if(isset($profils[$COLLAB_ID_PROFIL]) ) {
		//fonctions de collaborateurs
		$liste_fonctions_collab = charger_fonctions ($COLLAB_ID_PROFIL);
		//on parcoure les fonction pour retrouver les categories de collaborateurs coch?es
		foreach ($liste_fonctions_collab as $liste_fonction_collab) {
			if (isset($_REQUEST['id_fonction_'.$liste_fonction_collab->id_fonction])) {
			$profils[$COLLAB_ID_PROFIL]->add_fonction ($liste_fonction_collab->id_fonction);
			}
		}
		
	}
	
}

// mise ? jour de la ref_contact d'un document si la requete return_to_page existe et contient ref_doc=


if (isset ($_INFOS['Cr?ation_contact']) && isset($_REQUEST["return_to_page"]) && $_REQUEST["return_to_page"] != "") {
	$ref_doc = str_replace("ref_doc=", "" , $_REQUEST["return_to_page"]);
	// ouverture du document
	$document = open_doc ($ref_doc);
	
	//maj ref_contact
	$document->maj_contact ($_INFOS['Cr?ation_contact']);
}


// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_nouvelle_fiche_create.inc.php");

?>