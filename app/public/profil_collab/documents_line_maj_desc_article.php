<?php
// *************************************************************************************************************
// MAJ LINE_DESC_ARTICLE D'UNE LIGNE D'UN DOCUMENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


if (isset($_REQUEST['ref_doc'])) {

// ouverture des infos du document et mise � jour
	$document = open_doc ($_REQUEST['ref_doc']);
	$document-> maj_line_desc_article ($_REQUEST['ref_doc_line'], str_replace("%u20AC", "�", urldecode($_REQUEST['desc_article'])));
}

?>