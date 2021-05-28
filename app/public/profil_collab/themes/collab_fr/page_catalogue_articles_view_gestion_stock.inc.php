<?php

// *************************************************************************************************************
// RESUME DES STOCK D'UN ARTICLE (affichage dans les moteurs de recherche article)
// *************************************************************************************************************

// Variables nécessaires à l"affichage
$page_variables = array ();
check_page_variables ($page_variables);

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

$article_sns = $article->getStocks_arti_sn ();
?>

<script type="text/javascript">

array_menu_sm	=	new Array();
<?php 
$i = 0;
foreach ($_SESSION['stocks'] as $stock) {
	?>
	array_menu_sm[<?php echo $i;?>] 	=	new Array('stock_moves_liste', 'stock_move_menu_<?php echo $i;?>');
	<?php
	$i++;
}
if (count($_SESSION['stocks']) > 1) {
	?>
	array_menu_sm[<?php echo $i;?>] 	=	new Array('stock_moves_liste', 'stock_move_menu_<?php echo $i;?>');
	<?php 
}
?>
	
</script>
<div style=" text-align:center; padding:20px">

<table style="width:100%" border="0">
	<tr>
		<td style="width:70%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:30%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr>
		<td>
		<table style="" cellpadding="0" cellspacing="0" border="0" align="center" id="tab_stocks">
			<tr>
				<td>
				<table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
				<tr style="">
					<td style="text-align:left;" class="resume_stock_border_right">&nbsp;</td>
					<?php
					if ($article->getLot() != 2) {
						?>
						<td style="text-align:center" class="resume_stock_border_right">En stock </td>
						<?php
					} else {
						?>
						<td style="text-align:center" class="resume_stock_border_right">Constituable</td>
						<?php
					}
					?>
					<td style="text-align:center" class="resume_stock_border_right">R&eacute;serv&eacute;</td>
					<?php
					if ($article->getLot() == 1) {
						?>
						<td style="text-align:center" >Fabricable</td>
						<?php
					} else {
						if ($article->getLot() != 2) {
						?>
						<td style="text-align:center" >R&eacute;appro.</td>
						<?php
						}
					}
					?>
					<td style="text-align:center" class="resume_stock_border_right"></td>
					
					<td style="text-align:center" class="resume_stock_border_right">Emplacement</td>
				
					<?php
					if ($art_categs->getModele() == $BDD_MODELES[0] && ($article->getLot() != 2) ) {
						?>
						<td style="text-align:center; padding-left:10px; padding-right:10px">Stock mini.</td>
						<?php
					}
					?>
				</tr>
				<?php
				//liste des stocks
				$first_stock = 0;
				
				$article_sns = $article->getStocks_arti_sn ();
				
				$tot_const = 0;
				$tot_res = 0;
				$tot_reap = 0;
				
				foreach ($stocks_liste as $stock_liste) {
					?>
					<tr>
						<td style="text-align:left; padding-right:5px; " class="resume_stock_border_topright">
						<?php echo htmlentities($stock_liste->getLib_stock()); ?>				</td>
						<td style="text-align:center; width:80px;" class="resume_stock_border_topright">
							<div style="text-align:center; display:block; position:relative; cursor:pointer" id="info_stock_qte_<?php echo $stock_liste->getId_stock ();?>"><?php	if ($article->getLot() == 2) {
							$max_tofab = 0;
							$countcompo = 0;
							foreach ($art_composants as $composant) {
							
								if (isset($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock) && $art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock > 0) {
								
									if (qte_format($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte) > 0) {
										if ($max_tofab == 0 && $countcompo == 0) {
											$max_tofab = qte_format($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte);
											$countcompo = 1;
										}
									}
									if (qte_format($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte) <= $max_tofab) {
											$max_tofab = qte_format($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte);
											$countcompo = 1;
									}
									if (qte_format($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte) == 0) {
										$max_tofab = 0;
										$countcompo = 1;
									}
								} else {
										$max_tofab = 0;
										$countcompo = 1;
								}
							}
							echo $max_tofab ;
							$tot_const += $max_tofab;
						}	else {
							if (isset($art_stocks[$stock_liste->getId_stock ()]->qte)) {
								echo qte_format($art_stocks[$stock_liste->getId_stock ()]->qte) ;
							$tot_const += $art_stocks[$stock_liste->getId_stock ()]->qte;
								
							} else {
								echo "0";
							}
							
							if ($article->getGestion_sn() == 1) {
								if (isset($article_sns[$stock_liste->getId_stock ()])) {
								$liste_sn = $article_sns[$stock_liste->getId_stock()]->sn;
								?>
								
							<div style="position:absolute; top:18x; left:50px; background-color:#FFFFFF; border:1px solid #CCCCCC; width:380px; height:185px; overflow:auto; display:none; -moz-border-radius:5px; border-radius:5px;" id="aff_sn_<?php echo $stock_liste->getId_stock ();?>">
							<?php
							
								
								
									?>
									
									<div style="text-align:left">
									Détails des numéros de série en stock pour <?php echo $article->getLib_article();?><br />
									<?php echo htmlentities($stock_liste->getLib_stock()); ?>: Quantité en stock: <?php if (isset($art_stocks[$stock_liste->getId_stock ()]->qte)) {
										echo qte_format($art_stocks[$stock_liste->getId_stock ()]->qte) ;
										
									} else {
										echo "0";
									}?> dont <?php echo count($liste_sn );?> possédant un numéro de série.<br />
									</div>

									<table width="100%" style="text-align:left">
									<tr>
									<td style="font-weight:bolder">
									Numéro de série
									</td>
									<td>
									
									</td>
									</tr>
								</table>
									<table width="100%" style="text-align:left">
										<tr>
											<td >
											<?php 
											foreach ($liste_sn as $key_sn=>$nb_sn) {
												?>
												
														<span  style="text-align:left; padding-right:15px">
														<?php echo " ".$key_sn;?>
														</span>
												
												<?php
											}
											?>
											</td>
										</tr>
									</table>
								<script type="text/javascript" >
								
										Event.observe("info_stock_qte_<?php echo $stock_liste->getId_stock ();?>", "click", function(evt){
											$("aff_sn_<?php echo $stock_liste->getId_stock ();?>").toggle();
											}, false );
										
								</script>
								</div>
									<?php
								}
							}
							if ($article->getGestion_sn() == 2) {
								if (isset($article_sns[$stock_liste->getId_stock ()])) {
								$liste_sn = $article_sns[$stock_liste->getId_stock()]->sn;
								?>
								
							<div style="position:absolute; top:18x; left:50px; background-color:#FFFFFF; border:1px solid #CCCCCC; width:390px; height:185px; overflow:auto; display:none; -moz-border-radius:5px; border-radius:5px;" id="aff_sn_<?php echo $stock_liste->getId_stock ();?>">
							<?php
							
								
								
									?>
									<div style="text-align:left">
									Détails des numéros de lots en stock pour <?php echo $article->getLib_article();?><br />
									<?php echo htmlentities($stock_liste->getLib_stock()); ?>: <br>
									Quantité en stock: <?php if (isset($art_stocks[$stock_liste->getId_stock ()]->qte)) {
								echo qte_format($art_stocks[$stock_liste->getId_stock ()]->qte) ;
								
							} else {
								echo "0";
							}?> dont 
									<?php 
								$combien = 0;
								foreach ($liste_sn as $key_sn=>$nb_sn) {
									$combien += $nb_sn;
								}
								echo $combien;
								
									?> possédant un numéro de lot
									</div>
									<table width="100%" style="text-align:left">
									<tr>
									<td style="font-weight:bolder">
									Numéro de lot
									</td>
									<td style="font-weight:bolder">
									Quantité
									</td>
									</tr>
									<?php 
								foreach ($liste_sn as $key_sn=>$nb_sn) {
									?>
									
									<tr>
									<td  style="text-align:left">
									<?php echo "Lot ".$key_sn;?>
									</td>
									<td>
									<?php echo $nb_sn;?>
									</td>
									</tr>
									<?php
								}
								?>
								</table>
								<script type="text/javascript" >
								
										Event.observe("info_stock_qte_<?php echo $stock_liste->getId_stock ();?>", "click", function(evt){
											$("aff_sn_<?php echo $stock_liste->getId_stock ();?>").toggle();
											}, false );
											
								</script>
								</div>
									<?php
								}
							}
						}
						?></div>
						
						</td>
						<td style="text-align:center; width:80px;" class="resume_stock_border_topright">
							<?php	
							if (isset($art_stocks_rsv[$stock_liste->getId_stock ()])) {
							
								if (!isset($art_stocks_rsv[$stock_liste->getId_stock ()]->qte_livree)) {$art_stocks_rsv[$stock_liste->getId_stock ()]->qte_livree = 0 ;}
								if (!isset($art_stocks_rsv[$stock_liste->getId_stock ()]->qte)) {$art_stocks_rsv[$stock_liste->getId_stock ()]->qte = 0 ;}
								echo qte_format($art_stocks_rsv[$stock_liste->getId_stock ()]->qte - $art_stocks_rsv[$stock_liste->getId_stock ()]->qte_livree) ;
								$tot_res += qte_format($art_stocks_rsv[$stock_liste->getId_stock ()]->qte - $art_stocks_rsv[$stock_liste->getId_stock ()]->qte_livree) ;
							} else {
								echo "0";
							}
							?>
						</td>
						<?php
							if ($article->getLot() == 1) {
						?>
						<td style="text-align:center; width:80px " class="resume_stock_border_top">
						<div style="text-align:center; display:block">
							<?php	
							$max_tofab = 0;
							//print_r ($art_stocks_tofab);
							$countcompo = 0;
							foreach ($art_composants as $composant) {
							
								if (isset($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock) && $art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock > 0) {
								
									if (floor($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte) > 0) {
										if ($max_tofab == 0 && $countcompo == 0) {
											$max_tofab = floor($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte);
											$countcompo = 1;
										}
									}
									if (floor($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte) <= $max_tofab) {
											$max_tofab = floor($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte);
											$countcompo = 1;
									}
									if (floor($art_stocks_tofab[$stock_liste->getId_stock()][$composant->ref_lot_contenu]->qte_stock/$composant->qte) == 0) {
										$max_tofab = 0;
										$countcompo = 1;
									}
								} else {
										$max_tofab = 0;
										$countcompo = 1;
								}
							}
							echo qte_format($max_tofab) ;
							
							$tot_reap += $max_tofab;
							?>
						</td>
						<?php
						} else {
							if ($article->getLot() != 2) {
							?>
							<td style="text-align:center; width:80px " class="resume_stock_border_top">
								<?php	
								if (isset($art_stocks_cdf[$stock_liste->getId_stock ()])) {
									if (!isset($art_stocks_cdf[$stock_liste->getId_stock ()]->qte_recue)) { $art_stocks_cdf[$stock_liste->getId_stock ()]->qte_recue = 0 ;}
									if (!isset($art_stocks_cdf[$stock_liste->getId_stock ()]->qte)) { $art_stocks_cdf[$stock_liste->getId_stock ()]->qte = 0 ;}
									?>
									<?php 
									echo qte_format($art_stocks_cdf[$stock_liste->getId_stock ()]->qte - $art_stocks_cdf[$stock_liste->getId_stock ()]->qte_recue) ;
							$tot_reap += $art_stocks_cdf[$stock_liste->getId_stock ()]->qte - $art_stocks_cdf[$stock_liste->getId_stock ()]->qte_recue ;?>
									<?php
								} else {
									echo "0";
								}
								?>
							</td>
						<?php
						}
					}
					?>
					 <td style="text-align:center; width:80px " class="resume_stock_border_topright">
							<?php	
							if (isset($art_stocks_cdf[$stock_liste->getId_stock ()])) {
								if (isset($art_stocks_cdf[$stock_liste->getId_stock ()]->date_livraison) && $art_stocks_cdf[$stock_liste->getId_stock ()]->date_livraison != "0000-00-00") {
								 echo "&nbsp;(".date_Us_to_Fr($art_stocks_cdf[$stock_liste->getId_stock ()]->date_livraison).")" ;
								}
							}
							?>
							
							</td>
						<td style="text-align:center; width:160px" class="resume_stock_border_topright">
							<input type="text" name="emplacement_stock_<?php echo $stock_liste->getId_stock();?>" id="emplacement_stock_<?php echo $stock_liste->getId_stock();?>" value="<?php
							// Affichage de l'emplacement de l'article dans le stock
							$emplacement_article = "";
							foreach ($article_stocks_alertes as $article_stock_alerte) {
								if ($stock_liste->getId_stock() == $article_stock_alerte->id_stock) {
									$emplacement_article = htmlentities($article_stock_alerte->emplacement);
								} 
							}
							echo $emplacement_article;
						 ?>"  class="classinput_xsize" size="5" style="text-align:center"/>
						
						<input type="hidden" name="emplacement_old_<?php echo htmlentities($stock_liste->getId_stock() );?>" id="emplacement_old_<?php echo htmlentities($stock_liste->getId_stock());?>" value="<?php
							$emplacement_article = "";
							foreach ($article_stocks_alertes as $article_stock_alerte) {
								if ($stock_liste->getId_stock() == $article_stock_alerte->id_stock) {
									$emplacement_article = htmlentities($article_stock_alerte->emplacement);
								} 
							}
							echo $emplacement_article;
						 ?>"  class="classinput_xsize"/> 
							<SCRIPT type="text/javascript">
								Event.observe("emplacement_stock_<?php echo htmlentities($stock_liste->getId_stock ());?>", "blur", function(evt){
									if ($("emplacement_stock_<?php echo htmlentities($stock_liste->getId_stock ());?>").value != $("emplacement_old_<?php echo htmlentities($stock_liste->getId_stock ());?>").value) {
									$("emplacement_old_<?php echo htmlentities($stock_liste->getId_stock ());?>").value = $("emplacement_stock_<?php echo htmlentities($stock_liste->getId_stock ());?>").value;
									maj_emplacement_stock("<?php echo $article->getRef_article ();?>", "<?php echo $stock_liste->getId_stock ();?>", $("emplacement_stock_<?php echo htmlentities($stock_liste->getId_stock ());?>").value);
									}
								}, false);
							</SCRIPT>
						</td>
						
							
						<?php
						if ($art_categs->getModele() == $BDD_MODELES[0] && $article->getLot() != 2)  {
							?>
							<td class="resume_stock_border_top">
							<input type="text" name="stock_<?php echo htmlentities($stock_liste->getId_stock() );?>" id="stock_<?php echo htmlentities($stock_liste->getId_stock());?>" value="<?php
							// Affichage du seuil d'alerte pour cet article dans ce stock
							$seuil_exist = "0";
							foreach ($article_stocks_alertes as $article_stock_alerte) {
								if ($stock_liste->getId_stock() == $article_stock_alerte->id_stock) {$seuil_exist = htmlentities($article_stock_alerte->seuil_alerte);} 
							}
							echo $seuil_exist;
						 ?>"  class="classinput_nsize" size="5" style="text-align:center"/>
							<input type="hidden" name="stock_old_<?php echo htmlentities($stock_liste->getId_stock() );?>" id="stock_old_<?php echo htmlentities($stock_liste->getId_stock());?>" value="<?php
							$seuil_exist = "0";
							foreach ($article_stocks_alertes as $article_stock_alerte) {
								if ($stock_liste->getId_stock() == $article_stock_alerte->id_stock) {$seuil_exist = htmlentities($article_stock_alerte->seuil_alerte);} 
							}
							echo $seuil_exist;
						 ?>"  class="classinput_xsize"/>
							<SCRIPT type="text/javascript">
								Event.observe("stock_<?php echo htmlentities($stock_liste->getId_stock ());?>", "blur", function(evt){
									nummask(evt,"<?php echo $seuil_exist;?>", "X.X");
									if ($("stock_<?php echo htmlentities($stock_liste->getId_stock ());?>").value != $("stock_old_<?php echo htmlentities($stock_liste->getId_stock ());?>").value) {
									$("stock_old_<?php echo htmlentities($stock_liste->getId_stock ());?>").value = $("stock_<?php echo htmlentities($stock_liste->getId_stock ());?>").value;
									maj_stock_alerte ("<?php echo $article->getRef_article ();?>", "<?php echo $stock_liste->getId_stock ();?>", $("stock_<?php echo htmlentities($stock_liste->getId_stock ());?>").value);
									}
								}, false);
							</SCRIPT>						 </td>
						 <?php
						}
						?>
					</tr>
					<?php 
				}
				?><tr style="">
					<td style="text-align:left;" class="resume_stock_border_topright">TOTAL:</td>
		
						<td style="text-align:center" class="resume_stock_border_topright"><?php echo qte_format($tot_const);?></td>
						
					<td style="text-align:center" class="resume_stock_border_topright"><?php echo qte_format($tot_res);?></td>
					
						<td style="text-align:center" class="resume_stock_border_top"><?php echo qte_format($tot_reap);?></td>
						
						<td style="text-align:center" class="resume_stock_border_topright"></td>
						
					<td style="text-align:center" class="resume_stock_border_topright"></td>
				
					<?php
					if ($art_categs->getModele() == $BDD_MODELES[0] && ($article->getLot() != 2) ) {
						?>
						<td style="text-align:center; padding-left:10px; padding-right:10px"></td>
						<?php
					}
					?>
				</tr>
				</table>				</td>
			</tr>
		</table>		<br />

		<table style="width:100%">
			<tr>
			<td>
			<?php 
			if ($article->getLot() != 2 && $article->getVariante() != 2 && $_SESSION['user']->check_permission ("21")) {
				?>
				<div style="text-align:left; padding-left:15px"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_article_inventory.gif" id="inventory_art" style="cursor:pointer" />
				<script type="text/javascript">
				
					Event.observe('inventory_art', "click", function(evt){
							$("pop_up_invetory_article").style.display = "block";
							
							var AppelAjax = new Ajax.Updater(
															"pop_up_invetory_article", 
															"catalogue_articles_view_inventory.php", {
															method: 'post',
															asynchronous: true,
															contentType:  'application/x-www-form-urlencoded',
															encoding:     'UTF-8',
															parameters: { ref_article: "<?php echo $article->getRef_article ();?>" },
															evalScripts:true, 
															onLoading:S_loading, onException: function () {S_failure();}, 
															onComplete:H_loading}
															);
						}
					);
				</script>
				</div>
				<?php
			}
			?>
			</td>
			<td style="width:50%">
			<?php 
			if ($article->getLot() == 1 && $article->getVariante() != 2) {
				?>
				<div style="text-align:left">
				<table>
				<tr>
				<td>
				<span id="go_fab" style="cursor:pointer; text-decoration:underline">Fabriquer</span>
				 <br />ou<br />
				 <span id="go_des" style="cursor:pointer; text-decoration:underline">Désassembler</span>
				</div>
				</td>
				<td><span style=" float:right; line-height:48px; height:48px">
					<input type="text" value="0" size="4" name="qte_go" id="qte_go" /> 
				article(s)</span> 
				</td>
				</tr>
				</table> 
				<SCRIPT type="text/javascript">
					
				Event.observe('qte_go', "blur", function(evt){ 
					nummask(evt,"0", "X");
					Event.stop(evt);
				});
				
				Event.observe('go_fab', "click", function(evt){ 
					if ($("qte_go").value != "0") {
					page.verify('document_nouveau_fab','documents_nouveau.php?fill_content=1&id_type_doc=<?php echo $FABRICATION_ID_TYPE_DOC;?>&ref_article=<?php echo $article->getRef_article ();?>&qte='+$("qte_go").value,'true','sub_content');
					}
					Event.stop(evt);
				});
				
				Event.observe('go_des', "click", function(evt){ 
					if ($("qte_go").value != "0") {
					page.verify('document_nouveau_des','documents_nouveau.php?fill_content=1&id_type_doc=<?php echo $DESASSEMBLAGE_ID_TYPE_DOC;?>&ref_article=<?php echo $article->getRef_article ();?>&qte='+$("qte_go").value,'true','sub_content');
					}
					Event.stop(evt);
				});
				</SCRIPT>

				<?php
			}
			?><?php
			if ($article->getLot() == 3 && $article->getVariante() != 2) {
				?>
				<div style="text-align:left">   
				 <span id="go_des" style="cursor:pointer; text-decoration:underline">Désassembler</span>
				</div>
				<SCRIPT type="text/javascript">
					
				
				Event.observe('go_des', "click", function(evt){ 
					$("pop_up_invetory_article").style.display = "block";
					
					var AppelAjax = new Ajax.Updater(
													"pop_up_invetory_article", 
													"catalogue_articles_view_desassemblage.php", {
													method: 'post',
													asynchronous: true,
													contentType:  'application/x-www-form-urlencoded',
													encoding:     'UTF-8',
													parameters: { ref_article: "<?php echo $article->getRef_article ();?>", id_type_doc : '<?php echo $DESASSEMBLAGE_ID_TYPE_DOC;?>', fill_content: '1' },
													evalScripts:true, 
													onLoading:S_loading, onException: function () {S_failure();}, 
													onComplete:H_loading}
													);
				
					Event.stop(evt);
				});
				</SCRIPT>

				<?php
			}
			?>
			</td>
		</tr>
		</table>
		</td>
		<td>
			<table style="width:100%" border="0">
				<tr>
					<td style="width:2%">&nbsp;</td>
					<td style="width:20%">&nbsp;</td>
					<td style="width:20%">&nbsp;</td>
					<td style="width:2%">&nbsp;</td>
				</tr>
				<tr>
					<td >&nbsp;</td>
					<td colspan="2" align="left">
						<span id="article_commandes_en_cours" style=" color:#f28f4e; font:9px Arial, Helvetica, sans-serif; font-weight:bolder; text-align:center; cursor:pointer;" >
							&gt;&gt; Voir les commandes en cours pour cet article
						</span>
						
						<script type="text/javascript">
							Event.observe("article_commandes_en_cours", "click", function(){
								page.verify('affaires_affiche_fiche','index.php#'+escape('catalogue_articles_view_cdc_en_cours.php?ref_article=<?php echo $article->getRef_article(); ?>'),'true','_blank');
							}, false);
						</script>
					</td>
					<td >&nbsp;</td>
				</tr>
				<tr>
					<td >&nbsp;</td>
					<td colspan="2" align="left">
						<span id="article_ordres_de_livraison" style=" color:#f28f4e; font:9px Arial, Helvetica, sans-serif; font-weight:bolder; text-align:center; cursor:pointer;" >
							&gt;&gt; Voir les ordres de livraison pour cet article
						</span>
						<br />
						
						<script type="text/javascript">
							Event.observe("article_ordres_de_livraison", "click", function(){
								page.verify('affaires_affiche_fiche','index.php#'+escape('catalogue_articles_view_blc_pret_au_depart.php?ref_article=<?php echo $article->getRef_article(); ?>'),'true','_blank');
							}, false);
						</script>
					</td>
					<td >&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="labelled_text"><span id="art_lib_code_barre" <?php if  ($article->getVariante () == 2) {?> style="display:none;"<?php } ?>>Code barre: </span></td>
					<td><input type="text" name="code_barre" id="code_barre" value="" class="classinput_xsize" <?php if  ($article->getVariante () == 2) {?> style="display:none;"<?php } ?>/></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="2">
					<div id="liste_codes_barres" <?php if  ($article->getVariante () == 2) {?> style="display:none;"<?php } ?>>
						<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_articles_edition_code_barre.inc.php" ?>
					</div>			</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />
<br />

<ul id="menu_recherche" class="menu" style="border-top:1px solid #000000">
<?php 
$i = 0;
foreach ($_SESSION['stocks'] as $stock) {
	?>
	<li id="stock_move_<?php echo $i;?>">
		<a href="#" id="stock_move_menu_<?php echo $i;?>" class="menu_<?php if ($stock->getId_stock() != $_SESSION['magasin']->getId_stock()) {echo "un";}?>select"><?php echo htmlentities($stock->getLib_stock());?></a>
	</li>
	<?php
	$i++;
}
if (count($_SESSION['stocks']) > 1) {
	?>
	<li id="stock_move_<?php echo $i;?>">
		<a href="#" id="stock_move_menu_<?php echo $i;?>" class="menu_<?php if ($i != 0) {echo "un";}?>select">Tous</a>
	</li>
	<?php
	}
?>
</ul>
<div id="stock_moves_liste">
<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_articles_view_stock_moves.inc.php"; ?>
</div>

</div>


<SCRIPT type="text/javascript">


<?php 
$i = 0;
foreach ($_SESSION['stocks'] as $stock) {
	?>
	Event.observe('stock_move_menu_<?php echo $i;?>', "click", function(evt){
		view_menu_1('stock_moves_liste', 'stock_move_menu_<?php echo $i;?>', array_menu_sm);  
		page.verify("catalogue_articles_view_stocks_moves","catalogue_articles_view_stocks_moves.php?id_stock=<?php echo $stock->getId_stock();?>&ref_article=<?php echo $article->getRef_article ();?>","true","stock_moves_liste");
		Event.stop(evt);
});
	<?php
	$i++; 
}
if (count($_SESSION['stocks']) > 1) {
?>
Event.observe('stock_move_menu_<?php echo $i;?>', "click", function(evt){
	view_menu_1('stock_moves_liste', 'stock_move_menu_<?php echo $i;?>', array_menu_sm);  
	page.verify("catalogue_articles_view_stocks_moves","catalogue_articles_view_stocks_moves.php?ref_article=<?php echo $article->getRef_article ();?>&id_stock=","true","stock_moves_liste");
	Event.stop(evt);
});
	<?php
}
?>


//observer le focus sur le codebarrepour le vider
Event.observe('code_barre', "focus", function(evt){$("code_barre").value="";;});


//observer le retour chariot lors de la saisie du code barre pour lancer la recherche
function add_code_barre_if_Key_RETURN (evt) {

	var id_field = Event.element(evt);
	var field_value = id_field.value;
	var key = evt.which || evt.keyCode; 
	switch (key) {   
	case Event.KEY_RETURN:     
	
	Event.stop(evt);
	var AppelAjax = new Ajax.Updater(
									"liste_codes_barres", 
									"catalogue_articles_edition_code_barre_add.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { code_barre: field_value, ref_article: "<?php echo $article->getRef_article ();?>" },
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	break;   
	}
}

Event.observe('code_barre', "keypress", function(evt){add_code_barre_if_Key_RETURN (evt);});




//on masque le chargement
H_loading();
</SCRIPT>