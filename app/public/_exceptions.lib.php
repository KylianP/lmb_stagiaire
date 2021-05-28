<?php
// *************************************************************************************************************
// CLASSES ET FONCTIONS DE GESTION DES EXCEPTIONS
// *************************************************************************************************************



// *************************************************************************************************************
// RECUPERATION DES EXCEPTIONS NON RECUES
// *************************************************************************************************************


function exception_handler ($exception) { 
	$exceptions = $exception->getTrace();
	
 
	// Exceptions � l'affichage complet du message d'erreur visant a ne pas afficher d'informations techniques sur le serveur.
	// Soyez plus restrictif si vous le souhaitez pour ne rien laisser filtrer en cas de bug
	if (substr($exception->getMessage(), 0, strlen("could not find driver")) == "could not find driver") {
		$erreur = "Driver PDO non install�";
	}
	elseif (substr_count($exception->getMessage(),"SQLSTATE[42000]") || substr_count($exception->getMessage(),"SQLSTATE[HY000]")) {
		$erreur = "Erreur lors de la connexion au serveur MySQL ";
	}
	elseif ($exception->getFile() == "/home/infolys/www/_pdo_etendu.class.php" && 
			$exception->getLine() == 18) {
				$erreur = "Probl�me de connexion � la base de donn�es";
	}
	else {
		$erreur = "<b>EXCEPTION NON RECEPTIONNEE</b>: <br>";
		$erreur .= "Message : ".$exception->getMessage()." [".$exception->getCode()."] <br>
		Localisation : <b>Ligne ".$exception->getLine()."</b> - <b>".$exception->getFile()."</b><br><br><hr>";

		$erreur .= "Retour d'information du script : ";
		foreach ($GLOBALS['_INFOS'] as $info => $un) {
			$erreur .= "<li>".$info;
		}
		$erreur .= "<br><br>Retour d'alerte du script : ";
		foreach ($GLOBALS['_INFOS'] as $alerte => $un) {
			$erreur .= "<li>".$alerte;
		}
		$erreur .= "<br><hr>";
		for ($i=0; $i<count($exceptions); $i++) {
			foreach ($exceptions[$i]['args'] as $index => $trace) {
				$erreur .= "<b>#".$index."</b> ";
				if (is_object($trace)) { $erreur.= "OBJET ".get_class($trace); }
				else { $erreur .= $trace; }
				$erreur .= " <br>";
			}
		}
		$erreur .= "<br>";
	}
	
	// Il s'agit d'une exception non re�ues, donc � traiter comme une erreur
	alerte_dev ($erreur);
}

// D�claration de la fonction de r�cup�ration des exceptions non recues
set_exception_handler('exception_handler');


// *************************************************************************************************************
// GESTION DES EXCEPTIONS: Acc�s restreint
// *************************************************************************************************************
class AccesException extends Exception {
	private $stop;
	
	public function __construct($id_profil) {
		parent::__construct();
	}
	
	public function alerte () {
		global $DIR;
		global $ID_PROFIL;
			// Affichage du message d'erreur
			echo "<b>Erreur : Acc�s � la page ".$_SERVER['PHP_SELF']." restreint.</b><br>
			Vous n'etes pas autoris� � consulter cette page.<br>
			Votre profil : ".$_SESSION['user']->getId_profil()."<br>
			Profil de la page : ".$ID_PROFIL."<br><br>
	
			<a href='".$DIR."'>Retour � l'accueil</a>";
			
			exit();
	}
}



// *************************************************************************************************************
// GESTION DES EXCEPTIONS: Exception g�n�rique
// *************************************************************************************************************
class IyException extends Exception {
	private $stop;
	
	public function __construct($message = NULL, $stop = 1, $code = 0) {
		$this->stop = $stop;
		parent::__construct($message, $code);
	}
	
	public function alerte () {
		// Affichage du message d'erreur
		echo "<b>Erreur : ".$this->message."</b><br>";

		// Choix concernant la suite des �vennements
		switch ($this->stop) {
			case 0:
				// Simple affichage, le script continuera a etre execut�
			break;
			case 1:
				echo "Script arret�";
				exit();
			break;
			case 2: 
				alerte_dev ($this->message);
			break;
		}
	}
}

?>