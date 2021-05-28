<?php

// *************************************************************************************************************
// CONTROLE DU THEME
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
tableau_smenu[0] = Array("smenu_comptabilite", "smenu_comptabilite.php" ,"true" ,"sub_content", "Comptabilité");
tableau_smenu[1] = Array('annuaire_gestion_factures','annuaire_gestion_factures.php','true','sub_content', "Règles de relance des factures");
update_menu_arbo();
</script>
<div class="emarge">

<p class="titre">Règles de relance des factures</p>
<div style="height:50px">
<table class="minimizetable">
<tr>
<td class="contactview_corps">
<div id="cat_client" style="padding-left:10px; padding-right:10px">
<?php 
if ($liste_categories) {
	?>
	<p>Choix de la  cat&eacute;gorie client </p>

	<select id="choix_categ_client" name="choix_categ_client" >
	<option value=""></option>
	<?php 
	foreach ($liste_categories as $liste_categorie) {
		?>
		<option value="<?php echo $liste_categorie->id_client_categ; ?>" <?php if ($liste_categorie->id_client_categ == $id_client_categ) {echo 'selected="selected"'; $choix_select = true; }?>><?php echo htmlentities($liste_categorie->lib_client_categ); ?></option>
		<?php 
	}
	?>
	</select>
	<br />
	<br />
	<?php 
	if (isset($id_client_categ)) {
		?>
		<p>Ajouter un niveau de relance </p>
		
			<table>
			<tr>
				<td style="width:95%">
						<table>
						<tr class="smallheight">
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
						</tr>	
						<tr>
							<td ><span class="labelled">Libell&eacute;:</span>
							</td>
							<td ><span class="labelled">D&eacute;lai:</span>
							</td>
							<td ><span class="labelled">Mode d'&eacute;dition:</span>						</td>
							<td ><div class="labelled" style="text-align:center">Imprimer&nbsp;sur&nbsp;la&nbsp;facture</div>
							</td>
							<td>&nbsp;
							</td>
	
						</tr>
					</table>
					</td>
					<td>
					</td>
				</tr>
			</table>
			<div class="caract_table">
	
			<table>
			<tr>
				<td style="width:95%">
					<form action="annuaire_gestion_factures_n_relances_add.php" method="post" id="annuaire_gestion_factures_n_relances_add" name="annuaire_gestion_factures_n_relances_add" target="formFrame" >
					<table>
						<tr class="smallheight">
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
						</tr>	
						<tr>
							<td>
							<input name="id_client_categ" id="id_client_categ" type="hidden" value="<?php echo $id_client_categ;?>"  class="classinput_nsize"/>
							<input name="lib_niveau_relance" id="lib_niveau_relance" type="text" value=""  class="classinput_lsize" />
							</td>
							<td>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td style="width:70px">
							<input name="delai_before_next" id="delai_before_next" type="text" value=""  class="classinput_nsize" size="5" />
									</td>
									<td> jour(s)
									</td>
								</tr>
							</table>
							</td>
							<td>
								<select id="id_edition_mode" name="id_edition_mode" class="classinput_lsize">
								<?php 
								 foreach ($editions_modes as $edition_mode) {
									?>
									<option value="<?php echo $edition_mode->id_edition_mode;?>"><?php echo  htmlentities($edition_mode->lib_edition_mode);?></option>
									<?php
									}
								?>
								</select>
							</td>
							<td style="text-align:center">
								<input name="impression" id="impression" type="checkbox" value="1"/>
								<input name="id_courrier_joint" id="id_courrier_joint" type="hidden" value="0"  class="classinput_nsize"/>
							</td>
							<td>
								<p style="text-align:center">
								<input name="ajouter" id="ajouter" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-ajouter.gif" />
								</p>
							</td>
						</tr>
					</table>
					</form>
				</td>
				<td>
				</td>
			</tr>
		</table>
		</div>
		<?php 
		if ($niveaux_relances) {
			?>
			<p>Niveaux de relance </p>
				<table>
				<tr>
					<td style="width:95%">
							<table>
							<tr class="smallheight">
								<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
								<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
								<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
								<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
								<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
							</tr>	
							<tr>
								<td ><span class="labelled">Libell&eacute;:</span>
								</td>
								<td ><span class="labelled">D&eacute;lai:</span>
								</td>
								<td ><span class="labelled">Mode d'&eacute;dition:</span>						</td>
								<td ><div class="labelled" style="text-align:center">Imprimer&nbsp;sur&nbsp;la&nbsp;facture</div>
								</td>
								<td>&nbsp;
								</td>
		
							</tr>
						</table>
						</td>
						<td>
						</td>
					</tr>
				</table>
				<?php
				
				$fleches_ascenseur=0;
				$first_niveau_relance = false;
				foreach ($niveaux_relances as $niveau_relance) {
				//premier niveau de relance partiellement editable
					if ($niveau_relance->id_client_categ == NULL ) {
					
					if ($niveau_relance->niveau_relance == 10 || $niveau_relance->niveau_relance == 11 ) {continue;}
					?>
							
			
					<div class="caract_table">
				
						<table>
						<tr>
							<td style="width:95%">
								<form action="annuaire_gestion_factures_n_relances_mod.php" method="post" id="annuaire_gestion_factures_n_relances_mod_<?php echo $niveau_relance->id_niveau_relance;?>" name="annuaire_gestion_factures_n_relances_mod_<?php echo $niveau_relance->id_niveau_relance;?>" target="formFrame" >
								<table>
									<tr class="smallheight">
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
									</tr>	
									<tr>
										<td>
										<input name="id_niveau_relance" id="id_niveau_relance" type="hidden" value="<?php echo $niveau_relance->id_niveau_relance;?>"/>
										<input name="id_client_categ_<?php echo $niveau_relance->id_niveau_relance;?>" id="id_client_categ_<?php echo $niveau_relance->id_niveau_relance;?>" type="hidden" value="<?php echo $id_client_categ ;?>" />
										<input name="lib_niveau_relance_<?php echo $niveau_relance->id_niveau_relance;?>" id="lib_niveau_relance_<?php echo $niveau_relance->id_niveau_relance;?>" type="text" value="<?php echo htmlentities($niveau_relance->lib_niveau_relance);?>"  class="classinput_lsize" readonly="readonly" style="background-color: #EEEEEE" />
										</td>
										<td>
										<table cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td style="width:70px">
												<input name="delai_before_next_<?php echo $niveau_relance->id_niveau_relance;?>" id="delai_before_next_<?php echo $niveau_relance->id_niveau_relance;?>" type="text" value="<?php echo htmlentities($niveau_relance->delai_before_next);?>"  class="classinput_nsize" size="5" />
												</td>
												<td> jour(s)
												</td>
											</tr>
										</table>
										</td>
										<td>
											<select id="id_edition_mode_<?php echo $niveau_relance->id_niveau_relance;?>" name="id_edition_mode_<?php echo $niveau_relance->id_niveau_relance;?>" class="classinput_lsize">
											<?php 
											 foreach ($editions_modes as $edition_mode) {
												?>
												<option value="<?php echo $edition_mode->id_edition_mode;?>" <?php if ($edition_mode->id_edition_mode == $niveau_relance->id_edition_mode) {echo 'selected="selected"';}?>><?php echo  htmlentities($edition_mode->lib_edition_mode);?></option>
												<?php
												}
											?>
											</select>
										</td>
										<td style="text-align:center">
								<input name="impression_<?php echo $niveau_relance->id_niveau_relance;?>" id="impression_<?php echo $niveau_relance->id_niveau_relance;?>" type="checkbox" value="1" <?php if ($niveau_relance->impression) {?> checked="checked"<?php } ?>/>
											<input name="id_courrier_joint_<?php echo $niveau_relance->id_niveau_relance;?>" id="id_courrier_joint_<?php echo $niveau_relance->id_niveau_relance;?>" type="hidden" value="0"  class="classinput_nsize"/>
										</td>
										<td>
											<p style="text-align:center">
											<input name="modifier_<?php echo $niveau_relance->id_niveau_relance;?>" id="modifier_<?php echo $niveau_relance->id_niveau_relance;?>" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-modifier.gif" />
											</p>
										</td>
									</tr>
								</table>
								</form>
							</td>
							<td style="width:55px; text-align:center">&nbsp;
							
							</td>
						</tr>
					</table>
					</div>
					<?php
					} else {
					
					if ($niveau_relance->niveau_relance != 10 && $niveau_relance->niveau_relance != 11 ) {
					
					?>
							
			
					<div class="caract_table">
				
						<table>
						<tr>
							<td style="width:95%">
								<form action="annuaire_gestion_factures_n_relances_mod.php" method="post" id="annuaire_gestion_factures_n_relances_mod_<?php echo $niveau_relance->id_niveau_relance;?>" name="annuaire_gestion_factures_n_relances_mod_<?php echo $niveau_relance->id_niveau_relance;?>" target="formFrame" >
								<table>
									<tr class="smallheight">
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
									</tr>	
									<tr>
										<td>
										<input name="id_niveau_relance" id="id_niveau_relance" type="hidden" value="<?php echo $niveau_relance->id_niveau_relance;?>"/>
										<input name="id_client_categ_<?php echo $niveau_relance->id_niveau_relance;?>" id="id_client_categ_<?php echo $niveau_relance->id_niveau_relance;?>" type="hidden" value="<?php echo $id_client_categ ;?>" />
										<input name="lib_niveau_relance_<?php echo $niveau_relance->id_niveau_relance;?>" id="lib_niveau_relance_<?php echo $niveau_relance->id_niveau_relance;?>" type="text" value="<?php echo htmlentities($niveau_relance->lib_niveau_relance);?>"  class="classinput_lsize" />
										</td>
										<td>
										<table cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td style="width:70px">
												<input name="delai_before_next_<?php echo $niveau_relance->id_niveau_relance;?>" id="delai_before_next_<?php echo $niveau_relance->id_niveau_relance;?>" type="text" value="<?php echo htmlentities($niveau_relance->delai_before_next);?>"  class="classinput_nsize" size="5" />
												</td>
												<td> jour(s)
												</td>
											</tr>
										</table>
										</td>
										<td>
											<select id="id_edition_mode_<?php echo $niveau_relance->id_niveau_relance;?>" name="id_edition_mode_<?php echo $niveau_relance->id_niveau_relance;?>" class="classinput_lsize">
											<?php 
											 foreach ($editions_modes as $edition_mode) {
												?>
												<option value="<?php echo $edition_mode->id_edition_mode;?>" <?php if ($edition_mode->id_edition_mode == $niveau_relance->id_edition_mode) {echo 'selected="selected"';}?>><?php echo  htmlentities($edition_mode->lib_edition_mode);?></option>
												<?php
												}
											?>
											</select>
										</td>
										<td style="text-align:center">
								<input name="impression_<?php echo $niveau_relance->id_niveau_relance;?>" id="impression_<?php echo $niveau_relance->id_niveau_relance;?>" type="checkbox" value="1" <?php if ($niveau_relance->impression) {?> checked="checked"<?php } ?>/>
											<input name="id_courrier_joint_<?php echo $niveau_relance->id_niveau_relance;?>" id="id_courrier_joint_<?php echo $niveau_relance->id_niveau_relance;?>" type="hidden" value="0"  class="classinput_nsize"/>
										</td>
										<td>
											<p style="text-align:center">
											<input name="modifier_<?php echo $niveau_relance->id_niveau_relance;?>" id="modifier_<?php echo $niveau_relance->id_niveau_relance;?>" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-modifier.gif" />
											</p>
										</td>
									</tr>
								</table>
								</form>
							</td>
							<td style="width:55px; text-align:center">
							<form method="post" action="annuaire_gestion_factures_n_relances_sup.php" id="annuaire_gestion_factures_n_relances_sup_<?php echo $niveau_relance->id_niveau_relance; ?>" name="annuaire_gestion_factures_n_relances_sup_<?php echo $niveau_relance->id_niveau_relance; ?>" target="formFrame">
								<input name="id_niveau_relance" id="id_niveau_relance" type="hidden" value="<?php echo $niveau_relance->id_niveau_relance; ?>" />
								<input name="id_client_categ_<?php echo $niveau_relance->id_niveau_relance;?>" id="id_client_categ_<?php echo $niveau_relance->id_niveau_relance;?>" type="hidden" value="<?php echo $niveau_relance->id_client_categ ;?>" />
							</form>
							<a href="#" id="link_annuaire_gestion_factures_n_relances_sup_<?php echo $niveau_relance->id_niveau_relance; ?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0"></a>
							<script type="text/javascript">
							Event.observe("link_annuaire_gestion_factures_n_relances_sup_<?php echo $niveau_relance->id_niveau_relance; ?>", "click",  function(evt){Event.stop(evt); alerte.confirm_supprimer('annuaire_gestion_factures_n_relances_sup', 'annuaire_gestion_factures_n_relances_sup_<?php echo $niveau_relance->id_niveau_relance; ?>');}, false);
							</script>
							<table cellspacing="0">
								<tr>
									<td>
										<div id="up_arrow_<?php echo $niveau_relance->id_niveau_relance; ?>">
										<?php
										if ($fleches_ascenseur!=0) {
										?>
										<form action="annuaire_gestion_factures_n_relances_ordre.php" method="post" id="annuaire_gestion_factures_n_relances_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" name="annuaire_gestion_factures_n_relances_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" target="formFrame">
											<input name="new_ordre" id="new_ordre" type="hidden" value="<?php echo ($niveau_relance->niveau_relance)-1?>" />
											<input name="id_niveau_relance" id="id_niveau_relance" type="hidden" value="<?php echo $niveau_relance->id_niveau_relance; ?>" />
											<input name="id_client_categ" id="id_client_categ" type="hidden" value="<?php echo $id_client_categ ;?>" />		
											<input name="modifier_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" id="modifier_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/up.gif">
										</form>
										<?php
										} else {
										?>
										<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="1" height="1"/>
										<?php
										}
										?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
									<div id="down_arrow_<?php echo $niveau_relance->id_niveau_relance; ?>">
										<?php
										if ($fleches_ascenseur!=count($niveaux_relances)-4) {
										?>
									<form action="annuaire_gestion_factures_n_relances_ordre.php" method="post" id="annuaire_gestion_factures_n_relances_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" name="annuaire_gestion_factures_n_relances_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" target="formFrame">
											<input name="new_ordre" id="new_ordre" type="hidden" value="<?php echo ($niveau_relance->niveau_relance)+1?>" />
											<input name="id_niveau_relance" id="id_niveau_relance" type="hidden" value="<?php echo $niveau_relance->id_niveau_relance; ?>" />
											<input name="id_client_categ" id="id_client_categ" type="hidden" value="<?php echo $id_client_categ ;?>" />		
											<input name="modifier_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" id="modifier_ordre_<?php echo $niveau_relance->id_niveau_relance; ?>" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/down.gif">
										</form>
										<?php
										} else {
										?>
										<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="1" height="1"/>							
										<?php
										}
										?>
										</div>
									</td>
								</tr>
							</table>
							</td>
						</tr>
					</table>
					</div>
					<?php 
					$fleches_ascenseur++;
					}
					}
				}
				?>
				<?php
				foreach ($niveaux_relances as $niveau_relance) {
					if ($niveau_relance->niveau_relance == 10 || $niveau_relance->niveau_relance == 11 ) {
					?>
					
					<div class="caract_table">
				
						<table>
						<tr>
							<td style="width:95%">
								<table>
									<tr class="smallheight">
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
										<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
									</tr>	
									<tr>
										<td>
										<input name="lib_niveau_relance_<?php echo $niveau_relance->id_niveau_relance;?>" id="lib_niveau_relance_<?php echo $niveau_relance->id_niveau_relance;?>" type="text" value="<?php echo htmlentities($niveau_relance->lib_niveau_relance);?>"  class="classinput_lsize" readonly="readonly" style="background-color: #EEEEEE" />
										</td>
										<td>
										<table cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td style="width:70px"><!--
												<input  type="text" value="<?php echo htmlentities($niveau_relance->delai_before_next);?>"  class="classinput_nsize" size="5" readonly="readonly" style="background-color: #EEEEEE"  />-->
												</td>
												<td> <!--jour(s)-->
												</td>
											</tr>
										</table>
										</td>
										<td>
											<?php 
											 foreach ($editions_modes as $edition_mode) {
												?>
												<!--<input  type="text" value="<?php
												 if ($edition_mode->id_edition_mode == $niveau_relance->id_edition_mode) {
													 echo  htmlentities($edition_mode->lib_edition_mode);
												 }?>"  class="classinput_xsize" readonly="readonly" style="background-color: #EEEEEE"  />-->
												<?php
												}
											?>
										</td>
										<td>&nbsp;
										</td>
										<td>
											<p style="text-align:center">&nbsp;
											</p>
										</td>
									</tr>
								</table>
							</td>
							<td style="width:55px; text-align:center">&nbsp;
							
							</td>
						</tr>
					</table>
					</div>
					<?php 
					}
				}
				?>
			<?php 
			}
		?>
		<?php 
		}
	?>
	<?php
}
?>
</div>
</td>
</tr>
</table>

<SCRIPT type="text/javascript">
Event.observe("choix_categ_client", "change", function(evt){ if ($("choix_categ_client").value != "") { page.traitecontent('annuaire_gestion_factures','annuaire_gestion_factures.php?id_client_categ='+$("choix_categ_client").value,'true','sub_content');} }, false);	

<?php 
if (isset($id_client_categ)) {
	?>
Event.observe("delai_before_next", "blur", function(evt){ nummask(evt, "0", "X");}, false);	
new Form.EventObserver('annuaire_gestion_factures_n_relances_add', function(){formChanged();});
	<?php
	foreach ($niveaux_relances as $niveau_relance) {
		if ($niveau_relance->niveau_relance != 10 && $niveau_relance->niveau_relance != 11 ) {
		?>
		new Form.EventObserver('annuaire_gestion_factures_n_relances_mod_<?php echo $niveau_relance->id_niveau_relance;?>', function(){formChanged();});
		Event.observe("delai_before_next_<?php echo $niveau_relance->id_niveau_relance;?>", "blur", function(evt){ nummask(evt, "0", "X");}, false);	
		<?php 
		}
	}
	?>
	<?php
} 
?>
//on masque le chargement
H_loading();
</SCRIPT>
</div>
</div>