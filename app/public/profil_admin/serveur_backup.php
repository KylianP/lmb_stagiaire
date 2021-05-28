<?php
// *************************************************************************************************************
// CREATION OU RESTAURATION DE BACKUP
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

ini_set('memory_limit', '300M');
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '250M');
ini_set('max_input_time', '2000');
ini_set('max_execution_time', '2000');

$liste_backup = array();
if (is_array(glob($DIR."backup/*.tgz"))) {
$liste_backup = array_reverse(glob($DIR."backup/*.tgz"));
}
// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_serveur_backup.inc.php");

?>