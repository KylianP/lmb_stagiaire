<?php
// *************************************************************************************************************
// CLASSE PERMETTANT LA GESTION D'UN CONTACT AYANT LE PROFIL [COLLAB]  
// *************************************************************************************************************


class contact_collab extends contact_profil {
	private $numero_secu;
	private $date_naissance;
	private $lieu_naissance;

	private $id_pays_nationalite;
	private $nationalite;

	private $situation_famille;
	private $nbre_enfants;

	private $fonctions;
	private $fonctions_loaded = false;


function __construct ($ref_contact, $action = "open") {
	global $bdd;

	$this->ref_contact = $ref_contact;
	
	if ($action == "create") {
		return false;
	}

	$query = "SELECT numero_secu, date_naissance, lieu_naissance, ac.id_pays_nationalite, pays, situation_famille, nbre_enfants
						FROM annu_collab ac
							LEFT JOIN pays p ON ac.id_pays_nationalite = p.id_pays
						WHERE ref_contact = '".$this->ref_contact."' ";	
	$resultat = $bdd->query ($query);

	// Controle si la ref_contact est trouvée
	if (!$contact_collab = $resultat->fetchObject()) { return false; }
	
	$this->numero_secu 		= $contact_collab->numero_secu;
	$this->date_naissance = $contact_collab->date_naissance;
	$this->lieu_naissance = $contact_collab->lieu_naissance;
	$this->id_pays_nationalite 	= $contact_collab->id_pays_nationalite;
	$this->nationalite 					= $contact_collab->pays;
	$this->situation_famille 	= $contact_collab->situation_famille;
	$this->nbre_enfants 			= $contact_collab->nbre_enfants;

	$this->profil_loaded 	= true;
}



// *************************************************************************************************************
// CREATION DES INFORMATIONS DU PROFIL [COLLAB]  
// *************************************************************************************************************
function create_infos ($infos) {
	global $DIR, $CONFIG_DIR;
	global $bdd;

	// Controle si ces informations sont déjà existantes
	if ($this->profil_loaded) {
		return false;
	}

	// Fichier de configuration de ce profil
	include_once ($CONFIG_DIR."profil_collab.config.php");

	// *************************************************
	// Controle des informations
	$this->numero_secu 		= $infos['numero_secu'];
	$this->date_naissance = $infos['date_naissance'];
	$this->lieu_naissance = $infos['lieu_naissance'];
	$this->id_pays_nationalite 	= $infos['id_pays_nationalite'];
	$this->situation_famille 		= $infos['situation_famille'];
	$this->nbre_enfants 	= $infos['nbre_enfants'];
	if (!is_numeric($this->nbre_enfants) && $this->nbre_enfants != "NULL") {
		$GLOBALS['_ALERTES']['bad_nbre_enfants'] = 1;
	}

	// *************************************************
	// Arret en cas d'erreur
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	// *************************************************
	// Insertion des données
	$query = "INSERT INTO annu_collab 
							(ref_contact, numero_secu, date_naissance, lieu_naissance, id_pays_nationalite, situation_famille, nbre_enfants) 
						VALUES ('".$this->ref_contact."', '".$this->numero_secu."', 
										'".$this->date_naissance."', '".addslashes($this->lieu_naissance)."', 
										".num_or_null($this->id_pays_nationalite).", 
										'".addslashes($this->situation_famille)."', ".num_or_null($this->nbre_enfants)." )"; 
	$bdd->exec($query);

	return true;
}



// *************************************************************************************************************
// MODIFICATION DES INFORMATIONS DU PROFIL [COLLAB]  
// *************************************************************************************************************
function maj_infos ($infos) {
	
	global $bdd;

	if (!$this->profil_loaded) {
		$GLOBALS['_ALERTES']['profil_non_chargé'] = 1;
	}

	// *************************************************
	// Controle des informations
	$this->numero_secu 		= $infos['numero_secu'];
	$this->date_naissance = $infos['date_naissance'];
	$this->lieu_naissance = $infos['lieu_naissance'];
	$this->id_pays_nationalite 	= $infos['id_pays_nationalite'];
	$this->situation_famille 		= $infos['situation_famille'];
	$this->nbre_enfants 	= $infos['nbre_enfants'];
	if (!is_numeric($this->nbre_enfants) && $this->nbre_enfants != "NULL") {
		$GLOBALS['_ALERTES']['bad_nbre_enfants'] = 1;
	}

	// *************************************************
	// Arret en cas d'erreur
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	// *************************************************
	// Mise à jour des données
	$query = "UPDATE annu_collab 
						SET numero_secu = '".$this->numero_secu."', date_naissance = '".$this->date_naissance."', 
								lieu_naissance = '".addslashes($this->lieu_naissance)."', 
								id_pays_nationalite = ".num_or_null($this->id_pays_nationalite).", 
								situation_famille = '".addslashes($this->situation_famille)."', 
								nbre_enfants = ".num_or_null($this->nbre_enfants)." 
						WHERE ref_contact = '".$this->ref_contact."' ";
	$bdd->exec($query);

	return true;
}



// *************************************************************************************************************
// SUPPRESSION DES INFORMATIONS DU PROFIL [COLLAB]  
// *************************************************************************************************************
function delete_infos () {
	global $bdd;
	
	
	// Vérifie si la suppression de ces informations est possible.
	
	// Supprime les informations
	$query = "DELETE FROM annu_collab WHERE ref_contact = '".$this->ref_contact."' ";
	$bdd->exec($query); 
	
	
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	return true;
}



// *************************************************************************************************************
// TRANSFERT DES INFORMATIONS DU PROFIL [COLLAB]  
// *************************************************************************************************************
function transfert_infos ($new_contact, $is_already_profiled) {
	global $bdd;

	// Vérifie si le transfert de ces informations est possible.
	if (!$is_already_profiled) {
		// TRANSFERT les informations
		$query = "UPDATE annu_collab SET ref_contact = '".$new_contact->getRef_contact()."' 
							WHERE ref_contact = '".$this->ref_contact."'";
		$bdd->exec($query); 
	}


	$query = "UPDATE annu_collab_fonctions SET ref_contact = '".$new_contact->getRef_contact()."'
						WHERE ref_contact = '".$this->ref_contact."'";
	$bdd->exec($query); 

	$query = "UPDATE taches_collabs SET ref_contact = '".$new_contact->getRef_contact()."'
						WHERE ref_contact = '".$this->ref_contact."'";
	$bdd->exec($query); 

	// *************************************************
	// Arret en cas d'erreur
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	return true;
}



// *************************************************************************************************************
// GESTION DES FONCTIONS DE COLLABORATEUR [COLLAB]  
// *************************************************************************************************************

// Charge les fonctions d'appartenance pour le collaborateur en cours
protected function charger_fonctions () {
	global $bdd;

	$this->fonctions = array();
	$query = "SELECT id_fonction
						FROM annu_collab_fonctions
						WHERE ref_contact = '".$this->ref_contact."' ";
	$resultat = $bdd->query ($query);
	while ($tmp = $resultat->fetchObject()) { $this->fonctions[] = $tmp->id_fonction; }

	$this->fonctions_loaded = true;

	return true;
}


// Ajout du collaborateur a une fonction
public function add_fonction ($id_fonction) {
	global $bdd;

	$query = "REPLACE INTO annu_collab_fonctions (id_fonction, ref_contact)
						VALUES ('".$id_fonction."', '".$this->ref_contact."') ";
	$bdd->exec ($query);

	return true;
}


// Syuppression du collaborateur a une fonction
public function del_fonction ($id_fonction) {
	global $bdd;

	$query = "DELETE FROM annu_collab_fonctions 
						WHERE ref_contact = '".$this->ref_contact."' && id_fonction = '".$id_fonction."' ";
	$bdd->exec ($query);

	return true;
}



// *************************************************************************************************************
// FONCTIONS DE LECTURE DES DONNEES 
// *************************************************************************************************************
function getNumero_secu () {
	return $this->numero_secu;
}

function getDate_naissance () {
	return $this->date_naissance;
}

function getLieu_naissance () {
	return $this->lieu_naissance;
}

function getId_pays_nationalite () {
	return $this->id_pays_nationalite;
}

function getNationalite () {
	return $this->nationalite;
}

function getSituation_famille () {
	return $this->situation_famille;
}

function getNbre_enfants () {
	return $this->nbre_enfants;
}

function getCollab_fonctions () {
	if (!$this->fonctions_loaded) { $this->charger_fonctions(); }
	return $this->fonctions;
}



}
?>