<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


//**************************************
// Controle

if (!isset($_REQUEST['ref_article'])) {
	echo "La r�f�rence de l'article n'est pas pr�cis�e";
	exit;
}

$article = new article ($_REQUEST['ref_article']);
if (!$article->getRef_article()) {
	echo "La r�f�rence de l'article est inconnue";		exit;

}

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_articles_view_description_email.inc.php");

?>