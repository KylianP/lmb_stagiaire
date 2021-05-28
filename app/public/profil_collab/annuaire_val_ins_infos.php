<?php
// *************************************************************************************************************
// 
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

//$docs_types = docs_infos_by_groupe(1);

/*if (isset($_REQUEST['ref_doc'])) {
  $ref_doc = $_REQUEST['ref_doc'];
  $docs_types = docs_infos_by_groupe(searchIdTypeGroup($ref_doc));
}*/
if (isset($_REQUEST['id_contact_tmp']) && isset($_REQUEST['id_interface'])) {
  $ins = loadValidInProgress(1, $_REQUEST['id_contact_tmp']);
  $listelibprofils = getAllLibProfils();
  $listelibannucat = getAllLibAnnuCategs();
}
// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_val_ins_infos.inc.php");

?>