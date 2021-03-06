<?php
// *************************************************************************************************************
// CLASSE REGISSANT LES INFORMATIONS SUR UN DOCUMENT DE TYPE FACTURE CLIENT
// *************************************************************************************************************


final class doc_fac extends document {

	protected $ref_doc_externe;
	protected $id_magasin;
	protected $date_echeance;
	protected $id_niveau_relance;
	protected $date_next_relance;

	protected $id_client_categ;
	protected $niveaux_relances;
	protected $niveaux_relances_loaded;

	protected $ID_TYPE_DOC 					= 4;
	protected $LIB_TYPE_DOC 				= "Facture Client";
	protected $CODE_DOC 						= "FAC";
	protected $DOC_ID_REFERENCE_TAG = 18;

	protected $DEFAUT_ID_ETAT 	= 16;
	protected $DEFAUT_LIB_ETAT 	= "En saisie";
	protected $GESTION_SN	 		= 0;
	protected $CONTENT_FROM		= "CATALOGUE";
	protected $PU_FROM				= "PV";
	protected $ACCEPT_REGMT		= 1;
	protected $ID_ETAT_ANNULE	= 17;

	protected $doc_fusion_dispo;
	protected $doc_fusion_dispo_loaded;



public function open_doc ($select = "", $left_join = "") {
	global $bdd;

	$this->check_profils ();

	$select = ", df.id_magasin, df.date_echeance, df.ref_doc_externe, df.id_niveau_relance, df.date_next_relance, ac.id_client_categ ";
	$left_join = " LEFT JOIN doc_fac df ON df.ref_doc = d.ref_doc 
								 LEFT JOIN annu_client ac ON ac.ref_contact = d.ref_contact ";

	if (!$doc = parent::open_doc($select, $left_join)) { return false; }

	$this->ref_doc_externe	 	= $doc->ref_doc_externe;
	$this->id_magasin 				= $doc->id_magasin;
	$this->date_echeance	 		= $doc->date_echeance;
	$this->id_client_categ	 	= $doc->id_client_categ;
	$this->id_niveau_relance 	= $doc->id_niveau_relance;
	$this->date_next_relance 	= $doc->date_next_relance;

	// Bug lors d'importation
	if (!$this->id_magasin) {
		$query = "INSERT INTO doc_fac (ref_doc, id_magasin, date_echeance, id_niveau_relance, date_next_relance)
							VALUES ('".$this->ref_doc."', 1, '".$this->date_creation."', 1, '".$this->date_creation."') ";
		$bdd->exec ($query);
	}
	
	// Blocage des quantit?s
	if ($this->id_etat_doc == 18 || $this->id_etat_doc == 19) {
		//$this->quantite_locked = true;
	}
	
	return true;
}



// *************************************************************************************************************
// FONCTIONS LIEES A LA CREATION D'UN DOCUMENT
// *************************************************************************************************************

public function create_doc () { 
	global $bdd;
	global $DEFAUT_APP_TARIFS_CLIENT;
	global $DEFAUT_ID_MAGASIN;
	global $CLIENT_ID_PROFIL;

	$this->app_tarifs = $DEFAUT_APP_TARIFS_CLIENT;
	
	if (!parent::create_doc()) { return false; }

	// *************************************************
	// Informations compl?mentaires
	$this->id_magasin 				= $_SESSION['magasin']->getId_magasin (); //$DEFAUT_ID_MAGASIN;
	
	if (isset($GLOBALS['_OPTIONS']['CREATE_DOC']['ref_doc_externe'])) {
		$this->ref_doc_externe = $GLOBALS['_OPTIONS']['CREATE_DOC']['ref_doc_externe'];
	}
	
	$this->date_echeance 			= date ("Y-m-d H:i:s", time());
	if (is_object($this->contact) ) {
		$profil_client = $this->contact->getProfil ($CLIENT_ID_PROFIL);
		$this->date_echeance 			= date ("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")+$profil_client->getDelai_reglement (), date("Y")));
	}
	
	$this->id_niveau_relance 	= NULL;

	// S?lection de la relance adequate
	$this->date_next_relance 	= $this->date_echeance;
	
	$query = "INSERT INTO doc_fac (ref_doc, ref_doc_externe, id_magasin, date_echeance, id_niveau_relance, date_next_relance)
						VALUES ('".$this->ref_doc."', '".addslashes($this->ref_doc_externe)."', '".$this->id_magasin."', '".$this->date_echeance."', 
										".num_or_null($this->id_niveau_relance).", '".$this->date_next_relance."') ";
	$bdd->exec ($query);
	
	$this->attribution_commercial ($this->commerciaux);

	return true;
}


// Charge les informations suppl?mentaire du contact
protected function load_infos_contact () {
	global $CLIENT_ID_PROFIL;
	global $COMMERCIAL_ID_PROFIL;

	$this->load_infos_contact_client ();
	parent::load_infos_contact();
	
	$this->commerciaux = array();

	$user_commercial = new contact($_SESSION['user']->getRef_contact());
	if ($user_commercial->is_profiled ($COMMERCIAL_ID_PROFIL)) {
		$commercial = new stdclass;
		$commercial->ref_contact = $_SESSION['user']->getRef_contact();
		$commercial->part = 100;
		$this->commerciaux[] = $commercial;
	}

	if (is_object($this->contact)) {
		$profil_client = $this->contact->getProfil ($CLIENT_ID_PROFIL);
		$this->id_client_categ = $profil_client->getId_client_categ();
		$profil_client->maj_type_client ("client");
		if ($profil_client->getRef_commercial ()) {
			$this->commerciaux = array();
			$commercial = new stdclass;
			$commercial->ref_contact = $profil_client->getRef_commercial ();
			$commercial->part = 100;
			$this->commerciaux[] = $commercial;
		}
	}
	
	if (isset($this->ref_doc) && $this->ref_doc) {
		$this->attribution_commercial ($this->commerciaux);
	}
}

//attibution par d?faut du commercial
protected function load_defauts_infos_contact () {
	global $COMMERCIAL_ID_PROFIL;
	
	parent::load_defauts_infos_contact();

	$this->commerciaux = array();

	$user_commercial = new contact($_SESSION['user']->getRef_contact());
	if ($user_commercial->is_profiled ($COMMERCIAL_ID_PROFIL)) {
		$commercial = new stdclass;
		$commercial->ref_contact = $_SESSION['user']->getRef_contact();
		$commercial->part = 100;
		$this->commerciaux[] = $commercial;
		if (isset($this->ref_doc) && $this->ref_doc) {
			$this->attribution_commercial ($this->commerciaux);
		}
	}
	return true;
}


public function maj_contact ($ref_contact) {
	global $CLIENT_ID_PROFIL;
	
	parent::maj_contact($ref_contact);
	
	if (is_object($this->contact) ) {
		$profil_client = $this->contact->getProfil ($CLIENT_ID_PROFIL);
		$this->maj_date_echeance (date ("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")+$profil_client->getDelai_reglement (), date("Y"))));

	}
	
	
}

// Renvoie l'adresse a utiliser dans le document pour un contact donn?
function define_adresse_contact () {
	global $bdd;

	$adresse_contact_ok = 0;
	if (isset($GLOBALS['_OPTIONS']['CREATE_DOC']['ref_adr_contact'])) {
		$this->ref_adr_contact = $GLOBALS['_OPTIONS']['CREATE_DOC']['ref_adr_contact'];
		$adresse_contact_ok = 1;
	}
	if (isset($GLOBALS['_OPTIONS']['CREATE_DOC']['adresse_contact'])) {
		$this->adresse_contact = $GLOBALS['_OPTIONS']['CREATE_DOC']['adresse_contact'];
		$adresse_contact_ok = 1;
	}
	if (isset($GLOBALS['_OPTIONS']['CREATE_DOC']['code_postal_contact'])) {
		$this->code_postal_contact = $GLOBALS['_OPTIONS']['CREATE_DOC']['code_postal_contact'];
		$adresse_contact_ok = 1;
	}
	if (isset($GLOBALS['_OPTIONS']['CREATE_DOC']['ville_contact'])) {
		$this->ville_contact = $GLOBALS['_OPTIONS']['CREATE_DOC']['ville_contact'];
		$adresse_contact_ok = 1;
	}
	if (isset($GLOBALS['_OPTIONS']['CREATE_DOC']['id_pays_contact'])) {
		$this->id_pays_contact = $GLOBALS['_OPTIONS']['CREATE_DOC']['id_pays_contact'];
		$adresse_contact_ok = 1;
	}

	// S?lection des adresses pr?d?finies
	if (!$adresse_contact_ok) {
		$query = "SELECT ref_adr_facturation, a1.text_adresse ta1, a1.code_postal cp1, a1.ville v1, a1.id_pays ip1, p1.pays p1
							FROM annu_client ac
								LEFT JOIN adresses a1 ON ac.ref_adr_livraison = a1.ref_adresse
								LEFT JOIN pays p1 ON a1.id_pays = p1.id_pays
							WHERE ac.ref_contact = '".$this->ref_contact."' ";
		$resultat = $bdd->query ($query);
		if (!$a = $resultat->fetchObject()) { return false; }

		$this->ref_adr_contact 	 	= $a->ref_adr_facturation;
		$this->adresse_contact 			= $a->ta1;
		$this->code_postal_contact 	= $a->cp1 ;
		$this->ville_contact 				= $a->v1 ;
		$this->id_pays_contact 			= $a->ip1 ;
		$this->pays_contact 				= $a->p1 ;
	}

	return true;
}



// *************************************************************************************************************
// FONCTIONS LIEES A LA MODIFICATION D'UN DOCUMENT
// *************************************************************************************************************
// Met ? jour l' id_magasin pour cette facture
public function maj_id_magasin ($new_id_magasin) {
	global $bdd;	

	if (!is_numeric($new_id_magasin)) {
		$GLOBALS['_ALERTES']['bad_id_magasin'] = 1;
	}

	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	$this->id_magasin = $new_id_magasin;
	// *************************************************
	// MAJ de la base
	$query = "UPDATE doc_fac 
						SET id_magasin = '".$this->id_magasin."'
						WHERE ref_doc = '".$this->ref_doc."' ";
	$bdd->exec ($query);

	// *************************************************
	// Retour des informations
	$GLOBALS['_INFOS']['id_magasin'] = $this->id_magasin;

	return true;
}

// Met ? jour la ref_doc_externe
public function maj_ref_doc_externe ($ref_doc_externe) {
	global $bdd;	

	$this->ref_doc_externe = $ref_doc_externe;

	// *************************************************
	// MAJ de la base
	$query = "UPDATE doc_fac 
						SET ref_doc_externe = '".addslashes($this->ref_doc_externe)."'
						WHERE ref_doc = '".$this->ref_doc."' ";
	$bdd->exec ($query);
	
	return true;
}

// Met ? jour la date d'?ch?ance de la facture
public function maj_date_echeance ($new_date_echeance) {
	global $bdd;

	// Controler la date!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	$this->date_echeance = $new_date_echeance;

	// *************************************************
	// MAJ de la base
	$query = "UPDATE doc_fac 
						SET date_echeance = '".$this->date_echeance."'
						WHERE ref_doc = '".$this->ref_doc."' ";
	$bdd->exec ($query);

	// *************************************************
	// Retour des informations
	$GLOBALS['_INFOS']['date_echeance'] = $this->date_echeance;

	return true;
}


// Met ? jour le niveau de relance pour cette facture
public function maj_id_niveau_relance ($new_id_niveau_relance) {
	global $bdd;	

	$this->date_next_relance = "";
	if (!is_numeric($new_id_niveau_relance)) {
		$this->id_niveau_relance = "NULL";
	}
	else {
		$this->id_niveau_relance = $new_id_niveau_relance;
		$this->date_next_relance = date ("Y-m-d H:i:s", time());
	}

	// *************************************************
	// MAJ de la base
	$query = "UPDATE doc_fac 
						SET id_niveau_relance = ".num_or_null($this->id_niveau_relance)." , date_next_relance = '".$this->date_next_relance."'
						WHERE ref_doc = '".$this->ref_doc."' ";
	$bdd->exec ($query);

	// *************************************************
	// Retour des informations
	$GLOBALS['_INFOS']['id_niveau_relance'] = $this->id_niveau_relance;

	return true;
}


// Met ? jour le d?lai avant la prochaine relance, pour cette facture
public function maj_date_next_relance ($new_date_next_relance) {
	global $bdd;

	// Controler la date!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	$this->date_next_relance = $new_date_next_relance;

	// *************************************************
	// MAJ de la base
	$query = "UPDATE doc_fac 
						SET date_next_relance = '".$this->date_next_relance."'
						WHERE ref_doc = '".$this->ref_doc."' ";
	$bdd->exec ($query);

	// *************************************************
	// Retour des informations
	$GLOBALS['_INFOS']['date_next_relance'] = $this->date_next_relance;

	return true;
}



// Liste des documents pouvant ?tre fusionner
public function check_allow_fusion ($second_document) {
	//verifcation que l'?tat des document permet la fusion
	if (($this->id_etat_doc != "16" && $this->id_etat_doc != "18") && ($second_document->getId_etat_doc () != "16" && $second_document->getId_etat_doc () != "18")) {
		return false;
	}
	return true;
}


// Liste des documents pouvant ?tre fusionner
public function liste_doc_fusion () {
	global $bdd;
	
	$this->doc_fusion_dispo = array();
	$query = "SELECT d.ref_doc, d.id_type_doc, dt.lib_type_doc, d.id_etat_doc, de.lib_etat_doc, d.ref_contact, d.nom_contact,
										( SELECT SUM(dl.qte * dl.pu_ht * (1-dl.remise/100) * (1+dl.tva/100))
									 		FROM docs_lines dl
									 		WHERE d.ref_doc = dl.ref_doc && ISNULL(dl.ref_doc_line_parent) && visible = 1 
									 	) as montant_ttc,
									 	d.date_creation_doc as date_doc
						FROM documents d 
							LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc 
							LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc 
						WHERE (d.id_etat_doc = '16' ||  d.id_etat_doc = '18' ) && d.ref_contact = '".$this->ref_contact."' && d.ref_doc != '".$this->ref_doc."'
						GROUP BY d.ref_doc
						ORDER BY date_doc DESC ";
	$resultat = $bdd->query ($query);
	while ($doc = $resultat->fetchObject()) {$this->doc_fusion_dispo[] = $doc;}
	
	$this->doc_fusion_dispo_loaded = true;
	return true;
}



// *************************************************************************************************************
// FONCTIONS DIVERSES 
// *************************************************************************************************************

// PROFILS DE CONTACT NECESSAIRE POUR UTILISER CE TYPE DE DOCUMENT
function check_profils () {
	return $this->check_profil_client ();
}


protected function charger_niveaux_relances () {
	global $bdd;

	$this->niveaux_relances = array();
	$this->niveaux_relances_loaded = true;
	$add_query = "id_client_categ = '".$this->id_client_categ."' ||";
	if (!$this->id_client_categ) { $add_query = ""; }

	$query = "SELECT id_niveau_relance, lib_niveau_relance, impression
						FROM factures_niveaux_relances fnr
						WHERE ".$add_query." ISNULL(id_client_categ) 
						ORDER BY niveau_relance ";
	$resultat = $bdd->query ($query);
	while ($tmp = $resultat->fetchObject()) { $this->niveaux_relances[] = $tmp; }

	return true;
}



// Action apr?s de changer l'?tat du document
protected function action_after_maj_etat ($old_etat_doc) {
	global $bdd;

	switch ($old_etat_doc) {
		case 16: case 17:
			if ($this->id_etat_doc == 18 || $this->id_etat_doc == 19) {
				// ajout de la ligne comptable
				$this->ajout_ventilation_facture ();
				//$this->quantite_locked = true;
				if($this->id_etat_doc == 18){
					$this->check_etat_reglement();
				}
			}
		break;
		case 18: case 19:
			if ($this->id_etat_doc == 16 || $this->id_etat_doc == 17 ) {
				// suppression des lignes comptables du document
				$this->supprime_ventilation_facture ();
				//$this->quantite_locked = false;	
			}
		break;
	}

	return true;
}

protected function create_info_copie_line_texte ($doc_source) { 
	if (method_exists($doc_source , "getRef_doc_externe") && $doc_source->getRef_doc_externe()){
		return "Votre r?f?rence: ".$doc_source->getRef_doc_externe(); 
	}
	return "";
}
// *************************************************************************************************************
// FONCTIONS SPECIFIQUES AU TYPE DE DOC 
// *************************************************************************************************************

// G?n?re une facture d'avoir des produits s?lectionn?s
public function generer_facture_avoir_client ($lines = false) {
	
	if (is_array($lines)) {
		$GLOBALS['_OPTIONS']['COPIE_LINE']['INVERT_QTE'] = 1;
		$GLOBALS['_OPTIONS']['CREATE_DOC']['doc_lines'] = $lines;
	}
	$GLOBALS['_OPTIONS']['CREATE_DOC']['follow_commerciaux'] = 1;
	return $this->copie_doc (4);
}

// *************************************************************************************************************
// FONCTIONS DE VENTILATION COMPTABLE
// *************************************************************************************************************
// chargement ventilation facture client
function charger_ventilation_facture () {
	global $bdd;
	global $DEFAUT_COMPTE_HT_VENTE;
	global $DEFAUT_COMPTE_TVA_VENTE;
	global $DEFAUT_COMPTE_TIERS_VENTE;
	
	$defaut_num_compte = array();
	$defaut_num_compte[3] = $DEFAUT_COMPTE_HT_VENTE;
	$defaut_num_compte[4] = $DEFAUT_COMPTE_TVA_VENTE;
	$defaut_num_compte[5] = $DEFAUT_COMPTE_TIERS_VENTE;


	$id_journal_vente = 1;
	$ventillation_facture = array();
	
	$query = "SELECT id_journal, lib_journal, desc_journal, id_journal_parent
						FROM compta_journaux 
						WHERE id_journal_parent = '".$id_journal_vente."'
						";
	$resultat = $bdd->query ($query);
	while ($doc = $resultat->fetchObject()) {
	
		$ventillation_facture[$doc->id_journal] = array();
		$query2 = "SELECT numero_compte, montant, ref_doc, id_journal
							FROM compta_docs 
							WHERE ref_doc = '".$this->ref_doc."' && id_journal ='".$doc->id_journal."'
							";
		$resultat2 = $bdd->query ($query2);
		while ($doc2 = $resultat2->fetchObject()) {
			if (!$doc2->numero_compte) {!$doc2->numero_compte = $defaut_num_compte[$doc2->id_journal];}
			$ventillation_facture[$doc->id_journal][] = $doc2;
		}
	}
	return $ventillation_facture;
}


//ajout de lignes de ventilation
/* 2.044+ Fixed number_format */
function ajout_ventilation_facture ($infos_lines = array()) {
	global $bdd;
	global $DEFAUT_ID_PAYS;
	global $DEFAUT_COMPTE_HT_VENTE;
	global $DEFAUT_COMPTE_TVA_VENTE;
	global $DEFAUT_COMPTE_TIERS_VENTE;
	global $DEFAUT_ID_CLIENT_CATEG;
	global $CLIENT_ID_PROFIL;
	global $TARIFS_NB_DECIMALES; 
	
	//si aucunes donn?es transmise on cr? un ligne d'apr?s les infos de chaque art_categ pr?sent , TVA et TTC compte tier client)
	if (!count($infos_lines)) {
		$calcul_TTC = 0;
		//comptes HT VENTE
		// chargement des art_categ pr?sents dans le doc		
		$query = "SELECT DISTINCT ac.ref_art_categ, 
										ac.defaut_numero_compte_vente,
										( 
										 	SELECT SUM(t.pu_ht * t.qte * (1-t.remise/100))
											FROM articles ab 
												LEFT JOIN docs_lines t ON t.ref_article = ab.ref_article && visible = 1
											WHERE t.ref_doc = '".$this->ref_doc."' &&  ac.ref_art_categ = ab.ref_art_categ && ISNULL(t.ref_doc_line_parent)
											
										)  as montant_ht
							
							FROM art_categs ac 
								LEFT JOIN articles a ON a.ref_art_categ = ac.ref_art_categ
								LEFT JOIN docs_lines dl ON dl.ref_article = a.ref_article
							WHERE ref_doc = '".$this->ref_doc."' && ISNULL(dl.ref_doc_line_parent)  
							 ";
		$resultat = $bdd->query ($query);
		while ($art_categ = $resultat->fetchObject()) {
			if (!$art_categ->defaut_numero_compte_vente) {$art_categ->defaut_numero_compte_vente= $DEFAUT_COMPTE_HT_VENTE;}
			//sauvegarde de la ligne dans compta_docs HT vente
			$query3 = "INSERT INTO compta_docs  (numero_compte, montant, ref_doc, id_journal)
								VALUES ('".$art_categ->defaut_numero_compte_vente."', '".number_format(round($art_categ->montant_ht,2), $TARIFS_NB_DECIMALES, ".", ""	)."',  '".$this->ref_doc."' , '3') 
								";
			$bdd->exec ($query3);
			unset($query3);
			$calcul_TTC += number_format(round($art_categ->montant_ht,2), $TARIFS_NB_DECIMALES, ".", ""	);
		}
		unset($query, $resultat);
		
		//comptes TVA collect?e
		$liste_tvas =  get_tvas($DEFAUT_ID_PAYS);
		// chargement des tva pr?sents dans le doc		
		$doc_tvas = $this->getTVAs ();
		
		foreach ($doc_tvas as $ttva=>$val_tva) {
			$defaut_num_compte_tva = $DEFAUT_COMPTE_TVA_VENTE;
			foreach($liste_tvas as $db_tva) {
				if ($ttva == $db_tva["tva"]) {$defaut_num_compte_tva = $db_tva["num_compte_vente"];}
			}
			if (!$defaut_num_compte_tva) {$defaut_num_compte_tva = $DEFAUT_COMPTE_TVA_VENTE;}
			//sauvegarde de la ligne dans compta_docs TVA vente
			$query3 = "INSERT INTO compta_docs  (numero_compte, montant, ref_doc, id_journal)
								VALUES ('".$defaut_num_compte_tva."', '".number_format(round($val_tva,2), $TARIFS_NB_DECIMALES, ".", ""	)."',  '".$this->ref_doc."' , '4') 	";
			$bdd->exec ($query3);
			unset($query3);
			$calcul_TTC += number_format(round($val_tva,2), $TARIFS_NB_DECIMALES, ".", ""	);
		}
		
		//compte tier vente (categorie client)
		$categorie_client = $DEFAUT_ID_CLIENT_CATEG;
		$compte_ttc_defaut =  $DEFAUT_COMPTE_TIERS_VENTE;
		$contact = new contact ($this->ref_contact);
		contact::load_profil_class($CLIENT_ID_PROFIL);
		if (is_object($contact) && $contact->getRef_contact ()) {
			$contact_profil = $contact->getProfil($CLIENT_ID_PROFIL);
			$compte_ttc_defaut = $contact_profil->getDefaut_numero_compte ();
		} else {
			$liste_categ = contact_client::charger_clients_categories ();
			foreach ($liste_categ as $categ) {
				if ($categ->id_client_categ != $categorie_client) {continue;}
				if ($categ->defaut_numero_compte) {$compte_ttc_defaut = $categ->defaut_numero_compte; break;}
				
			}
		}
		if (!$compte_ttc_defaut) {$compte_ttc_defaut = $DEFAUT_COMPTE_TIERS_VENTE;}
		//verification de la correspondance au centime du total TVA + HT = TTC
		if (abs(round($this->getMontant_ttc (),2))-0.01 <= abs($calcul_TTC)  && abs(round($this->getMontant_ttc (),2))+0.01 >= abs($calcul_TTC)) {
		//sauvegarde de la ligne dans compta_docs TTC vente
		$query3 = "INSERT INTO compta_docs  (numero_compte, montant, ref_doc, id_journal)
							VALUES ('".$compte_ttc_defaut ."', '".number_format(round($calcul_TTC,2), $TARIFS_NB_DECIMALES, ".", ""	)."',  '".$this->ref_doc."' , '5') 	";
		$bdd->exec ($query3);
		unset($query3);
		}
		return true;
	}
	
	foreach ($infos_lines as $line) {
		//sinon les infos sont envoy?es depuis un ou plusieurs ligne (pop_up_compta), on cr? donc un enregistrement
		$query = "INSERT INTO compta_docs  (numero_compte, montant, ref_doc, id_journal)
							VALUES ('".$line["numero_compte"]."', '".$line["montant"]."', '".$this->ref_doc."' , '".$line["id_journal"]."' ) 
							";
		$bdd->exec ($query);
		unset($query);
	}
	
	return true;
}

//suppression des lignes de compta de la fac
function supprime_ventilation_facture () {
	global $bdd;

	$query = "DELETE FROM compta_docs
						WHERE ref_doc = '".$this->ref_doc."'
						";
	$bdd->exec ($query);
	return true;
}

//verification des lignes de compta (en cas de changement dans le contenu du document)
function check_ventilation_facture () {
	global $bdd;
	global $TARIFS_NB_DECIMALES;
	global $DEFAUT_COMPTE_HT_VENTE;
	global $DEFAUT_COMPTE_TVA_VENTE;
	global $DEFAUT_COMPTE_TIERS_VENTE;
	
	
	//on verifie si la facture est toujours acquit?e
	$this->charger_reglements();
	$this->check_etat_reglement();
	
	//on bloque si la facture n'est pas ? r?gler ou acquit?e
	if ($this->id_etat_doc == 16 || $this->id_etat_doc == 17 ) { return false; }
	
	$ventilation_facture = $this->charger_ventilation_facture ();
	if (count($ventilation_facture)) {
		
			// si plusieurs lignes de d?finies
			// on verifie que le montant du document correspond au montant ht des lignes comptables par journal
			$tmp_montant_ht = 0;
			$tmp_montant_tva = 0;
			$tmp_montant_ttc = 0;
			foreach ($ventilation_facture as $line) {
				if (isset($line['3'])) {	$tmp_montant_ht += $line['3']->montant;}
				if (isset($line['4'])) {	$tmp_montant_tva += $line['4']->montant;}
				if (isset($line['5'])) {	$tmp_montant_ttc += $line['5']->montant;}
			}
			if ((abs(number_format($this->getMontant_ht (), $TARIFS_NB_DECIMALES, ".", ""	))-0.01 <=  abs(number_format($tmp_montant_ht, $TARIFS_NB_DECIMALES, ".", ""	)) && abs(number_format($tmp_montant_ht, $TARIFS_NB_DECIMALES, ".", ""	)) <= abs(number_format($this->getMontant_ht (), $TARIFS_NB_DECIMALES, ".", ""	))+0.01) && ( abs(number_format($this->getMontant_tva (), $TARIFS_NB_DECIMALES, ".", ""	))-0.01 <= abs(number_format($tmp_montant_tva, $TARIFS_NB_DECIMALES, ".", ""	)) && abs(number_format($tmp_montant_tva, $TARIFS_NB_DECIMALES, ".", ""	)) <= abs(number_format($this->getMontant_tva (), $TARIFS_NB_DECIMALES, ".", ""	))+0.01) && (abs(number_format($this->getMontant_ttc (), $TARIFS_NB_DECIMALES, ".", ""	))-0.01 <= abs(number_format($tmp_montant_ttc, $TARIFS_NB_DECIMALES, ".", ""	)) && abs(number_format($tmp_montant_ttc, $TARIFS_NB_DECIMALES, ".", ""	)) <= abs(number_format($this->getMontant_ttc (), $TARIFS_NB_DECIMALES, ".", ""	))+0.01)) {return true;}
			//si ce n'est pas le cas
			// on supprime puis on ajoute une ligne avec les valeurs par defaut
			$this->supprime_ventilation_facture ();
		
	}
	//on ajoute une ligne avec les valeurs par defaut
	$this->ajout_ventilation_facture ();
	return true;

}

//fonctions de mise ? jour lignes si non bloqu?e et des doc_fac_compta en cas de changement du contenu du document

protected function add_line_article ($infos) {
	if (!$this->quantite_locked) {
		parent::add_line_article ($infos);
		$this->check_ventilation_facture ();
	}
}

public function delete_line ($ref_doc_line) {
	if (!$this->quantite_locked) {
		$doc_line_infos = $this->charger_line ($ref_doc_line);
		parent::delete_line ($ref_doc_line);
		if ($doc_line_infos->type_of_line == "article") {
			$this->check_ventilation_facture ();
		}
	}
	
}

public function maj_line_qte ($ref_doc_line, $new_qte) {
	if (!$this->quantite_locked) {
		parent::maj_line_qte ($ref_doc_line, $new_qte);
		$this->check_ventilation_facture ();
	}
}

public function maj_line_pu_ht ($ref_doc_line, $new_pu_ht) {
	if (!$this->quantite_locked) {
		parent::maj_line_pu_ht ($ref_doc_line, $new_pu_ht);
		$this->check_ventilation_facture ();
	}
}
public function maj_line_tva ($ref_doc_line, $new_tva) {
	if (!$this->quantite_locked) {
		parent::maj_line_tva ($ref_doc_line, $new_tva);
		$this->check_ventilation_facture ();
	}
}

public function maj_line_remise ($ref_doc_line, $new_remise) {
	if (!$this->quantite_locked) {
		parent::maj_line_remise ($ref_doc_line, $new_remise);
		$this->check_ventilation_facture ();
	}
}

public function set_line_visible ($ref_doc_line) {
	if (!$this->quantite_locked) {
		$doc_line_infos = $this->charger_line ($ref_doc_line);
		parent::set_line_visible ($ref_doc_line);
		if ($doc_line_infos->type_of_line == "article") {
			$this->check_ventilation_facture ();
		}
	}
}

public function set_line_invisible ($ref_doc_line) {
	if (!$this->quantite_locked) {
		$doc_line_infos = $this->charger_line ($ref_doc_line);
		parent::set_line_invisible ($ref_doc_line);
		if ($doc_line_infos->type_of_line == "article") {
			$this->check_ventilation_facture ();
		}
	}
}





// *************************************************************************************************************
// FONCTIONS DE LIAISON ENTRE DOCUMENTS 
// *************************************************************************************************************
// Chargement des documents ? lier: Bon de Livraison (3) non annul? (!=12), non li? a une facture (4)
public function charger_liaisons_possibles () {
	global $bdd;

	$this->liaisons_possibles = array();
	if ($this->id_etat_doc == 17 || $this->id_etat_doc == 19) {$this->liaisons_possibles_loaded = true; return true;}
	
	$query = "SELECT d.ref_doc, d.id_type_doc, dt.lib_type_doc, d.id_etat_doc, de.lib_etat_doc,
									 d.date_creation_doc date_creation
						FROM documents d
							LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc 
							LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc 
							LEFT JOIN documents_liaisons dl ON d.ref_doc = dl.ref_doc_source && dl.active = 1
							LEFT JOIN documents d2 ON d2.ref_doc = dl.ref_doc_destination && d2.id_type_doc = 4 
						WHERE d.ref_contact = ".ref_or_null($this->ref_contact)." && 
									d.id_type_doc = 3 && d.id_etat_doc != 12 && d2.ref_doc IS NULL 
						ORDER BY date_creation ";
	$resultat = $bdd->query($query); 
	while ($tmp = $resultat->fetchObject()) { $this->liaisons_possibles[] = $tmp; }

	$this->liaisons_possibles_loaded = true;

	return true;
}



// *************************************************************************************************************
// FONCTIONS DE GESTION DES REGLEMENTS
// *************************************************************************************************************

protected function need_infos_facturation () {
	// Si la facture est annul?e ou acquitt?e, les informations de facturation ne sont pas n?cessaires.
	if ($this->id_etat_doc == $this->ID_ETAT_ANNULE || $this->id_etat_doc == 19) { return false; }
	return true;
}


protected function reglement_inexistant () {
	if ($this->id_etat_doc == $this->ID_ETAT_ANNULE) { return false; }

	// Une facture devient "? r?gler" si aucun r?glement n'est enregistr?, sauf si en saisie
	if ($this->id_etat_doc == 16) { return false; }
	$this->maj_etat_doc(18);

	$_SESSION['INFOS']['change_etat'] = 1;
	
	return true;
}


protected function reglement_partiel () {
	if ($this->id_etat_doc == $this->ID_ETAT_ANNULE) { return false; }

	// Une facture devient "? r?gler" en cas de r?glement partiel, sauf si en saisie
	if ($this->id_etat_doc == 16) { return false; }
	$this->maj_etat_doc(18);

	$_SESSION['INFOS']['change_etat'] = 1;
	
	return true;
}


protected function reglement_total () {
	if ($this->id_etat_doc == $this->ID_ETAT_ANNULE) { return false; }

	// Une facture devient acquitt?e en cas de r?glement total (sauf si d?j? acquitt?e)
	if ($this->id_etat_doc == 19 || abs($this->montant_ttc) == 0) { return false; }
	$this->maj_etat_doc(19);

	$_SESSION['INFOS']['change_etat'] = 1;
	
	return true;
}


protected function check_after_creation () {
	$this->check_etat_reglement ();
}


public function create_avc () {
	global $AVC_E_ID_REGMT_MODE;
	global $COMP_S_ID_REGMT_MODE;

	// Chargement du montant disponible pour cet avoir
	$this->calcul_montant_to_pay ();

	// Cr?ation de la "Compensation" et de l'"Avoir Client"
	$infos_comp['ref_contact'] 			= $this->ref_contact;
	$infos_comp['id_reglement_mode'] = $COMP_S_ID_REGMT_MODE;
	$infos_comp['date_reglement']	= date ("Y-m-d", time());
	$infos_comp['date_echeance']		= date ("Y-m-d", time());
	$infos_comp['direction_reglement'] = "sortant";
	$infos_comp['montant_reglement'] = abs($this->montant_to_pay);
	$comp = new reglement();
	$comp->create_reglement($infos_comp);

	// Association de la compensation ? cette facture
	$tmp = $this->rapprocher_reglement ($comp);;
	// Retour de l'information sur l'avoir g?n?r?
	$ref_avc = $comp->getRef_avc();
	return $ref_avc;
}

// *************************************************************************************************************
// FONCTIONS DE RESTITUTION DES DONNEES 
// *************************************************************************************************************
 
function getRef_doc_externe () {
	return $this->ref_doc_externe;
} 
 
function getDate_echeance () {
	return $this->date_echeance;
}

function getId_niveau_relance () {
	return $this->id_niveau_relance;
}
 
function getDate_next_relance () {
	return $this->date_next_relance;
}
 
function getNiveaux_relances () {
	if (!$this->niveaux_relances_loaded) {
		$this->charger_niveaux_relances(); 
	}
	return $this->niveaux_relances;
}

function getId_magasin () {
	return $this->id_magasin;
}

function getDoc_fusion_dispo () {
	if (!$this->doc_fusion_dispo_loaded) {$this->liste_doc_fusion ();}
	return  $this->doc_fusion_dispo;
}

}

?>