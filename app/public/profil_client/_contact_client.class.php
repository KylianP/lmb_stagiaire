<?php
// *************************************************************************************************************
// CLASSE PERMETTANT LA GESTION D'UN CONTACT AYANT LE PROFIL [CLIENT]  
// *************************************************************************************************************

class contact_client extends contact_profil  {
	private $ref_contact;							// Référence du contact

  private $id_client_categ; 				// Identifiant de la catégorie du client
  private $type_client; 						// type de client
  private $id_tarif;								// Identifiant de la grille tarifaire
  private $ref_commercial;					// Ref_contact du commercial de ce client
 
  private $ref_adr_livraison; 			// Adresse de livraison
  private $ref_adr_facturation; 		// Adresse de facturation
  private $app_tarifs; 							// Tarif affichés en HT ou TTC
  
  private $factures_par_mois;				// Nombre de facture par mois 
  private $encours;									// Crédit maximum accordé 
  private $delai_reglement;					// Délai de règlement des factures
  private $defaut_numero_compte;		// numéro de compte comptable par défaut
	

function __construct ($ref_contact, $action = "open") {
	global $DIR;
	global $bdd;
	global $DEFAUT_COMPTE_TIERS_VENTE;
	
	$this->ref_contact = $ref_contact;
	// Controle si la ref_contact est précisée
	if (!$ref_contact) { return false; }
	$this->ref_contact = $ref_contact;
	
	if ($action == "create") {
		return false;
	}

	$query = "SELECT ac.ref_contact, ac.id_client_categ, ac.type_client, ac.id_tarif, ac.ref_commercial, ac.ref_adr_livraison, ac.ref_adr_facturation, ac.app_tarifs, ac.factures_par_mois, ac.encours, ac.delai_reglement, 
									ac.defaut_numero_compte,
									cc.defaut_numero_compte as categ_defaut_numero_compte	, 
									a.nom as nom_commercial		
									
						FROM annu_client ac
						LEFT JOIN clients_categories cc ON cc.id_client_categ = ac.id_client_categ
						LEFT JOIN annuaire a ON a.ref_contact = ac.ref_commercial
						LEFT JOIN plan_comptable pc ON pc.numero_compte = ac.defaut_numero_compte
						WHERE ac.ref_contact = '".$this->ref_contact."' ";	
	$resultat = $bdd->query ($query);

	// Controle si la ref_contact (client) est trouvée
	if (!$contact_client = $resultat->fetchObject()) { return false; }
	
	$this->ref_contact 					= $contact_client->ref_contact;
	$this->id_client_categ 			= $contact_client->id_client_categ;
	$this->type_client		 			= $contact_client->type_client;
	$this->id_tarif 						= $contact_client->id_tarif;
	$this->ref_commercial 			= $contact_client->ref_commercial;
	$this->nom_commercial 			= $contact_client->nom_commercial;
	$this->ref_adr_livraison 		= $contact_client->ref_adr_livraison;
	$this->ref_adr_facturation 	= $contact_client->ref_adr_facturation;
	$this->app_tarifs 					= $contact_client->app_tarifs;
	$this->factures_par_mois		= $contact_client->factures_par_mois;
	$this->encours							= $contact_client->encours;
	$this->delai_reglement			= $contact_client->delai_reglement;
	$this->defaut_numero_compte = $contact_client->defaut_numero_compte;
	//remplissage du numéro de compte achat par soit celui de la categorie client
	if (!$this->defaut_numero_compte) {
	$this->defaut_numero_compte = $contact_client->categ_defaut_numero_compte;
	}
	//soit par celui par defaut
	if (!$this->defaut_numero_compte) {
	$this->defaut_numero_compte = $DEFAUT_COMPTE_TIERS_VENTE;
	}

	$this->profil_loaded 	= true;
}



// *************************************************************************************************************
// CREATION DES INFORMATIONS DU PROFIL [CLIENT]  
// *************************************************************************************************************
function create_infos ($infos) {
	global $DIR, $CONFIG_DIR;
	global $bdd; 
	global $DEFAUT_ID_CLIENT_CATEG;
	global $DEFAUT_ENCOURS_CLIENT;
	global $DEFAUT_APP_TARIFS_CLIENT;
	global $COMMERCIAL_ID_PROFIL;

	// Controle si ces informations sont déjà existantes
	if ($this->profil_loaded) {
		return false;
	}
	
	// Fichier de configuration de ce profil
	include_once ($CONFIG_DIR."profil_client.config.php");

	// *************************************************
	// Controle des informations
	$this->id_client_categ = $DEFAUT_ID_CLIENT_CATEG;
	if (isset($infos['id_client_categ']) && $infos['id_client_categ'] ) {	
		$this->id_client_categ = $infos['id_client_categ']; 
	}

	$this->ref_commercial = "NULL";
	// *************************************************
	// Informations par défaut pour la catégorie
	$query = "SELECT id_tarif, ref_commercial, factures_par_mois, delai_reglement
						FROM clients_categories
						WHERE id_client_categ = '".$this->id_client_categ."' ";
	$resultat = $bdd->query ($query);
	if ($categorie = $resultat->fetchObject()) {
		$this->id_tarif 					= $categorie->id_tarif;
		$this->ref_commercial 		= $categorie->ref_commercial;;
		$this->delai_reglement 		= $categorie->delai_reglement;
		$this->factures_par_mois 	= $categorie->factures_par_mois;
	}

	if (isset($infos['id_tarif']) && $infos['id_tarif']) { 
		$this->id_tarif = $infos['id_tarif'];
	}
	if ( isset($infos['factures_par_mois']) && $infos['factures_par_mois'] && 
			 ($infos['factures_par_mois'] >= 0 && $infos['factures_par_mois'] <= 5) ) { 
		$this->factures_par_mois = $infos['factures_par_mois'];
	}
	$this->encours = $DEFAUT_ENCOURS_CLIENT;
	if (isset($infos['encours']) && is_numeric($infos['encours'])) { 
		$this->encours = $infos['encours'];
	}
	if (isset($infos['delai_reglement']) && is_numeric($infos['delai_reglement'])) { 
		$this->delai_reglement = $infos['delai_reglement'];
	}
	$this->app_tarifs = $DEFAUT_APP_TARIFS_CLIENT;
	if (isset($infos['app_tarifs']) && $infos['app_tarifs']) {
		$this->app_tarifs = $infos['app_tarifs'];
	}
	if (isset($infos['ref_commercial']) ) { 
		$this->ref_commercial = $infos['ref_commercial'];
		if ($this->ref_commercial) {
			// Modification du profil
			$new_profils = array();
			$new_profils["id_profil"] = $COMMERCIAL_ID_PROFIL;
			$contact= new contact ($this->ref_commercial);
			if (!$contact->charger_profiled_infos ($new_profils["id_profil"])) {
				$contact->create_profiled_infos ($new_profils);
			}
		}
	}
	/*
	else {
		$this->ref_commercial = $categorie->ref_commercial;
	}
	*/
	
	$this->defaut_numero_compte = "";
	if (isset($infos['defaut_numero_compte']) ) { 
		$this->defaut_numero_compte = substr($infos['defaut_numero_compte'], 0, 10);
		
		$compte_plan_general = new compta_plan_general ();
		$tmp_ctpinfos = array();
		$tmp_ctpinfos['numero_compte'] 	= $this->defaut_numero_compte;
		$tmp_ctpinfos['lib_compte'] 		= $this->defaut_numero_compte;
		$tmp_ctpinfos['favori'] 		= 1;
		//création du compte
		$compte_plan_general->create_compte_plan_comptable ($tmp_ctpinfos);
		//on supprime le global alerte que peut générer la cration du compte pour ne pas bloquer la création du contact
		if (isset($GLOBALS['_ALERTES']['numero_compte_vide'])) {unset($GLOBALS['_ALERTES']['numero_compte_vide']);}
		if (isset($GLOBALS['_ALERTES']['exist_numero_compte'])) {unset($GLOBALS['_ALERTES']['exist_numero_compte']);}
	}


	// *****************************************************
	// Adresse de livraison
	if (isset($infos['ref_adr_livraison'])) {
		$this->ref_adr_livraison = $infos['ref_adr_livraison'];
	}
	if (!$this->ref_adr_livraison) { $this->ref_adr_livraison = 1; }
	// Traitements complémentaires liés à la phase de création
	if (is_numeric($this->ref_adr_livraison)) {
		$query = "SELECT ref_adresse FROM adresses 
							WHERE ref_contact = '".$this->ref_contact."' 
							LIMIT ".($this->ref_adr_livraison-1).", 1 "; 
		$resultat = $bdd->query ($query);
		if ($adresse = $resultat->fetchObject()) { $this->ref_adr_livraison = $adresse->ref_adresse; }
		else { $this->ref_adr_livraison = ""; }
	}
	// *****************************************************
	// Adresse de facturation
	if (isset($infos['ref_adr_facturation'])) {
		$this->ref_adr_facturation = $infos['ref_adr_facturation'];
	}
	if (!$this->ref_adr_facturation) { $this->ref_adr_facturation = 1; }
	if (is_numeric($this->ref_adr_facturation)) {
		$query = "SELECT ref_adresse FROM adresses 
							WHERE ref_contact = '".$this->ref_contact."' 
							LIMIT ".($this->ref_adr_facturation-1).", 1 "; 
		$resultat = $bdd->query ($query);
		if ($adresse = $resultat->fetchObject()) { $this->ref_adr_facturation = $adresse->ref_adresse; }
		else { $this->ref_adr_facturation = ""; }
	}

	
	if (!isset($infos['type_client']) || !$infos['type_client'] ) {	$infos['type_client'] = "piste";}
	$this->type_client = $infos['type_client'];
	// *************************************************
	// Arret en cas d'erreur
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	// *************************************************
	// Insertion des données
	$query = "INSERT INTO annu_client
							(ref_contact, id_client_categ, type_client, id_tarif, ref_commercial, ref_adr_livraison, ref_adr_facturation, app_tarifs,
							 factures_par_mois, encours, delai_reglement, defaut_numero_compte)
						VALUES ('".$this->ref_contact."', ".num_or_null($this->id_client_categ).", '".$this->type_client."', 
										".num_or_null($this->id_tarif).", ".ref_or_null($this->ref_commercial).", 
										".ref_or_null($this->ref_adr_livraison).", ".ref_or_null($this->ref_adr_facturation).", 
										'".$this->app_tarifs."', '".$this->factures_par_mois."',  '".$this->encours."', 
										'".$this->delai_reglement."', '".$this->defaut_numero_compte."')"; 
	$bdd->exec($query);


	return true;
}



// *************************************************************************************************************
// MODIFICATION DES INFORMATIONS DU PROFIL [CLIENT]  
// *************************************************************************************************************
function maj_infos ($infos) {
	global $bdd;
	global $COMMERCIAL_ID_PROFIL;

	if (!$this->profil_loaded) {
		$GLOBALS['_ALERTES']['profil_non_chargé'] = 1;
	}

	// *************************************************
	// Controle des informations
	if (!is_numeric($infos['id_client_categ'])) {
		$GLOBALS['_ALERTES']['bad_id_client_categ'] = 1;
	}
	if ($infos['app_tarifs'] != "HT" && $infos['app_tarifs'] != "TTC") {
		$GLOBALS['_ALERTES']['bad_app_tarifs'] = 1;
	}
	if ($infos['factures_par_mois'] > 5 || $infos['factures_par_mois'] < 0) {
		$GLOBALS['_ALERTES']['bad_factures_par_mois'] = 1;
	}
	if (!is_numeric($infos['delai_reglement'])) {
		$GLOBALS['_ALERTES']['bad_delai_reglement'] = 1;
	}
	$this->id_client_categ 	= $infos['id_client_categ'];
	$this->id_tarif 				= $infos['id_tarif'];
	if (!$this->id_tarif) { 
		$this->id_tarif = "NULL";
	}
	//$this->ref_commercial = $infos['ref_commercial'];
	$this->ref_adr_livraison 		= $infos['ref_adr_livraison'];
	$this->ref_adr_facturation 	= $infos['ref_adr_facturation'];
	$this->app_tarifs 				= $infos['app_tarifs'];
	$this->type_client 				= $infos['type_client'];
	$this->factures_par_mois 	= $infos['factures_par_mois'];
	$this->encours					 	= $infos['encours'];
	$this->delai_reglement 		= $infos['delai_reglement'];
	
	if (isset($infos['ref_commercial'])  && $this->ref_commercial != $infos['ref_commercial']) { 
		$this->ref_commercial = $infos['ref_commercial'];
		
		if ($this->ref_commercial) {
			// Modification du profil
			$new_profils = array();
			$new_profils["id_profil"] = $COMMERCIAL_ID_PROFIL;
			$contact= new contact ($this->ref_commercial);
			if (!$contact->charger_profiled_infos ($new_profils["id_profil"])) {
				$contact->create_profiled_infos ($new_profils);
			}
		}
	}

	// Si App_tarifs en automatique on récupére l'app_tarifs le l'annuaire_categorie du contact
	if (!$this->app_tarifs) {	
		$query = "SELECT ac.app_tarifs
							FROM annuaire a
								LEFT JOIN annuaire_categories ac ON a.id_categorie = ac.id_categorie
							WHERE ref_contact = '".$this->ref_contact."' ";
		$resultat = $bdd->query ($query);
		if ($annuaire_categories = $resultat->fetchObject()) {
			$this->app_tarifs = $annuaire_categories->app_tarifs; 
		}
	}

	// *************************************************
	// Arret en cas d'erreur
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	// *************************************************
	// Mise à jour des données			
	$query = "UPDATE annu_client 
						SET id_client_categ = ".num_or_null($this->id_client_categ).", type_client = '".($this->type_client)."', id_tarif = ".num_or_null($this->id_tarif).", 
								ref_commercial = ".ref_or_null($this->ref_commercial).", ref_adr_livraison = ".ref_or_null($this->ref_adr_livraison).", 
								ref_adr_facturation = ".ref_or_null($this->ref_adr_facturation).", app_tarifs = '".$this->app_tarifs."',
								factures_par_mois = '".$this->factures_par_mois."', encours = '".$this->encours."', 
								delai_reglement = '".$this->delai_reglement."'
						WHERE ref_contact = '".$this->ref_contact."' ";
						echo $query;
	$bdd->exec($query);

	return true;
}

//mise à jour de l'adresse facturation
function maj_ref_adr_facturation ($ref_adr_facturation) {
	global $bdd;

		$this->ref_adr_facturation = $ref_adr_facturation;	
		$query = "UPDATE annu_client 
							SET ref_adr_facturation = '".$this->ref_adr_facturation."' 
							WHERE ref_contact = '".$this->ref_contact."' ";
		$bdd->exec($query);
	return true;
}
//mise à jour de l'adresse livraison
function maj_ref_adr_livraison ($ref_adr_livraison) {
	global $bdd;

		$this->ref_adr_livraison = $ref_adr_livraison;	
		$query = "UPDATE annu_client 
							SET ref_adr_livraison = '".$this->ref_adr_livraison."' 
							WHERE ref_contact = '".$this->ref_contact."' ";
		$bdd->exec($query);
	return true;
}

//mise à jour de l'app_tarif du profil
function maj_app_tarifs ($app_tarifs) {
	global $bdd;

	if ($app_tarifs == "HT" || $app_tarifs = "TTC") {
		$this->app_tarifs = $app_tarifs;	
		$query = "UPDATE annu_client 
							SET app_tarifs = '".$this->app_tarifs."' 
							WHERE ref_contact = '".$this->ref_contact."' ";
		$bdd->exec($query);
	}
	return true;
}


//mise à jour du type de client du profil depuis un document
function maj_type_client ($type_client) {
	global $bdd;

	//on empeche le changement dans certains cas
	if ($type_client == $this->type_client) { return false;	}
	if ($type_client == "prospect" && $this->type_client == "client") { return false;	}

	$this->type_client = $type_client;	
	$query = "UPDATE annu_client 
						SET type_client = '".$this->type_client."' 
						WHERE ref_contact = '".$this->ref_contact."' ";
	$bdd->exec($query);
	return true;
}

//mise à jour du defaut_numero_compte du profil
function maj_defaut_numero_compte ($defaut_numero_compte) {
	global $bdd;

		$this->defaut_numero_compte = $defaut_numero_compte;	
		$query = "UPDATE annu_client 
							SET defaut_numero_compte = '".$this->defaut_numero_compte."' 
							WHERE ref_contact = '".$this->ref_contact."' ";
		$bdd->exec($query);
	return true;
}



// *************************************************************************************************************
// SUPPRESSION DES INFORMATIONS DU PROFIL [CLIENT]  
// *************************************************************************************************************
function delete_infos () {
	global $bdd;

	// Vérifie si la suppression de ces informations est possible.
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}
	
	// Supprime les informations
	$query = "DELETE FROM annu_client WHERE ref_contact = '".$this->ref_contact."' ";
	$bdd->exec($query); 

	return true;
}



// *************************************************************************************************************
// TRANSFERT DES INFORMATIONS DU PROFIL [CLIENT]  
// *************************************************************************************************************
function transfert_infos ($new_contact, $is_already_profiled) {
	global $bdd;

	// Vérifie si le transfert de ces informations est possible.
	if (!$is_already_profiled) {
		// TRANSFERT les informations
		$query = "UPDATE annu_client SET ref_contact = '".$new_contact->getRef_contact()."' 
							WHERE ref_contact = '".$this->ref_contact."'";
		$bdd->exec($query); 
	}

	// *************************************************
	// Arret en cas d'erreur
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	return true;
}

// *************************************************************************************************************
// FONCTIONS DIVERSES 
// *************************************************************************************************************

// Chargement des derniers documents en cours concernant ce client
function charger_last_docs ($id_type_doc , $is_open = 0) {
	global $bdd;
	global $CONTACT_NB_LAST_DOCS_SHOWED;

	$last_docs = array();
	$query = "SELECT d.ref_doc, d.date_creation_doc date_creation, dt.lib_type_doc, de.lib_etat_doc, 
									 SUM(ROUND(dl.qte * dl.pu_ht * (1-dl.remise/100) * (1+dl.tva/100),2)) as montant_ttc
						FROM documents d 
							LEFT JOIN docs_lines dl ON dl.ref_doc = d.ref_doc && dl.visible = 1
							LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc
							LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc
						WHERE d.ref_contact = '".$this->ref_contact."' && dl.ref_doc_line_parent IS NULL && de.is_open = '".$is_open."' && d.id_type_doc = '".$id_type_doc."' 
						GROUP BY d.ref_doc 
						ORDER BY date_creation DESC, d.id_type_doc ASC
						LIMIT 0,".$CONTACT_NB_LAST_DOCS_SHOWED;
	$resultat = $bdd->query ($query);
	while ($doc = $resultat->fetchObject()) { 
		$last_docs[] = $doc;
	}
	return $last_docs;
}


//chargement du CA du client
function charger_client_CA () {
	global $bdd;
	
	$last_exercices = compta_exercices::charger_compta_exercices ();
	$liste_CA = array();
	for ($i = 0; $i < 3 ; $i++) {
		$montant_CA = 0;
		if (!isset($last_exercices[$i])) { break;}
		$query = "SELECT SUM(ROUND(dl.qte * dl.pu_ht * (1-dl.remise/100) ,2)) as montant_ttc
							FROM documents d 
								LEFT JOIN docs_lines dl ON dl.ref_doc = d.ref_doc && dl.visible = 1
								LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc
								LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc
							WHERE d.ref_contact = '".$this->ref_contact."' && dl.ref_doc_line_parent IS NULL && d.id_etat_doc IN (16,18,19)
										&& date_creation_doc < '".$last_exercices[$i]->date_fin."' && date_creation_doc > '".$last_exercices[$i]->date_debut."' 
							GROUP BY d.ref_doc 
							ORDER BY date_creation_doc DESC, d.id_type_doc ASC
							";
		$resultat = $bdd->query ($query);
		while ($doc = $resultat->fetchObject()) { 
			$montant_CA += $doc->montant_ttc;
		}
		$liste_CA[$i] = $montant_CA;
	}
	
	
	return $liste_CA;
}

//chargement des abonnements du client 
function charger_client_abo(){
	
	global $bdd;
	
	$liste_abo = array();
	$query = "	SELECT a.lib_article, aa.ref_article, aa.id_abo, aa.date_souscription, aa.date_echeance , aa.date_preavis, aa.fin_engagement, aa.fin_abonnement, amsa.reconduction
				FROM articles_abonnes aa
					LEFT JOIN articles_modele_service_abo amsa ON amsa.ref_article = aa.ref_article
					LEFT JOIN articles a ON a.ref_article = aa.ref_article
				WHERE aa.ref_contact = '".$this->getRef_contact()."'
				ORDER BY aa.date_echeance ASC;
				;";
	$resultat = $bdd->query($query);
	while ($abo = $resultat->fetchObject()) { $liste_abo[] = $abo; }
	unset ($abo, $resultat, $query);
	
	return $liste_abo;
}

//chargement des consommation (Services pré-payés) du client 
function charger_client_conso(){
	
	global $bdd;
	
	$liste_conso = array();
	$query = "	SELECT 	acc.id_compte_credit, a.lib_article, acc.ref_article, acc.date_souscription, acc.date_echeance, acc.credits_restants
				FROM 	articles_comptes_credits acc LEFT JOIN
						articles a ON a.ref_article = acc.ref_article
				WHERE 	acc.ref_contact = '".$this->getRef_contact()."' AND
						acc.credits_restants > 0
				ORDER BY acc.date_echeance ASC ;";
	$resultat = $bdd->query($query);
	while ($conso = $resultat->fetchObject()) { $liste_conso[] = $conso; }
	unset ($conso, $resultat, $query);
	
	return $liste_conso;
}

// *************************************************************************************************************
// FONCTIONS RELATIVE AUX CATEGORIES DE CLIENT
// *************************************************************************************************************
static public function charger_clients_categories () {
	global $bdd;

	$clients_categories = array();
	$query = "SELECT cc.id_client_categ , cc.lib_client_categ, cc.id_tarif, cc.ref_commercial,
					cc.factures_par_mois, cc.delai_reglement, cc.note,  cc.defaut_numero_compte, cc.defaut_encours,
					pc.lib_compte as defaut_lib_compte,
					a.nom as nom_commercial
						FROM clients_categories cc
						LEFT JOIN plan_comptable pc ON pc.numero_compte = cc.defaut_numero_compte
						LEFT JOIN annuaire a ON a.ref_contact = cc.ref_commercial
						ORDER BY cc.lib_client_categ ";
	$resultat = $bdd->query ($query);
	while ($var = $resultat->fetchObject()) { $clients_categories[] = $var; }

	return $clients_categories;
}


static public function create_client_categorie ($infos) {
	global $bdd;
	global $COMMERCIAL_ID_PROFIL;

	$ref_commercial = "";
	if (isset($infos['ref_commercial']) && $infos['ref_commercial']) { 
		$ref_commercial = $infos['ref_commercial'];
		// Modification du profil
		$new_profils = array();
		$new_profils["id_profil"] = $COMMERCIAL_ID_PROFIL;
		$contact= new contact ($infos['ref_commercial']);
		if (!$contact->charger_profiled_infos ($new_profils["id_profil"])) {
			$contact->create_profiled_infos ($new_profils);
		}
	}
	// *************************************************
	// Insertion des données
	$query = "INSERT INTO clients_categories  
							(lib_client_categ, id_tarif, ref_commercial, factures_par_mois, delai_reglement, note, defaut_encours ) 
						VALUES ('".addslashes($infos['lib_client_categ'])."', ".num_or_null($infos['id_tarif']).", ".ref_or_null($ref_commercial).", 
										'".addslashes($infos['factures_par_mois'])."', '".addslashes($infos['delai_reglement'])."', 
										'".addslashes($infos['note'])."', '".$infos['defaut_encours']."')"; 
	$bdd->exec($query);

	return true;
}


static public function maj_client_categorie ($infos) {
	global $bdd;
	global $COMMERCIAL_ID_PROFIL;

	$ref_commercial = "";
	if (isset($infos['ref_commercial']) && $infos['ref_commercial']) { 
		$ref_commercial = $infos['ref_commercial'];
		// Modification du profil
		$new_profils = array();
		$new_profils["id_profil"] = $COMMERCIAL_ID_PROFIL;
		$contact= new contact ($infos['ref_commercial']);
		if (!$contact->charger_profiled_infos ($new_profils["id_profil"])) {
			$contact->create_profiled_infos ($new_profils);
		}
	}
	// *************************************************
	// Mise à jour des données
	$query = "UPDATE clients_categories  
						SET lib_client_categ = '".addslashes($infos['lib_client_categ'])."', 
								factures_par_mois = '".addslashes($infos['factures_par_mois'])."', 
								delai_reglement = '".addslashes($infos['delai_reglement'])."',
								id_tarif = ".num_or_null($infos['id_tarif']).", ref_commercial = ".ref_or_null($ref_commercial).",
								note = '".addslashes($infos['note'])."', 
								defaut_encours = '".$infos['defaut_encours']."' 
						WHERE id_client_categ = '".$infos['id_client_categ']."' ";
	$bdd->exec($query);

	return true;
}


static public function maj_defaut_numero_compte_categories  ($infos) {
	global $bdd;
	
	// *************************************************
	// Mise à jour des données
	$query = "UPDATE clients_categories  
						SET defaut_numero_compte = '".addslashes($infos['defaut_numero_compte'])."'
						WHERE id_client_categ = '".$infos['id_client_categ']."' ";
	$bdd->exec($query);
	
	return true;
}

static public function delete_client_categorie ($id_client_categ) {
	global $bdd;
	global $DEFAUT_ID_CLIENT_CATEG;

	if ($id_client_categ == $DEFAUT_ID_CLIENT_CATEG) {
		$GLOBALS['_ALERTES']['last_id_client_categ'] = 1;
	}
	// Vérifie si la suppression de ces informations est possible.
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}
	// *************************************************
	// Suppression des données
	$query = "DELETE FROM clients_categories WHERE id_client_categ = '".$id_client_categ."' ";
	$bdd->exec($query);

	return true;
}



// *************************************************************************************************************
// FONCTIONS DE LECTURE DES DONNEES 
// *************************************************************************************************************
function getRef_contact () {
	return $this->ref_contact;
}

function getId_client_categ () {
	return $this->id_client_categ;
}

function getType_client () {
	return $this->type_client;
}

function getId_tarif () {
	return $this->id_tarif;
}

function getRef_commercial () {
	return $this->ref_commercial;
}

function getNom_commercial () {
	return $this->nom_commercial;
}

function getRef_adr_livraison () {
	return $this->ref_adr_livraison;
}

function getRef_adr_facturation () {
	return $this->ref_adr_facturation;
}

function getApp_tarifs () {
	return $this->app_tarifs;
}

function getFactures_par_mois () {
	return $this->factures_par_mois;
}

function getEncours () {
	return $this->encours;
}

function getDelai_reglement () {
	return $this->delai_reglement;
}

function getDefaut_numero_compte () {
	return $this->defaut_numero_compte;
}




}

?>