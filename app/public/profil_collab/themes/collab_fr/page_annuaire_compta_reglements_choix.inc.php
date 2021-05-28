<?php

// *************************************************************************************************************
// CHOIX DU MODE DE REGLEMENT
// *************************************************************************************************************

// Variables n�cessaires � l'affichage
$page_variables = array ();
check_page_variables ($page_variables);

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="text-align:center; width:50%" colspan="2">
		<?php 
		foreach ($reglements_modes as $reglement_mode) {
			?>
			<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_mod_paiement_<?php echo htmlentities($reglement_mode->id_reglement_mode); ?>.gif" id="bt_mod_paiement_<?php echo htmlentities($reglement_mode->id_reglement_mode); ?>" style="cursor:pointer; padding:5px;"/>
			<?php
		}
		?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="width:40%">
				</td>
				<td style="text-align:right; width:450px">
				<div style="text-align:right; width:450px" id="reglement_add_block"></div>
				</td>
				<td style="width:40%">
				</td>
			</tr>
		</table>
				
		</td>
	</tr>
</table>
					

<script type="text/javascript">
<?php 
foreach ($reglements_modes as $reglement_mode) {
	?>
	Event.observe("bt_mod_paiement_<?php echo htmlentities($reglement_mode->id_reglement_mode); ?>", "click", function(evt){
		page.verify("contact_addform_reglement_mode","annuaire_compta_reglements_addform.php?ref_contact=<?php echo $ref_contact;?>&id_reglement_mode=<?php echo htmlentities($reglement_mode->id_reglement_mode); ?>", "true", "reglement_add_block");
		}, false);		
	<?php
}
?>


//on masque le chargement
H_loading();

</script>