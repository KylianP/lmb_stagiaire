<?php
// *************************************************************************************************************
// AJOUT D'UN CATALOGUE CLIENT DIR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");


$catalogues_clients = new catalogue_client($_REQUEST["id_catalogue_client"]);
$catalogues_clients->add_catalogue_client_dir ($_REQUEST["ref_art_categ"], $_REQUEST["ref_art_categ_parent"]);


?>k