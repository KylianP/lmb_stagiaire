<?php
// *************************************************************************************************************
// MAJ LINE_INVISIBLE D'UNE LIGNE D'UN DOCUMENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


if (isset($_REQUEST['ref_doc'])) {

// ouverture des infos du document et mise � jour
	$document = open_doc ($_REQUEST['ref_doc']);
	$document-> set_line_invisible ($_REQUEST['ref_doc_line']);
}


?>k