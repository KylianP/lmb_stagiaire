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
<div style="width:100%;">
<div style="padding:5px;">



<table style="width:100%">
		<tr>
			<td>
			<table style="width:100%">
			<tr>
			<td style="width:40%">
			</td>
			<td>
				<?php 
				$montant_acquite = 0;
				if (isset($liste_reglements)) {
					foreach ($liste_reglements as $liste_reglement) {
						if ($liste_reglement->valide) {
						$montant_acquite += $liste_reglement->montant_on_doc;
						}
					}
				}
				?>
				 <table style="width:550px; " class="doc_reglement_toto" cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="5" style="text-align:center">
							<div class="montant_due">
								<span id="montant_total_reglement2"> </span>
								<?php echo $MONNAIE[1]; ?>
							</div>
							</td>
						</tr>
					<?php 
						if (!isset($liste_reglements) || !$liste_reglements) {?>
							<tr>
								<td colspan="5" style="text-align:center">
								<span style="font-size:9px; font-style:italic;">Aucun r&egrave;glement enregistr&eacute;.</span>
								</td>
							</tr>
							<?php
						} else {?>
							<tr>
								<td colspan="5" style="text-align:left; background-color:#d2d2d2 ">
								<span style="font-size:12px; padding-left:3px">R&egrave;glements effectu&eacute;s</span>
								</td>
							</tr>
						<?php
						foreach ($liste_reglements as $liste_reglement) {
						?>
						<tr id="ligne_reglement_<?php echo $liste_reglement->ref_reglement;?>" class="<?php if ($liste_reglement->valide) {echo "reglement_line_valide";} else {echo "reglement_line_unvalide";}?>">
							<td style=" text-align:center; font-size:10px; border-bottom:1px solid #d2d2d2; border-left:1px solid #d2d2d2; "> le :
							<?php 
							if ($liste_reglement->date_reglement!= 0000-00-00) {
								echo htmlentities ( date_Us_to_Fr ($liste_reglement->date_reglement));
							}
							?>
							</td>
							<td style=" text-align:center; font-size:10px; border-bottom:1px solid #d2d2d2;">
							<?php echo htmlentities(number_format($liste_reglement->montant_on_doc, $TARIFS_NB_DECIMALES, ".", ""	))." ".$MONNAIE[1]; ?> / 
							<?php echo htmlentities(number_format($liste_reglement->montant_reglement, $TARIFS_NB_DECIMALES, ".", ""	)); ?> r&eacute;gl&eacute;
							</td>
							<td style=" text-align:left; padding-left:10px; font-size:10px; width:20%;border-bottom:1px solid #d2d2d2;">
							<?php echo htmlentities($liste_reglement->lib_reglement_mode); ?>
							</td>
							<td style=" text-align:center; font-size:10px; border-bottom:1px solid #d2d2d2;">
							<img id="open_edit_reglement_<?php echo $liste_reglement->ref_reglement;?>" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-modifier.gif" style="cursor:pointer" />
							</td>
							<td style=" text-align:right; padding-right:10px; font-size:10px; width:20%; border-right:1px solid #d2d2d2; border-bottom:1px solid #d2d2d2;">
								<form method="post" action="documents_reglements_sup.php" id="documents_reglements_sup_<?php echo $liste_reglement->ref_reglement; ?>" name="documents_reglements_sup_<?php echo $liste_reglement->ref_reglement; ?>" target="formFrame">
								<input name="ref_reglement" id="ref_reglement" type="hidden" value="<?php echo $liste_reglement->ref_reglement; ?>" />
								<input name="ref_doc_<?php echo $liste_reglement->ref_reglement; ?>" id="ref_doc_<?php echo $liste_reglement->ref_reglement; ?>" type="hidden" value="<?php echo $document->getRef_doc () ?>" />
								</form>
								<a href="#" id="link_documents_reglements_delier_<?php echo $liste_reglement->ref_reglement; ?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/unlink.gif" border="0"></a>
								<a href="#" id="link_documents_reglements_sup_<?php echo $liste_reglement->ref_reglement; ?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0"></a>
								<script type="text/javascript">
								Event.observe("link_documents_reglements_sup_<?php echo $liste_reglement->ref_reglement; ?>", "click",  function(evt){
									Event.stop(evt); alerte.confirm_supprimer('documents_reglements_sup', 'documents_reglements_sup_<?php echo $liste_reglement->ref_reglement; ?>');
									}, false);
								Event.observe("link_documents_reglements_delier_<?php echo $liste_reglement->ref_reglement; ?>", "click",  function(evt){
									Event.stop(evt);
									delier_doc_reglement ('<?php echo $document->getRef_doc();?>', '<?php echo $liste_reglement->ref_reglement;?>', '', '');
									 }, false);
								</script>
							
							<SCRIPT type="text/javascript">
							Event.observe("open_edit_reglement_<?php echo $liste_reglement->ref_reglement;?>", "click", function(evt){
							page.traitecontent('compta_reglements_edition','compta_reglements_edition.php?ref_reglement=<?php echo $liste_reglement->ref_reglement;?>&ref_doc=<?php echo $document->getRef_doc();?>','true','edition_reglement');
							$("edition_reglement").show();
							$("edition_reglement_iframe").show();
							}, false);
							</SCRIPT>
							</td>
						</tr>
						<?php
					}
					?>
							<tr id="reglement_done2" style="display:none">
								<td colspan="4" style="text-align:left; border-left:1px solid #d2d2d2; border-bottom:1px solid #d2d2d2;">
									<span style="font-size:10px; font-style:italic; padding-left:10px; color:#FF0000">R&egrave;glement complet effectu&eacute;</span>								</td>
								<td style=" text-align:right; padding-right:10px; font-size:10px; color:#FF0000; border-right:1px solid #d2d2d2; border-bottom:1px solid #d2d2d2;">
								</td>
							</tr>
							<?php
						}
						?>
							<tr id="reglement_partiel2" style="display:none">
								<td colspan="2" style="text-align:left; border-left:1px solid #d2d2d2; border-bottom:1px solid #d2d2d2;">
									<span style="font-size:10px; font-style:italic; padding-left:10px; color:#FF0000">Montant restant &agrave; r&eacute;gler:</span>								</td>
								<td style=" text-align:center; padding-right:10px; font-size:10px; color:#FF0000; border-bottom:1px solid #d2d2d2;">
									<span id="montant_due2"></span> <?php echo $MONNAIE[1]; ?>
								</td>	
								<td style="border-bottom:1px solid #d2d2d2;">
								</td>
								<td style="border-right:1px solid #d2d2d2; border-bottom:1px solid #d2d2d2;">
						<span id="montant_acquite2" style="display:none"><?php echo $montant_acquite?></span>
								</td>
							</tr>
				</table>
				</td>
				<td style="width:40%">
				</td>
				</tr>
				</table>
				</td>
			</tr>
		</table>
		<table style="width:100%" id="reglements_types">
		<tr>
		<td style="text-align:center">
		<form action="documents_reglements_mode_valid.php" method="post" id="new_reglement" name="new_reglement" target="formFrame" >
		<input id="docs_<?php echo $document->getRef_doc(); ?>" name="docs_<?php echo $document->getRef_doc(); ?>" value="<?php echo $document->getRef_doc(); ?>" type="hidden" />
		<input id="doc_ACCEPT_REGMT" name="doc_ACCEPT_REGMT" value="<?php echo $document->getACCEPT_REGMT(); ?>" type="hidden" />
		<div style="display:none" id="docs_liste"></div>
		<div style="display:block; text-align:center;" id="reglement_choix_type">
			<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_documents_reglements_choix.inc.php" ?>
		</div>
		</form>
		<?php if ($document->getId_type_doc() == $FACTURE_CLIENT_ID_TYPE_DOC || $document->getId_type_doc() == $FACTURE_FOURNISSEUR_ID_TYPE_DOC) { ?>
		<a hef="#" id="cree_avoir" style="display:none; cursor:pointer; text-decoration:none">
			<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_generer_avoir.gif" border="0" style="padding:5px"/>
		</a>
		<script type="text/javascript">
		Event.observe('cree_avoir', "click", function(evt){
			Event.stop(evt);
			cree_avoir("<?php echo $document->getRef_doc(); ?>");
		});
		</script>
		<?php } ?>
		</td>
		</tr>
		</table>
		<div style="display:block; text-align:center;" id="liste_docs_nonreglees">
<?php if (!isset($load)) {?>
			<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_documents_reglements_liste_docs_nonreglees.inc.php" ?>
<?php } ?>
		</div>
		
					
<script type="text/javascript">

<?php 
if (!isset($load)) {?>
montant_total_neg = false;
document_calcul_tarif ();
//on masque le chargement
H_loading();
<?php } ?>

</script>
</div>
</div>