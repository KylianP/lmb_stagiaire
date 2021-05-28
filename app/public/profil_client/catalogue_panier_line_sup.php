<?php
// *************************************************************************************************************
// DELETE_LINE D'UNE LIGNE D'UN PANIER
// *************************************************************************************************************

$_PAGE['MUST_BE_LOGIN'] = 1;
require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

if (isset($_REQUEST['ref_article'])) {
	interface_del_line_panier ($_REQUEST['ref_article']);
}


?>k