<?php
// *************************************************************************************************************
// Liste des inscriptions en attente
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


// Préparations des variables d'affichage
$ANNUAIRE_CATEGORIES	=	get_categories();

$civilites = get_civilites ($ANNUAIRE_CATEGORIES[0]->id_categorie);


//liste des pays pour affichage dans select
$listepays = getPays_select_list ();

//liste des langages
$langages = getLangues ();


list($listeinscriptions, $listemodifications) = loadValidInProgress((!isset($_REQUEST['val_mail'])) ? 1 : $_REQUEST['val_mail']);
//$listemodifications = 
$listelibprofils = getAllLibProfils();
$listelibannucat = getAllLibAnnuCategs();

if (isset($_REQUEST['modifs'])) $modifs = true; else unset($modifs);

// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_valider_inscriptions.inc.php");
?>