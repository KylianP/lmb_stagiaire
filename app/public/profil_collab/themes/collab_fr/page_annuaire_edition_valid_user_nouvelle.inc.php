
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
<p>utilisateur: ajout d'un nouveau dans un contact existant </p>
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
var Erreur_code=false;
var erreur=false;
var no_ref_coord_user = false;
var used_ref_coord_user = false;
var no_pseudo = false;
var used_pseudo = false;
var texte_erreur = "";
<?php 
foreach ($_ALERTES as $alerte => $value) {
	if ($alerte=="Erreur_code") {
		echo "Erreur_code=true;";
		echo "erreur=true;\n";
	}
	if ($alerte=="no_ref_coord_user") {
		echo "no_ref_coord_user=true;";
		echo "erreur=true;\n";
	}
	if ($alerte=="used_ref_coord_user") {
		echo "used_ref_coord_user=true;";
		echo "erreur=true;\n";
	}
	if ($alerte=="no_pseudo") {
		echo "no_pseudo=true;";
		echo "erreur=true;\n";
	}
	if ($alerte=="used_pseudo") {
		echo "used_pseudo=true;";
		echo "erreur=true;\n";
	}
	
}


?>
if (erreur) {
	if (Erreur_code) {
		window.parent.document.getElementById("user_code<?php echo $_REQUEST['ref_idform']?>").className="alerteform_xsize";
		window.parent.document.getElementById("user_2code<?php echo $_REQUEST['ref_idform']?>").className="alerteform_xsize";
		window.parent.document.getElementById("user_code<?php echo $_REQUEST['ref_idform']?>").focus();
		texte_erreur += "Les mots de passe ne sont pas identiques.<br/>";
	} else {
		window.parent.document.getElementById("user_code<?php echo $_REQUEST['ref_idform']?>").className="classinput_xsize";
		window.parent.document.getElementById("user_2code<?php echo $_REQUEST['ref_idform']?>").className="classinput_xsize";
	}
	
	if (no_ref_coord_user) {
		window.parent.document.getElementById("coordonnee_choisie<?php echo $_REQUEST['ref_idform']?>").className="simule_champs_alerte";
		texte_erreur += "Aucune coordonn?es choisie.<br/>";
	} else {
		window.parent.document.getElementById("coordonnee_choisie<?php echo $_REQUEST['ref_idform']?>").className="simule_champs";
	}
	if (used_ref_coord_user) {
		window.parent.document.getElementById("coordonnee_choisie<?php echo $_REQUEST['ref_idform']?>").className="simule_champs_alerte";
		texte_erreur += "Coordonn?es d?j? utilis?e par un autre utilisateur.<br/>";
	} else {
		window.parent.document.getElementById("coordonnee_choisie<?php echo $_REQUEST['ref_idform']?>").className="simule_champs";
	}
	
	if (no_pseudo) {
		window.parent.document.getElementById("user_pseudo<?php echo $_REQUEST['ref_idform']?>").className="alerteform_xsize";
		texte_erreur += "Veuillez indiquer un pseudo.<br/>";
	} else {
		window.parent.document.getElementById("user_pseudo<?php echo $_REQUEST['ref_idform']?>").className="classinput_xsize";
	}
	
	if (used_pseudo) {
		window.parent.document.getElementById("user_pseudo<?php echo $_REQUEST['ref_idform']?>").className="alerteform_xsize";
		window.parent.document.getElementById("user_pseudo<?php echo $_REQUEST['ref_idform']?>").focus();
	texte_erreur += "?Le pseudo <?php echo $pseudo;?> est d?j? utilis? pour l\'utilisateur attach? ? <br/> <a href=\"index.php#annuaire_view_fiche.php?ref_contact=<?php if (isset( $_ALERTES["used_pseudo"])) { echo $_ALERTES["used_pseudo"][0];}?>\" target=\"_blank\"><?php if (isset( $_ALERTES["used_pseudo"])) {  echo $_ALERTES["used_pseudo"][1];}?></a>";
	} else {
		window.parent.document.getElementById("user_pseudo<?php echo $_REQUEST['ref_idform']?>").className="classinput_xsize";
	}


	window.parent.alerte.alerte_erreur ('Erreur de saisie', texte_erreur,'<input type="submit" id="bouton0" name="bouton0" value="Ok" />');


}
else
{
window.parent.changed = false;
window.parent.remove_tag ('usercontent_li_<?php echo $_REQUEST['ref_idform']?>');

window.parent.document.getElementById("block_suspendre_user").style.display = "block";
<?php
if (isset($ref_user_previous)) {
	?>
		window.parent.refreshtagmobil('userlist2','li','usercontent', 'annuaire_edition_valid_view_user_nouvelle', '<?php echo $ref_user_previous?>', '');	
	<?php
}


if (isset($_INFOS['Cr?ation_utilisateur'])) {
	?>
	window.parent.switchtagmobil('userlist2','li','usercontent', 'annuaire_edition_valid_view_user_nouvelle', '<?php echo $_INFOS['Cr?ation_utilisateur']?>');
	<?php
}
?>
}
</script>