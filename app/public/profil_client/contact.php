<?php
// *************************************************************************************************************
// PAGE CONTACT
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ("_interface.config.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");

// Chargement des caractéristiques de l'entreprise
	$contact_entreprise = new contact($REF_CONTACT_ENTREPRISE);
	$nom_entreprise = str_replace (CHR(13), " " ,str_replace (CHR(10), " " , $contact_entreprise->getNom()));
	$adresse_entreprise = $contact_entreprise->getAdresses();
	$coordonnees_entreprise = $contact_entreprise->getCoordonnees();

gestion_panier();
$liste_contenu = $_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]["contenu"];
	
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_contact.inc.php");

?>