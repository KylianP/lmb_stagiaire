<?php
// *************************************************************************************************************
// IMPORT FICHIER ANNUAIRE CSV ETAPE 3 (apr?s correspondance des colonnes et des valeurs du fichier)
// *************************************************************************************************************

require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


$import_annuaire = new import_annuaire_csv(); 
$import_annuaire->maj_etape(3);
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************
include ($DIR."profil_".$_SESSION['profils'][$ID_PROFIL]->getCode_profil()."/modules/".$import_annuaire_csv['folder_name']."themes/".$_SESSION['theme']->getCode_theme()."/page_import_annuaire_csv_step3.inc.php");

?>