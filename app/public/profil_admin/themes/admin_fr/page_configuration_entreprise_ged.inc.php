<?php

// *************************************************************************************************************
// CONFIG DES OPTIONS
// *************************************************************************************************************

// Variables nécessaires à l'affichage
$page_variables = array ();
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<script type="text/javascript">
tableau_smenu[0] = Array("smenu_entreprise", "smenu_entreprise.php" ,"true" ,"sub_content", "Entreprise");
tableau_smenu[1] = Array('configuration_entreprise_ged','configuration_entreprise_ged.php',"true" ,"sub_content", "Gestion des pièces jointes");
update_menu_arbo();
</script>
<div class="emarge">
<p class="titre">Gestion des pi&egrave;ces jointes</p>

<div class="contactview_corps">

<table width="100%">
	<tr class="smallheight">
		<td style="width:35%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		<td style="width:35%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
	</tr>
	<tr>
		<td class="titre_config" colspan="3">Ajouter un type de pi&egrave;ce jointe :</td>
	</tr>
	<tr>
		<td colspan="3"> </td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<form action="configuration_entreprise_ged_add.php" method="post" id="configuration_entreprise_ged_add" name="configuration_entreprise_ged_add" target="formFrame">
			<table>
			<tr>
				<td>
					<span class="labelled">Libell&eacute; :</span>
				</td>
				<td>
					<span class="labelled">Syst&egrave;me (non modifiable) :</span>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
					<input name="lib_type_add" id="lib_type_add" type="text" value=""  class="classinput_lsize"/>
				</td>
				<td>
					<input type="checkbox" name="systeme" id="systeme" value="" />
				</td>
				<td>
					<input name="ajouter" id="ajouter" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-ajouter.gif" />
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			</table>
			</form>
		</td>
	</tr>
	<tr class="smallheight">
		<td style="width:35%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		<td style="width:35%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
	</tr>
	<tr>
		<td class="titre_config" colspan="3">Types de pi&egrave;ce jointe :</td>
	</tr>
	<tr>
		<td colspan="3"> </td>
	</tr>
	<?php
	foreach($types_pj as $type_pj){
		$disable = "";
		if($type_pj->systeme==1){
			$disable = "disabled";
		}?>
		<tr>
			<td colspan="3" align="center">
				<form action="configuration_entreprise_ged_maj.php" enctype="multipart/form-data" method="POST" id="configuration_entreprise_ged_maj_<?php echo $type_pj->id_piece_type; ?>" name="configuration_entreprise_ged_maj_<?php echo $type_pj->id_piece_type; ?>" target="formFrame">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="infos_config" width="220px">
							Intitul&eacute; du type <?php if(!empty($disable)){ echo "(non modifiable)"; } ?>
						</td>
						<td width="220px">
							<input id="lib_type_<?php echo $type_pj->id_piece_type; ?>" name="lib_type_<?php echo $type_pj->id_piece_type; ?>" value="<?php echo $type_pj->lib_piece_type; ?>" type="text" class="classinput_hsize" maxlength="70" <?php echo $disable; ?> />
							<input type="hidden" name="id_type_piece" id="id_type_piece" value="<?php echo $type_pj->id_piece_type; ?>" />
						</td>
						<td width="80px">
							<?php 
							if(empty($disable)){ ?>
								<input name="modifier" id="modifier" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-modifier.gif" />
							<?php
							} ?>
							&nbsp;
						</td>
						<td width="40px" align="right">
							<?php 
							if(empty($disable)){ ?>
								<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" id="supp_img_<?php echo $type_pj->id_piece_type; ?>" style="cursor:pointer"/>
							<?php
							} ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
				<script type="text/javascript">
				Event.observe('supp_img_<?php echo $type_pj->id_piece_type; ?>', "click", function(evt){
					Event.stop(evt);
					$("titre_alert").innerHTML = "Confirmation";
					$("texte_alert").innerHTML = "Confirmer la suppression de ce type";
					$("bouton_alert").innerHTML = '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />';
				
					$("alert_pop_up_tab").style.display = "block";
					$("framealert").style.display = "block";
					$("alert_pop_up").style.display = "block";
					
					$("bouton0").onclick= function () {
					$("framealert").style.display = "none";
					$("alert_pop_up").style.display = "none";
					$("alert_pop_up_tab").style.display = "none";
					}
					$("bouton1").onclick= function () {
					$("framealert").style.display = "none";
					$("alert_pop_up").style.display = "none";
					$("alert_pop_up_tab").style.display = "none";
					page.verify("configuration_entreprise_ged_del","configuration_entreprise_ged_del.php?id_piece_type=<?php echo $type_pj->id_piece_type; ?>", "true", "formFrame");
					}
				});
				</script>
				</form>
			</td>
		</tr>
	<?php
	} ?>
	<tr>
		<td colspan="3"> </td>
	</tr>
</table>

</div>
</div>
<SCRIPT type="text/javascript">
<?php
foreach ($types_pj as $type_pj) {
	?>
	new Form.EventObserver('configuration_entreprise_ged_maj_<?php echo $type_pj->id_piece_type; ?>', function(element, value){formChanged();});
	<?php
}
?>

//on masque le chargement
H_loading();
</SCRIPT>