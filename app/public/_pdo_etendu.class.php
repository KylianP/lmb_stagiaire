<?php
// *************************************************************************************************************
// CLASSE UTILISEE A LA PLACE DE PDO POUR GERER LA BASE DE DONNEE 
// *************************************************************************************************************
// Certaines fonctions sont red?finies afin de permettre le comptage des requetes.

class PDO_etendu extends PDO {
	private $transac_encours = 0;
	private $nb_requetes 	= 0;
	private $requetes 		= array();

	private $debug				= 0;


function __construct($dsn, $username = "", $password = "", $driver_options = NULL) {
	global $_SERVER;

	parent::__construct($dsn, $username, $password, $driver_options);

	return true;
}


// Paire de fonction afin d'?viter les chevauchements de transaction
function beginTransaction () {
	if ($this->transac_encours) { return false; }
	
	$this->transac_encours = 1;
	return parent::beginTransaction();
}
function commit () {
	if (!$this->transac_encours) { return false; }

	$this->transac_encours = 0;
	return parent::commit();
}


function exec ($query) {
	global $ETAT_APPLICATION;

	if ($ETAT_APPLICATION == "DEV") {
		$this->log_query($query);
	}

	return parent::exec($query);
}


function query ($query) {
	global $ETAT_APPLICATION;

	if ($ETAT_APPLICATION == "DEV") {
		$this->log_query($query);
	}

	return parent::query($query);
}


// Enregistre la requete en cours pour statistique
function log_query ($query) {
	$this->nb_requetes++;
	$this->requetes[] = $query;

	if ($this->debug) {
		echo nl2br($query)."<br><hr>";
	}
}


// Affiche les statistiques sur les requetes ex?cut?es sur cette page
function affiche_stats () {
	echo "Nombre de requetes : <b>".$this->nb_requetes."</b><br>";

	foreach ($this->requetes as $index => $requete) {
		echo "#".$index." ".$requete."<br>";
	}
}


// Passe en mode de debugage
function setDebug () {
	$this->debug = 1;
}
// Termine le mode de debugage
function unsetDebug () {
	$this->debug = 0;
}

}


// INFO: Fonction pour r?cup?rer le dernier ID ins?r?: lastInsertId()

// *************************************************************************************************************
// FONCTION UTILISEE POUR TRAITER LES DONNES AVANT INSERTION DANS LA BASE DE DONNEE 
// *************************************************************************************************************
// Variable de type num?rique
function num_or_null ($var) {
	if (!is_numeric($var)) {
		return "NULL";
	}
	return "'".$var."'";
}
// Variable de type REF
function ref_or_null ($var, $prefixe = 0) {
	$retour = "";

	if (!($var) || $var == 'NULL') {
		if ($prefixe) { $retour .= " IS "; }
		$retour .= "NULL";
	} else if (!preg_match ("#([a-z\.]{1,3})-([0-9a-z]{4,6})-([0-9a-z]{5})#i", $var, $regs)) {
		$retour .= "NULL";
	} else {
		if ($prefixe) { $retour .= " = "; }
		$retour .= "'".$var."'";
	}
	return $retour;
}
// Variable de type REF
function text_or_null ($var) {
	if (!($var) || $var == 'NULL') {
		return "NULL";
	}
	return "'".addslashes($var)."'";
}


