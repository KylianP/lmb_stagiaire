
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
<p>&nbsp;</p>
<p>comptes bancaire (Modifier) </p>
<p>&nbsp; </p>
<?php 
foreach ($_ALERTES as $alerte => $value) {
	echo $alerte." => ".$value."<br>";
}
?>
<script type="text/javascript">
var erreur=false;
var bad_ref_banque = false;
var texte_erreur = "";
<?php 
if (count($_ALERTES)>0) {
}
foreach ($_ALERTES as $alerte => $value) {
	if ($alerte=="bad_ref_banque") {
		echo "bad_ref_banque=true;";
		echo "erreur=true;\n";
	}
	
}

?>
if (erreur) {
	
	if (bad_ref_banque) {
		window.parent.document.getElementById("nom_banque_<?php echo $_REQUEST["id_compte_bancaire"]?>").className="alerteform_xsize";
		texte_erreur += "Vous devez s?lectionner une banque.<br/>";
	} else {
		window.parent.document.getElementById("nom_banque_<?php echo $_REQUEST["id_compte_bancaire"]?>").className="classinput_xsize";
	}

	window.parent.alerte.alerte_erreur ('Erreur de saisie', texte_erreur,'<input type="submit" id="bouton0" name="bouton0" value="Ok" />');


}
else
{

window.parent.changed = false;

window.parent.page.traitecontent('compta_compte_bancaire_gestion','compta_compte_bancaire_gestion.php?','true','sub_content');

}
</script>