<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables n?cessaires ? l'affichage
$page_variables = array ();
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************




// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<table width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr class="">
		<td colspan="3">
		<div id="block_entete">
		<div style="width:100%;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr class="">
				<td valign="top" style="width:75%">
				
					<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
						<tr style=" line-height:24px; height:24px;">
							<td style="width:150px; padding-left:3px;">
								<input type="hidden" value="<?php echo $document->getRef_doc();?>" id="ref_doc" name="ref_doc"/>
								<input type="hidden" value="<?php echo $document->getID_TYPE_DOC();?>" id="id_type_doc" name="id_type_doc"/>
								<input type="hidden" value="<?php echo $document->getApp_tarifs();?>" id="app_tarifs" name="app_tarifs"/>			
								Date de cr&eacute;ation:</td>
							<td style="width:250px; font-weight:bolder;">
									<a id="head_date_creation" class="modif_input2"><?php 
									if ($document->getDate_creation ()!= 0000-00-00) {
										echo  ( date_Us_to_Fr ($document->getDate_creation()));
									}
									?>&nbsp;</a>
												<input type="text" value="<?php 
													if ($document->getDate_creation()!=0000-00-00) {
														echo date_Us_to_Fr ($document->getDate_creation ());
													}?>" id="date_creation" name="date_creation" style="display:none" />
												<input type="hidden" value="<?php 
													if ($document->getDate_creation ()!=0000-00-00) {
														echo date_Us_to_Fr ($document->getDate_creation ());
													}?>" id="date_creation_old" name="date_creation_old"/>
								</td>
							<td>
							</td>
						</tr>
						<tr style=" line-height:24px; height:24px;">
							<td style="width:150px; padding-left:3px;">&Eacute;tat:</td>
							<td style="width:250px; font-weight:bolder;">
								<?php echo ($document->getLib_etat_doc());?>
							</td>
							<td></td>
						</tr>
						
						<tr style=" line-height:24px; height:24px;">
							<td style="width:150px; padding-left:3px;">R&eacute;f&eacute;rence externe:</td>
							<td style="width:250px;">
								<a id="head_ref_doc_externe" class="modif_input2"><?php 
										echo ($document->getRef_doc_externe ());
								?>&nbsp;</a>
								<input type="text" value="<?php echo ($document->getRef_doc_externe ());?>" 
									id="ref_doc_externe" name="ref_doc_externe" class="classinput_xsize" style="display:none" />
								<input type="hidden" value="<?php echo ($document->getRef_doc_externe ());?>" id="ref_doc_externe_old" name="ref_doc_externe_old"/>
							</td>
						</tr>
						
						<tr style=" line-height:24px; height:24px;">
							<td style="width:150px; padding-left:3px;">Code affaire:</td>
								<td style="width:250px;">
									<a id="head_code_affaire" class="modif_input2"><?php 
											echo $document->getCode_affaire();
									?>&nbsp;</a>
									<input type="text" value="<?php echo $document->getCode_affaire();?>" 
										id="code_affaire" name="code_affaire" class="classinput_xsize" style="display:none" />
									<input type="hidden" value="<?php echo $document->getCode_affaire();?>" 
										id="code_affaire_old" name="code_affaire_old"/>
								</td>
								<td style="width:20%; text-align:center;">
									<a href="#documents_recherche.php?code_affaire=<?php echo $document->getCode_affaire();?>" target="_blank" 
										id="lien_recherche_avancee_code_affaire"
										<?php if($document->getCode_affaire () == ""){ ?>style="display: none;"<?php } ?>>
										VOIR
									</a>	
								</td>
						</tr>
						
					<?php
					if (count($stocks_liste)>1) {
						?>
						<tr style=" line-height:24px; height:24px;">
							<td style="width:150px; padding-left:3px;">
								Lieu de stockage:					</td>
							<td style="width:250px;">
								<select id="id_stock" name="id_stock" class="classinput_lsize" <?php 
				if ($document->getId_etat_doc () == 15) {
					?> disabled="disabled" <?php }?>>
												<?php 
												foreach ($stocks_liste as $stock_liste) {
													?>
													<option value="<?php echo $stock_liste->getId_stock (); ?>" <?php if ($stock_liste->getId_stock () == $document->getId_Stock ()){echo 'selected="selected"';}?>><?php echo ($stock_liste->getLib_stock()); ?>
													</option>
													<?php 
												}
												?>
												<?php 
												//ajout pour les stocks inactifs qui auraient ?t? utilis?s par le document
												$stocks_supp	= fetch_all_stocks();
												foreach ($stocks_supp as $stock_supp) {
													if (!$stock_supp->actif && $stock_supp->id_stock == $document->getId_stock ()) {
														?>
														<option value="<?php echo $stock_supp->id_stock; ?>" style="color:#FF0000" selected="selected" ><?php echo ($stock_supp->lib_stock); ?>
														</option>
														<?php 
													}
												}
												?>
									</select>					
								</td>
							<td style="width:18px">
							</td>
						</tr>
						<?php
					} else {
						?>
								<select id="id_stock" name="id_stock" style="display:none"<?php 
				if ($document->getId_etat_doc () == 15) {
					?> disabled="disabled" <?php }?>>
												<?php 
												foreach ($stocks_liste as $stock_liste) {
													?>
													<option value="<?php echo $stock_liste->getId_stock (); ?>" <?php if ($stock_liste->getId_stock () == $document->getId_Stock ()){echo 'selected="selected"';}?>><?php echo ($stock_liste->getLib_stock()); ?>
													</option>
													<?php 
												}
												?>
												<?php 
												//ajout pour les stocks inactifs qui auraient ?t? utilis?s par le document
												$stocks_supp	= fetch_all_stocks();
												foreach ($stocks_supp as $stock_supp) {
													if (!$stock_supp->actif && $stock_supp->id_stock == $document->getId_stock ()) {
														?>
														<option value="<?php echo $stock_supp->id_stock; ?>" style="color:#FF0000" selected="selected" ><?php echo ($stock_supp->lib_stock); ?>
														</option>
														<?php 
													}
												}
												?>
									</select>
						<?php
					}
					?>
						<?php
						if (count($_SESSION['magasins'])>1) {
							?>
							<tr style=" line-height:24px; height:24px;">
								<td style="width:150px; padding-left:3px;">
									Magasin:				</td>
								<td style="width:250px;">
									<select id="id_magasin" name="id_magasin" class="classinput_lsize" >
									<?php 
									foreach ($_SESSION['magasins'] as $magasin) {
										?>
										<option value="<?php echo $magasin->getId_magasin (); ?>" <?php if ($magasin->getId_magasin () == $document->getId_magasin ()){echo 'selected="selected"';}?>><?php echo ($magasin->getLib_magasin()); ?>
										</option>
										<?php 
									}
									?>
									<?php 
									//ajout du magasin inactif qui aurait ?t? utilis? par le document
									$magasins_supp	= charger_all_magasins();
									foreach ($magasins_supp as $magasin_supp) {
										if (!$magasin_supp->actif && $magasin_supp->id_magasin == $document->getId_magasin ()) {
											?>
											<option value="<?php echo $magasin_supp->id_magasin; ?>" selected="selected" ><?php echo ($magasin_supp->lib_magasin); ?>
											</option>
											<?php 
										}
									}
									?>
									</select>					
								</td>
								<td style="width:18px"></td>
							</tr>
							<?php 
						} else {
							?>
							<select id="id_magasin" name="id_magasin" style="display:none" >
									<?php 
									foreach ($_SESSION['magasins'] as $magasin) {
										?>
										<option value="<?php echo $magasin->getId_magasin (); ?>" <?php if ($magasin->getId_magasin () == $document->getId_magasin ()){echo 'selected="selected"';}?>><?php echo ($magasin->getLib_magasin()); ?>
										</option>
										<?php 
									}
									?>
									<?php 
									//ajout du magasin inactif qui aurait ?t? utilis? par le document
									$magasins_supp	= charger_all_magasins();
									foreach ($magasins_supp as $magasin_supp) {
										if (!$magasin_supp->actif && $magasin_supp->id_magasin == $document->getId_magasin ()) {
											?>
											<option value="<?php echo $magasin_supp->id_magasin; ?>" selected="selected" ><?php echo ($magasin_supp->lib_magasin); ?>
											</option>
											<?php 
										}
									}
									?>
									</select>					
							<?php
						}
						?>
					</table>
					
				</td>
				<td valign="top">
									
					</td>
					<td valign="top" >
				
					<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
						<tr>
							<td style="width:50%;">
						
							<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
								<tr>
									
									<td>
							
									<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
										
										<tr>
											<td style="text-align:right; padding-right:3px">
											<div style="height:5px;line-height:5px;" ></div>
											<?php 
											if ($document->getId_etat_doc () == 11) {
												?>
											<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_blc_pret.gif" id="livraison_pret" style="cursor:pointer"/>
											<div style="height:3px;line-height:3px;" ></div>
											<?php 
											}
											?>
											<?php 
											if ($document->getId_etat_doc () == 13) {
											
												?>
												<div style="float:left">
												<table cellpadding="0" cellspacing="0" border="0" style="">
													<tr style=" line-height:24px; height:24px;">
														<td style="width:150px;">
															Facturation imm?diate
														</td>
														<td style="">
															<input type="checkbox" id="fact_immediate" name="fact_immediate" value="1" <?php if (($document->getRef_contact () && $document->getClient_facturation () == "immediate" ) || (!$document->getRef_contact () && $FACTURE_IMMEDIATE )) {?>checked="checked"<?php } ?> />
														</td>
													</tr>
												</table>
												</div>
												<?php 
												if (!$document->must_pay_before_livraison ()) {
													?>
													<span id="livraison_livree"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_blc_livrer.gif" id="livraison_livree_img" style="cursor:pointer"/></span>
													<div style="height:3px; line-height:3px;"></div>
													<?php 
												} else {
													?>
													<a href="#" id="livraison_livree"  style="text-decoration:none; color:#FF0000; font-weight:bolder">
													<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_blc_livrer_r.gif" style="cursor:pointer" id="livraison_livree_img"/></a>
													<div style="height:3px; line-height:3px;"></div>
													 <span style="color:#FF0000; font-weight:bolder">Le r&egrave;glement doit &ecirc;tre effectu&eacute; avant la livraison.</span>
													<?php
												}
												
											}
											?>
											<?php 
											if ($document->getId_etat_doc () == 14) {
												?>
											<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_blc_livraison_done.gif" id="livraison_en_cours" style="cursor:pointer"/>
											<div style="height:3px; line-height:3px;"></div>
											<?php 
											}
											?>
											<?php 
											if ($document->getA_facturer ()) {
												?>
											<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_blc_facturer.gif" id="a_facturer" style="cursor:pointer"/>
											<div style="height:3px; line-height:3px;"></div>
											<?php 
											}
											?>
											
											<div style="height:3px; line-height:3px;"></div>
											<div id="doc_message_info"  style="text-decoration:none; color:#FF0000; font-weight:bolder"></div>
											<div id="doc_alerte_stock"  style="text-decoration:none; color:#FF0000; font-weight:bolder"></div>
											</td>
										</tr>
										
									</table>
							
									</td>
								</tr>
							</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<script type="text/javascript">
		// observateur de changement de texte dans l'entete du doc pour mise ? jour des infos
		Event.observe("ref_doc_externe", "blur", function(evt){
			if ($("ref_doc_externe").value != $("ref_doc_externe_old").value) {
				$("ref_doc_externe_old").value = $("ref_doc_externe").value;
				$("head_ref_doc_externe").innerHTML = $("ref_doc_externe").value + "&nbsp;";
				maj_ref_doc_externe ("ref_doc_externe");
			}
			$("ref_doc_externe").hide();
			$("head_ref_doc_externe").show();
		}, false);
		Event.observe("head_ref_doc_externe", "click", function(evt){
			Event.stop(evt);
			$("head_ref_doc_externe").hide();
			$("ref_doc_externe").show();
			$("ref_doc_externe").focus();
		}, false);

		Event.observe("code_affaire", "blur", function(evt){
			if ($("code_affaire").value != $("code_affaire_old").value) {
				$("code_affaire_old").value = $("code_affaire").value;
				$("head_code_affaire").innerHTML = $("code_affaire").value + "&nbsp;";
				maj_code_affaire ("code_affaire");
				$("lien_recherche_avancee_code_affaire").href = "#documents_recherche.php?code_affaire=" + $("code_affaire").value;
			}
			$("code_affaire").hide();
			$("head_code_affaire").show();
			if($("code_affaire").value != ""){
				$("lien_recherche_avancee_code_affaire").show();
			}else{
				$("lien_recherche_avancee_code_affaire").hide();
			}
		}, false);
		Event.observe("head_code_affaire", "click", function(evt){
			Event.stop(evt);
			$("head_code_affaire").hide();
			$("code_affaire").show();
			$("code_affaire").focus();
		}, false);
		Event.observe("code_affaire", "dblclick", function(evt){
			Event.stop(evt);
			generer_code_affaire ("code_affaire");
		}, false);
		
		Event.observe("head_date_creation", "click", function(evt){
			Event.stop(evt);
			$("head_date_creation").hide();
			$("date_creation").show();
			$("date_creation").focus();
		}, false);
		Event.observe("date_creation", "blur", function(evt){
			if ($("date_creation").value != $("date_creation_old").value) { 
				datemask (evt); 
				$("date_creation_old").value = $("date_creation").value; 
				maj_date_creation ("date_creation");
				$("head_date_creation").innerHTML = $("date_creation").value + "&nbsp;";
			}
			$("date_creation").hide();
			$("head_date_creation").show();
		}, false);

			<?php
			if (count($stocks_liste)>1) {
				?>
				Event.observe("id_stock", "change", function(evt){ maj_entete_id_stock ("id_stock"); }, false);
				<?php
			}
			?>

			<?php
			if (count($_SESSION['magasins'])>1) {
				?>
				Event.observe("id_magasin", "change", function(evt){ maj_entete_id_magasin ("id_magasin"); }, false);
				<?php
			}
			?>
			
			<?php 
			if ($document->getId_etat_doc () == 11) {
				?>
				// pret
				Event.observe("livraison_pret", "click", function(evt){Event.stop(evt); maj_etat_doc (13);
		$("livraison_pret").hide(); }, false);
				is_sn_filled ();
			<?php 
			}
			?>
			<?php 
			if ($document->getId_etat_doc () == 13 ) {
					?>
					Event.observe("livraison_livree", "click", function(evt){
					Event.stop(evt); 
					if ($("fact_immediate").checked) {
						maj_etat_open_doc (15);
					} else {
						maj_etat_doc_cycle (15, "not_generer_facture");
					}
					$("livraison_livree").hide(); }, false);
					is_sn_filled ();
					<?php 
			}
			?>
			<?php 
			if ($document->getId_etat_doc () == 14) {
				?>
				// 
				Event.observe("livraison_en_cours", "click", function(evt){Event.stop(evt); maj_etat_doc (15);
		$("livraison_en_cours").hide(); }, false);
			<?php 
			}
			?>
			<?php 
			if ($document->getA_facturer ()) {
				?>
				// 
				Event.observe("a_facturer", "click", function(evt){
						Event.stop(evt);
							action_doc ("generer_fa_client");
						
				}, false);
				<?php 
			}
			?>
		
		
		
		//on masque le chargement
		H_loading();
		
		</script>
		</div>
		</div>
		</td>
		
	</tr>
	
	<tr>
		<td style="width:48%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1px"/></td>
		<td style="width:4%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1px"/></td>
		<td style="width:48%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1px"/></td>
	</tr>
	<tr>
		<td>
		<div id="block_contact">
		<div style="width:100%;">
		<table cellpadding="0" cellspacing="0" border="0" style="width:100%" id="document_contact_entete" class="document_box">
			<tr style=" line-height:20px; height:20px;" class="document_head_list">
				<td style=" padding-left:3px;" class="doc_bold" >
					Client
					<input type="hidden" name="ref_contact"  id="ref_contact" value="<?php echo $document->getRef_contact();?>"/>
				</td>
				<td colspan="2" style="text-align:right">
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/doc_view_contact.gif" style="cursor:pointer;<?php if (!$document->getRef_contact()) { echo 'display:none;';}?>" id="doc_view_contact_img" alt="Voir la fiche du contact" title="Voir la fiche du contact" />&nbsp;
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/doc_set_contact.gif" style="cursor:pointer" id="doc_ref_contact_img" alt="Choisir un contact" title="Choisir un contact"/>&nbsp;&nbsp;
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" style="cursor:pointer" id="doc_sup_contact_img" alt="Supprimer le  contact" title="Supprimer le  contact"/>
				<script type="text/javascript">
				//Event.observe('doc_ref_contact_img', 'mouseover',  function(){$("doc_ref_contact_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_hover.gif";}, false);
				//Event.observe('doc_ref_contact_img', 'mousedown',  function(){$("doc_ref_contact_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_down.gif";}, false);
				//Event.observe('doc_ref_contact_img', 'mouseup',  function(){$("doc_ref_contact_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
				//Event.observe('doc_ref_contact_img', 'mouseout',  function(){$("doc_ref_contact_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
				
				Event.observe('doc_view_contact_img', 'click',  function(){ if ($("ref_contact").value!="" && $("ref_contact").value!="NULL") { page.verify('affaires_affiche_fiche','annuaire_view_fiche.php?ref_contact=<?php echo $document->getRef_contact();?>','true','sub_content');} }, false);
				Event.observe('doc_ref_contact_img', 'click',  function(){ show_mini_moteur_contacts ('docu_maj_contact', '\'<?php echo $document->getRef_doc();?>\''); preselect ('<?php echo $CLIENT_ID_PROFIL;?>', 'id_profil_m');}, false);
				Event.observe('doc_sup_contact_img', 'click',  function(){ docu_maj_contact("<?php echo $document->getRef_doc();?>", "");}, false);
				
				</script>
				</td>
			</tr>
			<tr>
				<td colspan="3">
								<div style="height:3px;"></div>
				</td>
			</tr>
			<tr>
				<td style="width:150px; padding-left:3px;">
					D&eacute;nomination: 
				</td>
				<td style="width:250px;">
					<textarea type="text" name="nom_contact"  id="nom_contact" class="classinput_xsize" rows="<?php if (stristr($_SERVER["HTTP_USER_AGENT"], "firefox")) { echo "1"; } else { echo "2"; } ?>"><?php echo str_replace("?", "&euro;", $document->getNom_contact());?></textarea>
					<script type="text/javascript">
					Event.observe('nom_contact', 'click',  function(){
						if ($F("nom_contact") == ""){ 
						show_mini_moteur_contacts ('docu_maj_contact', '\'<?php echo $document->getRef_doc();?>\''); preselect ('<?php echo $CLIENT_ID_PROFIL;?>', 'id_profil_m');
						}
						}, false);
					</script>
					<div id="nom_contact_old" style="display:none"><?php echo str_replace("?", "&euro;", $document->getNom_contact());?></div>
				</td>
				<td>
				<div style="width:17px; height:19px">
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
								<div style="height:3px;"></div>
				</td>
			</tr>
			<tr>
				<td style=" padding-left:3px;">
					Adresse Livraison:
				</td>
				<td colspan="2">
					<input type="hidden" name="ref_adr_contact"  id="ref_adr_contact" value="<?php echo $document->getRef_adr_contact();?>"/>
					<table cellpadding="0" cellspacing="0" border="0" style="width:268px;">
						<tr>
							<td style="width:250px;">
								<div  class="doc_contact_class_input" id="view_doc_adresse_resume" style="display:">
								<?php echo nl2br($document->getAdresse_contact());?>
								</div>
								<div id="aff_doc_adresse_edition" style="display:none">
								<textarea name="adresse_contact" id="adresse_contact" title="Adresse" class="classinput_xsize" rows="<?php if (stristr($_SERVER["HTTP_USER_AGENT"], "firefox")) { echo "1"; } else { echo "2"; } ?>"><?php echo  ($document->getText_adresse_contact());?></textarea>
								<div id="adresse_contact_old" style="display:none"><?php echo ($document->getText_adresse_contact());?></div>
								
								<div style="height:3px;"></div>
								
								<input name="code_postal_contact" id="code_postal_contact" title="Code postal" class="classinput_xsize" value="<?php echo  ($document->getCode_postal_contact());?>" />
								<div id="code_postal_contact_old" style="display:none"><?php echo ($document->getCode_postal_contact());?></div>
								<div style="height:3px;"></div>
								
				<div style="position:relative; top:0px; left:0px; width:100%; height:0px;">
				<iframe id="iframe_choix_ville_contact" frameborder="0" scrolling="no" src="about:_blank"  class="choix_complete_ville"></iframe>
				<div id="choix_ville_contact"  class="choix_complete_ville"></div></div>
								<input name="ville_contact" id="ville_contact" title="Ville" class="classinput_xsize" value="<?php echo  ($document->getVille_contact());?>" />
								<div id="ville_contact_old" style="display:none"><?php echo ($document->getVille_contact());?></div>
								<div style="height:3px;"></div>
								<?php 
									$listepays = getPays_select_list ();
								?>
								
								<select id="id_pays_contact"  name="id_pays_contact" class="classinput_xsize" title="Pays">
				
									<?php
									$separe_listepays = 0;
									foreach ($listepays as $payslist){
										if ((!$separe_listepays) && (!$payslist->affichage)) { 
											$separe_listepays = 1; ?>
											<OPTGROUP disabled="disabled" label="__________________________________" ></OPTGROUP>
											<?php 		 
										}
										?>
										<option value="<?php echo $payslist->id_pays?>" <?php if ($document->getId_pays_contact() == $payslist->id_pays) {echo 'selected="selected"';}?> <?php if (!$document->getId_pays_contact() && $DEFAUT_ID_PAYS == $payslist->id_pays) {echo 'selected="selected"';}?>>
										<?php echo htmlentities($payslist->pays)?></option>
										<?php 
									}
									?>
								</select>
								<script type="text/javascript">
									Event.observe('ville_contact', 'focus',  function(evt){start_commune("code_postal_contact", "ville_contact", "choix_ville_contact", "iframe_choix_ville_contact", "liste_ville_doc_contact.php?cp=");}, false);
										
									Event.observe('id_pays_contact', 'focus',  function(){delay_close("choix_ville_contact", "iframe_choix_ville_contact");}, false);
								</script>
								</div>
							</td>
							<td style="width:18px; vertical-align:bottom">
							<div id="adresse_contact_choisie"  style="width:20px; cursor: default; text-align:right">
							<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_doc_choix_adresses.gif" style="float:right" id="bt_adresse_contact_choisie"/>
							</div>
							</td>
							</tr>
							<tr>
							<td>
							<div style="position:relative; top:-21px; left:0px; width:100%; height:0px;">
							<iframe id="iframe_liste_choix_adresse_contact" frameborder="0" scrolling="no" src="about:_blank"  class="choix_liste_choix_coordonnee" style="display:none"></iframe>
							<div id="choix_liste_choix_adresse_contact"  class="choix_liste_choix_coordonnee" style="display:none"></div></div>
							</td>
							<td>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3">
								<div style="height:3px;"></div>
				</td>
			</tr>
			
			<?php if(method_exists($document,'getId_livraison_mode') && $document->getId_livraison_mode()) { ?>
			<tr>
				<td style=" padding-left:3px;">
					Mode de Livraison:
				</td>
				<td colspan="2">
					<table style="width:268px;" >
						<tr>
							<td style="width:250px; text-align: left; font-weight:bolder;">
							<?php 
								$aff_livraison_mode = new livraison_modes($document->getId_livraison_mode());
								$article_livraison_mode = $aff_livraison_mode->getArticle();
								echo $article_livraison_mode->getLib_article();
							?>
							</td>
							<td>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3">
								<div style="height:3px;"></div>
				</td>
			</tr>
			<?php } ?>
		</table>
		
		<script type="text/javascript">
		//observateur pour liste adresse contact
		pre_start_adresse_doc ("adresse_contact_choisie", "bt_adresse_contact_choisie", $("ref_contact").value, "adresse_contact", "ref_adr_contact", "choix_liste_choix_adresse_contact", "iframe_liste_choix_adresse_contact", "documents_liste_choix_adresse.php", $("ref_doc").value, "adresse_contact");
		
		Event.observe("view_doc_adresse_resume", "click", function(evt){
			$("aff_doc_adresse_edition").show();
			$("adresse_contact").focus();
			$("view_doc_adresse_resume").hide();
		}, false);
		
		// observateurde changement de texte dans les infos contact pour mise ? jour des infos
		
		Event.observe("nom_contact", "blur", function(evt){
			if ($("nom_contact").value != $("nom_contact_old").innerHTML) {
				docu_maj_contact_infos ($("ref_doc").value, "nom_contact"); 
				$("nom_contact_old").innerHTML = $("nom_contact").value;
			}
		}, false);
				
		force_rows ("nom_contact", "1");
				
		Event.observe("adresse_contact", "blur", function(evt){
			if ($("adresse_contact").value != $("adresse_contact_old").innerHTML) {
				docu_maj_contact_infos ($("ref_doc").value, "adresse_contact"); 
				$("adresse_contact_old").innerHTML = $("adresse_contact").value;
			}
		}, false);
		
		Event.observe("code_postal_contact", "blur", function(evt){
			if ($("code_postal_contact").value != $("code_postal_contact_old").innerHTML) {
				docu_maj_contact_infos ($("ref_doc").value, "code_postal_contact"); 
				$("code_postal_contact_old").innerHTML = $("code_postal_contact").value;
			}
		}, false);
		Event.observe("ville_contact", "blur", function(evt){
			if ($("ville_contact").value != $("ville_contact_old").innerHTML) {
				docu_maj_contact_infos ($("ref_doc").value, "ville_contact"); 
				$("ville_contact_old").innerHTML = $("ville_contact").value;
			}
		}, false);
		Event.observe("id_pays_contact", "change", function(evt){
			docu_maj_contact_infos ($("ref_doc").value, "id_pays_contact"); 
		}, false);
				
		force_rows ("adresse_contact", "1");
		
	
		
		
		<?php 
		//si on change de contact alors les infos sont retourn?es par $_infos
		// on met juste ? jour l'app_tarifs par rapport au contact mis ? jour
		if ($document->getApp_tarifs()) {
			?>
			$("app_tarifs").value				= "<?php echo ($document->getApp_tarifs());?>";
			if ($("app_tarifs").value	== "HT") {
			$("prix_afficher_ht").checked = "checked";
			} else {
			$("prix_afficher_ttc").checked = "checked";
			}
			<?php
		}
		?>
		
		</script>
		</div>
		</div>
		</td>
		<td>
		<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
			<tr style=" line-height:20px; height:20px;" class="">
				<td colspan="3">&nbsp;
				
				</td>
			</tr>
		</table>
		</td>
		<td>
		<div id="block_reglement">
		<div style="width:100%;">
		<?php
		if ($document->getACCEPT_REGMT() == 1) { 
			?>
			<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_documents_reglements_entete.inc.php" ?>
			<?php
		}
		?>
		</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

<script type="text/javascript">
	quantite_locked = <?php if ($document->getQuantite_locked ()) {echo "true";} else {echo "false";} ?>;
	

<?php if (!isset($load) && $document->getACCEPT_REGMT() != 1) {?>
document_calcul_tarif ();
//on masque le chargement
H_loading();
<?php } ?>
</script>