
<?php

// *************************************************************************************************************
// MODIFICATION DE L'ADRESSE D'UN CONTACT
// *************************************************************************************************************

// Variables n�cessaires � l'affichage
$page_variables = array ("_ALERTES");
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************




// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<p>&nbsp;</p>
<p>adresse: modification dans un contact existant </p>
<p>&nbsp; </p>
<?php 
foreach ($_ALERTES as $alerte => $value) {
	echo $alerte." => ".$value."<br>";
}
if (count($_ALERTES)>0) {
echo "erreur";
}
?>
<script type="text/javascript">
var email=false;
var erreur=false;
<?php 
foreach ($_ALERTES as $alerte => $value) {
	if ($alerte=="email_used") {
	echo "email=true;";
	echo "erreur=true;\n";
	}
	
}

?>
if (erreur) {
}
else
{
window.parent.refreshtagmobil('adresslist2','li','adressecontent', 'annuaire_edition_valid_view_adresse_nouvelle', '<?php echo $ref_adresse?>', '<?php echo $_REQUEST['ref_idform']?>');
}
</script>