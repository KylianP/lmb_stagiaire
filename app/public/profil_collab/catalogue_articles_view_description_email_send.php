<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

if (!isset($_REQUEST['ref_article'])) {
	echo "La r?f?rence de l'article n'est pas pr?cis?e";
	exit;
}

$article = new article ($_REQUEST['ref_article']);
if (!$article->getRef_article()) {
	echo "La r?f?rence de l'article est inconnue";		exit;

}

$erreur_email = false;
$liste_destinataires = explode(";", $_REQUEST["destinataires"]);
foreach($liste_destinataires as $destinataire){
	if (!preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i", $destinataire)) {
		$erreur_email = true;
		$msg = "Un email de destination n'est pas valide.";
	}
	
}
if (!$erreur_email) {

	if (!$retour = $article->mail_article ($_REQUEST["destinataires"] , $_REQUEST["titre"] , $_REQUEST["message"], $_REQUEST["fiche"])) {
		$erreur_email = true;
		$msg = "Une erreur est survenue lors de l'envoi de l'email.";
	}
	
}


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

if ($erreur_email) {
include ($DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_articles_view_description_email.inc.php");
} else {
include ($DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_articles_view_description_email_send.inc.php");
}

?>