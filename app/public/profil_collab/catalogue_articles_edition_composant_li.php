<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//cr?ation de l'indentation des sous composant de l'article ajout?
$composants_article = composant_order_by_lot ($composants_article, get_article_composants ($_REQUEST['ref_article']), "ref_article_lot", "lot", "ref_article_composant");
	
	
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_articles_edition_composant_li.inc.php");

?>