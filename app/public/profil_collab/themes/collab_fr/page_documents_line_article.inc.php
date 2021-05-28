<?php

// *************************************************************************************************************
// LIGNE D'ARTICLE
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="document_line">
	<tr>
		<td style="width:28px;">
			<div style="width:28px;">
			<input id="check_<?php echo $indentation_contenu?>" name="check_<?php echo $indentation_contenu?>" type="checkbox" value="check_line"/>
			</div>
		</td>
		<td style="width:110px" class="document_border_right">
			<div style="width:107px;">
			<input type="hidden" name="lignesliees_<?php echo $indentation_contenu; ?>" 
					id="lignesliees_<?php echo $indentation_contenu; ?>" value="<?php echo $nb_lignes_liees; ?>" />
			<a href="#" style="text-decoration:none; color:#000000" id="link_to_art_<?php echo $indentation_contenu?>">
			<?php if ($contenu->ref_interne != "") { echo $contenu->ref_interne;} else { echo $contenu->ref_article;} ?></a><br />
			<?php echo $contenu->ref_oem;?>
			<input value="<?php echo $contenu->ref_doc_line;?>" id="ref_doc_line_<?php echo $indentation_contenu?>" name="ref_doc_line_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->ref_article;?>" id="ref_article_<?php echo $indentation_contenu?>" name="ref_article_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->ref_oem;?>" id="ref_oem_<?php echo $indentation_contenu?>" name="ref_oem_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->ref_interne;?>" id="ref_interne_<?php echo $indentation_contenu?>" name="ref_interne_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->valo_indice;?>" id="valo_indice_<?php echo $indentation_contenu?>" name="valo_indice_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->gestion_sn;?>" id="gestion_sn_<?php echo $indentation_contenu?>" name="gestion_sn_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->modele;?>" id="modele_<?php echo $indentation_contenu?>" name="modele_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->lot;?>" id="lot_<?php echo $indentation_contenu?>" name="lot_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->ordre;?>" id="ordre_<?php echo $indentation_contenu?>" name="ordre_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->ref_doc_line_parent;?>" id="ref_doc_line_parent_<?php echo $indentation_contenu?>" name="ref_doc_line_parent_<?php echo $indentation_contenu?>" type="hidden"/>
			</div>
		</td>
		<td style="width:280px; padding-left:3px">
			<div style="width:277px;">
			<?php
			if (substr_count($contenu->lib_article, "<br />") || substr_count($contenu->lib_article, "\n")) {
				?>
				<textarea id="lib_article_<?php echo $indentation_contenu?>" rows="1" name="lib_article_<?php echo $indentation_contenu?>" type="text" class="classinput_xsize"><?php
				if (isset($line_insert)) {
					echo str_replace("&curren;", "&euro;", str_replace("<br />","\n",$contenu->lib_article));
				} else {
					echo str_replace("€", "&euro;", str_replace("<br />","\n",$contenu->lib_article));
				}
				?></textarea>
				<div id="lib_article_old_<?php echo $indentation_contenu?>" style="display:none"><?php
				if (isset($line_insert)) {
					echo str_replace("&curren;", "&euro;", str_replace("<br />","\n",$contenu->lib_article));
				} else {
					echo str_replace("€","&euro;", str_replace("<br />","\n",$contenu->lib_article));
				}
				?></div>
				<?php
				} else {
				?>
				<input id="lib_article_<?php echo $indentation_contenu?>" name="lib_article_<?php echo $indentation_contenu?>" type="text" class="classinput_xsize" value="<?php
				if (isset($line_insert)) {
					echo str_replace("&curren;", "&euro;", $contenu->lib_article);
				} else {
					echo str_replace("€","&euro;", $contenu->lib_article);
				}
				?>" />
				<div id="lib_article_old_<?php echo $indentation_contenu?>" style="display:none"><?php
				if (isset($line_insert)) {
					echo str_replace("&curren;", "&euro;", str_replace("<br />","\n",$contenu->lib_article));
				} else {
					echo str_replace("€","&euro;",str_replace("<br />","\n",$contenu->lib_article));
				}
				?></div>
				<?php
			}
			?>
			<div id="div_desc_article_<?php echo $indentation_contenu?>" style="display:<?php if ($contenu->desc_article == "") { echo"none";} else {echo "block";}?>">
			<div style="height:3px; line-height:3px;"></div>
			<textarea  id="desc_article_<?php echo $indentation_contenu?>" name="desc_article_<?php echo $indentation_contenu?>" class="classinput_xsize" rows="<?php if (stristr($_SERVER["HTTP_USER_AGENT"], "firefox")) { echo "1"; } else { echo "2"; } ?>"><?php
				//if ($id_type_doc == $FACTURE_CLIENT_ID_TYPE_DOC || $id_type_doc == $LIVRAISON_CLIENT_ID_TYPE_DOC || $id_type_doc == $COMMANDE_CLIENT_ID_TYPE_DOC || $id_type_doc == $DEVIS_CLIENT_ID_TYPE_DOC ) { 
					if (isset($line_insert)) {
						echo str_replace("&curren;", "&euro;", str_replace("<br />","\n",$contenu->desc_article));
					} else {
						echo str_replace("€","&euro;",str_replace("<br />","\n",$contenu->desc_article));
					}
				//}
				?></textarea>
			<div id="desc_article_old_<?php echo $indentation_contenu?>" style="display:none"><?php
				//if ($id_type_doc == $FACTURE_CLIENT_ID_TYPE_DOC || $id_type_doc == $LIVRAISON_CLIENT_ID_TYPE_DOC || $id_type_doc == $COMMANDE_CLIENT_ID_TYPE_DOC || $id_type_doc == $DEVIS_CLIENT_ID_TYPE_DOC ) { 
					if (isset($line_insert)) {
						echo str_replace("&curren;", "&euro;", str_replace("<br />","\n",$contenu->desc_article));
					} else {
						echo str_replace("€","&euro;",str_replace("<br />","\n",$contenu->desc_article));
					}
				//}
				?></div>
			</div>

			<?php
				if ($id_type_doc == $FACTURE_FOURNISSEUR_ID_TYPE_DOC || $id_type_doc == $LIVRAISON_FOURNISSEUR_ID_TYPE_DOC || $id_type_doc == $COMMANDE_FOURNISSEUR_ID_TYPE_DOC || $id_type_doc == $DEVIS_FOURNISSEUR_ID_TYPE_DOC ) {
				?>
				<input value="<?php if (isset($contenu->ref_article_externe)) {echo $contenu->ref_article_externe;} ?>" id="ref_article_externe_<?php echo $indentation_contenu?>" name="ref_article_externe_<?php echo $indentation_contenu?>" type="text"  class="ref_fourn__choix" title="Référence fournisseur" />
				<input value="<?php if (isset($contenu->ref_article_externe)) {echo $contenu->ref_article_externe;} ?>" id="old_ref_article_externe_<?php echo $indentation_contenu?>" name="old_ref_article_externe_<?php echo $indentation_contenu?>" type="hidden"/><span id="more_ref_article_externe_<?php echo $indentation_contenu?>" style="cursor:pointer">+</span>
						<div class="sn_block_choix" id="block_choix_ref_externe_<?php echo $indentation_contenu?>">
						<iframe id="iframe_liste_choix_ref_externe_<?php echo $indentation_contenu;?>" frameborder="0" scrolling="no" src="about:_blank"  class="choix_liste_choix_sn" style="display:none"></iframe>
						<div id="choix_liste_choix_ref_externe_<?php echo $indentation_contenu;?>"  class="choix_liste_choix_sn" style="display:none; left:-22px; top:20px"></div>
						</div>
				<script type="text/javascript">
				pre_start_ref_externe ("<?php echo $contenu->ref_article;?>", "<?php echo $contenu->ref_doc_line;?>", "<?php echo $indentation_contenu?>");
				</script>
				<?php
				}
			?>
			<?php
			 if (isset($contenu->sn)) {
			  if (is_array($contenu->sn)) {
					if ($contenu->gestion_sn == 1)  {
						?>
						<div id="art_gest_sn_<?php echo $indentation_contenu?>">
						<?php

						$nb_sn_aff = abs($contenu->qte);

						for ($i=0; $i<$nb_sn_aff; $i++) {
							if ($i >= $DOC_AFF_QTE_SN){ break;}
							?>
							<div id="num_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>">
							<span id="more_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>" class="more_sn_class"><?php echo utf8_decode('N° de série:')?></span> <input value="<?php if (isset($contenu->sn[$i]->numero_serie)) {echo $contenu->sn[$i]->numero_serie;}?>" type="text" id="art_sn_<?php echo $indentation_contenu;?>_<?php echo $i;?>" name="art_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>" <?php if (isset($contenu->sn[$i]->sn_exist) && !($contenu->sn[$i]->sn_exist)) { echo "style=\"color: #FF0000;\"";}?>/>
							<input value="<?php if (isset($contenu->sn[$i]->numero_serie)) {echo $contenu->sn[$i]->numero_serie;}?>" type="hidden" id="old_art_sn_<?php echo $indentation_contenu;?>_<?php echo $i;?>" name="old_art_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>"/>
							<a href="#" id="sup_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0">
							</a>
							<div class="sn_block_choix" id="block_choix_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>">
							<iframe id="iframe_liste_choix_sn_<?php echo $indentation_contenu;?>_<?php echo $i;?>" frameborder="0" scrolling="no" src="about:_blank"  class="choix_liste_choix_sn" style="display:none"></iframe>
							<div id="choix_liste_choix_sn_<?php echo $indentation_contenu;?>_<?php echo $i;?>"  class="choix_liste_choix_sn" style="display:none"></div>
							</div>
							<script type="text/javascript">
							pre_start_observer_sn ("<?php echo $indentation_contenu?>", "<?php echo $i;?>", "<?php echo $contenu->ref_doc_line;?>", "art_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>" ,"old_art_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>", "sup_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>", "more_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>", "<?php echo $contenu->ref_article;?>", "choix_liste_choix_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>", "iframe_liste_choix_sn_<?php echo $indentation_contenu?>_<?php echo $i;?>" );
							</script>
							</div>
							<?php
						}
						?>
						<input type="hidden" id="art_gest_sn_finliste_<?php echo $indentation_contenu?>" name="art_gest_sn_finliste_<?php echo $indentation_contenu?>" value="" />
						</div>
						<?php
							?>
							<span id="aff_all_sn_<?php echo $indentation_contenu?>" style="cursor:pointer;<?php if ($nb_sn_aff <= $DOC_AFF_QTE_SN){?> display:none;<?php }?>">Afficher tout les numéros de série.</span>
							<script type="text/javascript">
							Event.observe("aff_all_sn_<?php echo $indentation_contenu?>", "click",  function(evt){
								Event.stop(evt);
								show_mini_pop_up_article_sn($("ref_doc").value, "<?php echo $contenu->ref_doc_line;?>", "1");
							}, false);
							</script>
						<?php
					}
					
					if ($contenu->gestion_sn == 2)  {
						?>
						<div id="art_gest_nl_<?php echo $indentation_contenu?>">
						<?php
						$nb_nl = array();
						foreach ($contenu->sn as $diff_nl) {
							if (isset($nb_nl[$diff_nl->numero_serie])) {$nb_nl[$diff_nl->numero_serie] = $nb_nl[$diff_nl->numero_serie] + $diff_nl->sn_qte; }
							if (!isset($nb_nl[$diff_nl->numero_serie])) {$nb_nl[$diff_nl->numero_serie] = $diff_nl->sn_qte; }

						}
						$nb_nl_aff = count($nb_nl);
						$i=0;
						if (!$nb_nl_aff) {$nb_nl[] = "";}
						$total_sn_qte = 0;
						foreach ($nb_nl as $nl_key=>$nl_val) {
							if (isset($nl_val)) { $total_sn_qte += $nl_val; } 
							?>
							<div id="num_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>">
							<span id="more_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>" class="more_sn_class"><?php echo utf8_decode('N° de Lot:')?></span>
							<input value="<?php if (isset($nl_key)) {echo $nl_key;}?>" type="text" id="art_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>" name="art_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>"  size="10"/>
							<input value="<?php if (isset($nl_key)) {echo $nl_key;}?>" type="hidden" id="old_art_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>" name="old_art_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>"/>
							<input value="<?php if (isset($nl_val)) {echo $nl_val;}?>" type="text" id="qte_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>" name="qte_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>"  size="3"/>
							<input value="<?php if (isset($nl_val)) {echo $nl_val;}?>" type="hidden" id="old_qte_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>" name="old_qte_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>" />

							<a href="#" id="sup_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0">
							</a>
							<div class="sn_block_choix" id="block_choix_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>">
							<iframe id="iframe_liste_choix_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>" frameborder="0" scrolling="no" src="about:_blank"  class="choix_liste_choix_sn" style="display:none"></iframe>
							<div id="choix_liste_choix_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>"  class="choix_liste_choix_sn" style="display:none"></div>
							</div>
							<script type="text/javascript">
							pre_start_observer_nl ("<?php echo $indentation_contenu?>", "<?php echo $i;?>", "<?php echo $contenu->ref_doc_line;?>", "art_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>" ,"old_art_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>", "sup_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>", "more_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>", "<?php echo $contenu->ref_article;?>", "choix_liste_choix_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>", "iframe_liste_choix_nl_<?php echo $indentation_contenu?>_<?php echo $i;?>", "qte_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>", "old_qte_nl_<?php echo $indentation_contenu;?>_<?php echo $i;?>" );
							</script>
							</div>
							<?php
							$i++;
						}
						?>
						<input type="hidden" id="art_gest_nl_finliste_<?php echo $indentation_contenu?>" name="art_gest_nl_finliste_<?php echo $indentation_contenu?>" value="<?php echo $i;?>" />
						</div>
						<div>Total : <span id="total_sn_qte_<?php echo $indentation_contenu?>">
						<?php 
						if ($contenu->qte == $total_sn_qte){
						echo number_format($total_sn_qte, 2, ".", ""	);
						}else{
						echo "<FONT COLOR='#FF0000'>".number_format($total_sn_qte, 2, ".", ""	)."</FONT>";
						}
						?>
						</span></div>
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/ajouter.gif" width="15px" style="cursor:pointer" id="add_line_nl_content_<?php echo $indentation_contenu?>" />
							<script type="text/javascript">

								Event.observe("add_line_nl_content_<?php echo $indentation_contenu?>", "click", function(evt){
								insert_line_nl ("<?php echo $indentation_contenu?>", $("art_gest_nl_finliste_<?php echo $indentation_contenu?>").value);
								},  false );
							</script>
						<?php
					}
				}
			}
			?>
			</div>
		</td>

		<td style="width:27px" class="document_border_right">
			<div style="width:27px;">
			<a href="#" id="show_desc_<?php echo $indentation_contenu?>" style="display:<?php if ($contenu->desc_article == "") {echo "block";} else { echo"none";}?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/ajouter.gif" /></a>
			<a href="#" id="unshow_desc_<?php echo $indentation_contenu?>" style="display:<?php if ($contenu->desc_article == "") { echo"none";} else {echo "block";}?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/moins.gif" /></a>
			</div>
		</td>

		<td style="width:70px; text-align:center;" class="document_border_right">
			<div style="width:70px;">
			<input value="<?php echo $contenu->qte;?>" id="qte_old_<?php echo $indentation_contenu?>" name="qte_old_<?php echo $indentation_contenu?>" type="hidden" />
			<input value="<?php echo $contenu->qte;?>" id="qte_<?php echo $indentation_contenu?>" name="qte_<?php echo $indentation_contenu?>" type="text" size="2" class="classinput_nsize" style="text-align:center; <?php
		
if ($contenu->modele == "materiel" && $contenu->lot != 2 && $GESTION_STOCK) {
			if ($id_type_doc == $LIVRAISON_CLIENT_ID_TYPE_DOC || $id_type_doc == $TRANSFERT_ID_TYPE_DOC) {
				if (isset($contenu->stock)) {
					 if ($contenu->qte > $contenu->stock) {
						?> color:#FF0000; <?php
						}
				} else {
					 if ($contenu->qte > 0) {
						?> color:#FF0000; <?php
						}
				}
			}
			if ($id_type_doc == $INVENTAIRE_ID_TYPE_DOC ) {
				if (isset($contenu->qte_en_stock)) {
					 if ($contenu->qte > $contenu->qte_en_stock || $contenu->qte < $contenu->qte_en_stock ) {
						?> color:#FF0000; <?php
						}
				} else {
						?> color:#000000; <?php
				}
			}
		} else {?> color:#000000; <?php }
		?>"
		<?php

		if ($contenu->modele == "materiel" && $contenu->lot != 2 && $GESTION_STOCK) {
			if ($id_type_doc == $LIVRAISON_CLIENT_ID_TYPE_DOC || $id_type_doc == $TRANSFERT_ID_TYPE_DOC) {?>
				title="En stock <?php if (isset($contenu->stock)) { echo $contenu->stock;} else {echo "0";}?>"
			<?php
			}
			?>
			<?php
			if ($id_type_doc == $INVENTAIRE_ID_TYPE_DOC) {?>
				title="Stock attendu <?php if (isset($contenu->qte_en_stock)) { echo $contenu->qte_en_stock;} else {echo "0";}?>"
			<?php
			}
		} else {?> title=""<?php }
		?>
			/>
			</div>
		</td>
		<?php if ($id_type_doc == $COMMANDE_CLIENT_ID_TYPE_DOC) {?>
		<td style="width:70px; text-align:center;"  class="document_border_right">
			<div style="width:70px;">
			<?php if (isset($contenu->qte_livree) && $contenu->qte_livree != "") {echo number_format($contenu->qte_livree,  $TARIFS_NB_DECIMALES, ".", ""	);} else { echo "0";} ?>
			</div>
		</td>
		<?php } ?>
		<?php if ($id_type_doc == $COMMANDE_FOURNISSEUR_ID_TYPE_DOC) {?>
		<td style="width:70px; text-align:center;"  class="document_border_right">
			<div style="width:70px;">
			<?php if (isset($contenu->qte_recue) && $contenu->qte_recue != "") {echo number_format($contenu->qte_recue,  $TARIFS_NB_DECIMALES, ".", ""	);} else { echo "0";} ?>
			</div>
		</td>
		<?php } ?>
		<td style="width:70px; text-align:center" class="document_border_right">
			<div style="width:70px;">
			<input value="<?php echo number_format($contenu->pu_ht, $CALCUL_TARIFS_NB_DECIMALS, ".", ""	);?>" id="pu_ht_old_<?php echo $indentation_contenu?>" name="pu_ht_old_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo number_format($contenu->pu_ht, $CALCUL_TARIFS_NB_DECIMALS, ".", ""	);?>" id="pu_ht_<?php echo $indentation_contenu?>" name="pu_ht_<?php echo $indentation_contenu?>" type="hidden" class="classinput_nsize" size="6" style="text-align:right"/>
			<input value="<?php echo number_format($contenu->pu_ht, $TARIFS_NB_DECIMALES, ".", ""	);?>" id="pu_<?php echo $indentation_contenu?>" name="pu_<?php echo $indentation_contenu?>" type="text" class="classinput_nsize" size="5" style="text-align:right"/>
			</div>
		</td>
		<?php if ($AFF_REMISES) {?>
		<td style="width:70px; text-align:center" class="document_border_right">
			<div style="width:70px;">
			<input value="<?php echo $contenu->remise;?>" id="remise_old_<?php echo $indentation_contenu?>" name="remise_old_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->remise;?>" id="remise_<?php echo $indentation_contenu?>" name="remise_<?php echo $indentation_contenu?>" type="text" size="3" style="text-align:center" class="classinput_nsize"/>
			</div>
		</td>
		<?php } else { ?>
		<td style="width:0px; text-align:center">
			<input value="<?php echo $contenu->remise;?>" id="remise_old_<?php echo $indentation_contenu?>" name="remise_old_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->remise;?>" id="remise_<?php echo $indentation_contenu?>" name="remise_<?php echo $indentation_contenu?>" type="hidden" size="5" style="text-align:center" class="classinput_nsize"/>
		</td>
		<?php } ?>
		<td style="width:70px; text-align:center" class="document_border_right">
			<div style="width:70px; ">
			<input value="<?php echo $contenu->tva;?>" id="tva_old_<?php echo $indentation_contenu?>" name="tva_old_<?php echo $indentation_contenu?>" type="hidden"/>
			<input value="<?php echo $contenu->tva;?>" id="tva_<?php echo $indentation_contenu?>" name="tva_<?php echo $indentation_contenu?>" type="text" class="classinput_nsize" size="2" style="text-align:right; <?php
			if (!$ASSUJETTI_TVA && ($id_type_doc == $DEVIS_CLIENT_ID_TYPE_DOC || $id_type_doc == $COMMANDE_CLIENT_ID_TYPE_DOC || $id_type_doc == $LIVRAISON_CLIENT_ID_TYPE_DOC || $id_type_doc == $FACTURE_CLIENT_ID_TYPE_DOC) && $contenu->tva == 0) { echo 'display:none;';}
			?>"/><?php
			if (!$ASSUJETTI_TVA && ($id_type_doc == $DEVIS_CLIENT_ID_TYPE_DOC || $id_type_doc == $COMMANDE_CLIENT_ID_TYPE_DOC || $id_type_doc == $LIVRAISON_CLIENT_ID_TYPE_DOC || $id_type_doc == $FACTURE_CLIENT_ID_TYPE_DOC) && $contenu->tva == 0) { echo 'n/a';}
			?>
			</div>
		</td>
		<td style="width:70px; text-align:center" class="document_border_right">
			<div style="width:70px;">
			<input id="pt_<?php echo $indentation_contenu?>" name="pt_<?php echo $indentation_contenu?>" type="text" 
					class="classinput_nsize" size="5" style="text-align:right" readonly="readonly" 
					value="<?php echo number_format($contenu->pu_ht * $contenu->qte, $CALCUL_TARIFS_NB_DECIMALS, ".", ""); ?>" />
			</div>
		</td>
		<td>
		<div style="text-align:center">
		<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
			<tr>
				<td>
					<div style="width:25px; text-align:right;">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/visible.gif" id="visible_<?php echo $indentation_contenu?>" style=" cursor:pointer; float:right; display: <?php if ( $contenu->visible) {echo "block";} else { echo "none";}?>" alt="Visible"/>
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/unvisible.gif" id="unvisible_<?php echo $indentation_contenu?>" style="cursor:pointer; float:right; display: <?php if (!$contenu->visible) {echo "block";} else { echo "none";}?>" alt="Invisible"/>
					</div>
				</td>
				<td style="text-align:right;">
					<div style="width:25px;text-align:right" class="documents_li_handle" >
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/main.gif" id="move_doc_line_<?php echo $indentation_contenu?>"/>
					</div>
				</td>
				<td style="text-align:right;">
					<div style="width:25px;">
					<a href="#" id="link_<?php echo $indentation_contenu?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-link.gif" border="0">
					</a>
					</div>
				</td>
				<td style="text-align:right;">
					<div style="width:25px;">
					<a href="#" id="sup_<?php echo $indentation_contenu?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0">
					</a>
					</div>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
</table>
<script type="text/javascript">
pre_start_article_line ("<?php echo ($contenu->ref_article)?>", "<?php echo $contenu->ref_doc_line?>", "<?php echo $indentation_contenu?>");
</script>