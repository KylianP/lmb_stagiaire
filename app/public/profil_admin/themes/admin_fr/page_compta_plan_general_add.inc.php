<?php

// *************************************************************************************************************
// CONTROLE DU THEME
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
<p>compte plan g�n�ral (ajouter) </p>
<p>&nbsp; </p>
<?php 
foreach ($_ALERTES as $alerte => $value) {
	echo $alerte." => ".$value."<br>";
}
?>
<script type="text/javascript">
var erreur=false;
var exist_numero_compte = false;
var numero_compte_vide = false;
var texte_erreur = "";

<?php 
if (count($_ALERTES)>0) {
}
foreach ($_ALERTES as $alerte => $value) {
	if ($alerte=="exist_numero_compte") {
		echo "exist_numero_compte=true;";
		echo "erreur=true;\n";
	}
	if ($alerte=="numero_compte_vide") {
		echo "numero_compte_vide=true;";
		echo "erreur=true;\n";
	}
	
}

?>
if (erreur) {
	
	if (exist_numero_compte) {
		window.parent.document.getElementById("numero_compte").className="alerteform_xsize";
		texte_erreur += "Ce num�ro de compte existe d�j�.<br/>";
	} else {
		window.parent.document.getElementById("numero_compte").className="classinput_xsize";
	}

	if (numero_compte_vide) {
		window.parent.document.getElementById("numero_compte").className="alerteform_xsize";
		texte_erreur += "Indiquez un num�ro de compte.<br/>";
	} else {
		window.parent.document.getElementById("numero_compte").className="classinput_xsize";
	}
	window.parent.alerte.alerte_erreur ('Erreur de saisie', texte_erreur,'<input type="submit" id="bouton0" name="bouton0" value="Ok" />');


}
else
{

window.parent.changed = false;

window.parent.page.traitecontent('compta_plan_general','compta_plan_general.php','true','sub_content');

}
</script>