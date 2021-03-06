<?php
// *************************************************************************************************************
// CLASSE REGISSANT LES INFORMATIONS SUR UN TAX DE TVA 
// *************************************************************************************************************


final class tva {
	private $id_tva;

	private $tva;
	private $id_pays;


function __construct($id_tva = 0) {
	global $bdd;

	// Controle si l'Id_tva est pr?cis?
	if (!$id_tva) { return false; }

	// S?lection des informations g?n?rales
	$query = "SELECT id_tva, tva, id_pays
						FROM tvas
						WHERE id_tva = '".$id_tva."' ";
	$resultat = $bdd->query ($query);

	// Controle si l'Id_tva est trouv?
	if (!$tva = $resultat->fetchObject()) { return false; }

	// Attribution des informations ? l'objet
	$this->id_tva 	= $id_tva;
	$this->tva			= $tva->tva;
	$this->id_pays	= $tva->id_pays;

	return true;
}



// *************************************************************************************************************
// FONCTIONS LIEES A LA CREATION D'UNE TVA
// *************************************************************************************************************
// Cr?? un Taux de TVA. Utile uniquement pour les d?veloppeur
final public function create ($tva, $id_pays) {
	global $bdd;

	// *************************************************
	// Controle des donn?es transmises
	$this->tva 	= $tva;
	$this->id_pays 	= $id_pays;
	
	// *************************************************
	// Si les valeurs re?ues sont incorrectes
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	// *************************************************
	// Insertion dans la base
	$query = "INSERT INTO tvas (tva, id_pays)
						VALUES ('".addslashes($this->tva)."', ".num_or_null($this->id_pays).")";
	$bdd->exec($query);
	
	// *************************************************
	// R?sultat positif de la cr?ation
	return true;
}


// Import d'un taux de TVA depuis la liste principale que nous tenons a jour.
final public function import ($id_tva, $tva, $id_pays) {
	global $bdd;

	// *************************************************
	// Controle des donn?es transmises
	$this->id_tva 	= $id_tva;
	$this->tva 			= $tva;
	$this->id_pays 	= $id_pays;
	
	// *************************************************
	// Si les valeurs re?ues sont incorrectes
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	// *************************************************
	// Insertion dans la base
	$query = "INSERT INTO tvas (id_tva, tva, id_pays)
						VALUES ('".num_or_null($this->id_tva)."', '".addslashes($this->tva)."', ".num_or_null($this->id_pays).")";
	$bdd->exec($query);
	
	// *************************************************
	// R?sultat positif de la cr?ation
	return true;
}



// *************************************************************************************************************
// FONCTIONS LIEES A LA MODIFICATION D'UN TAUX DE TA
// *************************************************************************************************************

final public function modification ($tva, $id_pays) {
	global $bdd;
	
	// *************************************************
	// Controle des donn?es transmises
	$this->tva 			= $tva;
	$this->id_pays 	= $id_pays;
	if (!is_numeric($this->id_pays)) {
		$GLOBALS['_ALERTES']['bad_taux_tva'] = 1;
	}
	
	// *************************************************
	// Si les valeurs re?ues sont incorrectes
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}

	// *************************************************
	// Mise ? jour de la base
	$query = "UPDATE tvas 
						SET tva = '".addslashes($this->tva)."', id_pays = '".$this->id_pays."'
						WHERE id_tva = '".$this->id_tva."' ";
	$bdd->exec ($query);

	// *************************************************
	// R?sultat positif de la modification
	return true;
}


final public function suppression () {
	global $bdd;

	// *************************************************
	// Controle ? effectuer le cas ?ch?ant

	// *************************************************
	// Suppression de la tva
	$query = "DELETE FROM tvas 
						WHERE id_tva = '".$this->id_tva."' ";
	$bdd->exec ($query);

	unset ($this);
}



// *************************************************************************************************************
// FONCTIONS DE LECTURE DES DONNEES 
// *************************************************************************************************************
function getId_tva () {
	return $this->id_tva;
}

function getTva () {
	return $this->tva;
}

function getId_pays () {
	return $this->id_pays;
}



}

?>