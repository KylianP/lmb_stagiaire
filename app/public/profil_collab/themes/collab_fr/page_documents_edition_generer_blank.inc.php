
<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables n?cessaires ? l'affichage
$page_variables = array ("_ALERTES");
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************




// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<p>&nbsp; </p>
<?php 
foreach ($_ALERTES as $alerte => $value) {
	echo $alerte." => ".$value."<br>";
}
?>
<script type="text/javascript">
var erreur=false;
var texte_erreur = "";
<?php 
if (count($_ALERTES)>0) {
	
}

?>
if (erreur) {
	


}
else
{
page.verify("document_edition","documents_edition.php?ref_doc=<?php 
if (isset($GLOBALS['_INFOS']['ref_doc_copie'])) {
	echo $GLOBALS['_INFOS']['ref_doc_copie'];
} else {
	echo $_REQUEST['ref_doc'];
}
?>", "true", "sub_content");
}
</script>