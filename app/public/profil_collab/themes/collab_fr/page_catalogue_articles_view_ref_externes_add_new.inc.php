<span style="font-weight:bolder">Ajout d'un fournisseur. (gestion des r�f�rences fournisseurs)</span><br />

<form action="catalogue_articles_view_ref_externes_add_new_valid.php" target="formFrame" method="post" name="catalogue_articles_view_ref_externes_add_new_valid" id="catalogue_articles_view_ref_externes_add_new_valid">
<input type="hidden" name="ref_article" value="<?php echo $article->getRef_article ();?>" />
<table width="100%" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
	<tr>
		<td style="width:20%" class="composant_titre_lib">Fournisseur</td>
		<td style="width:20%" class="composant_titre_lib">R�f fournisseur</td>
		<td style="width:20%" class="composant_titre_lib">Libell�</td>
		<td style="width:20%" class="composant_titre_lib">Prix&nbsp;d'achat&nbsp;HT</td>
		<td style="width:20%" class="composant_titre_lib">Date</td>
	</tr>
	<tr>
		<td colspan="7" style="width:100%">
		</td>
	</tr>
	<tr>
		<td style="" class="composant_titre_qte"><span id="nom_fournisseur"></span>
		
			<input name="ref_fournisseur" id="ref_fournisseur" type="hidden" value=""/>
			<table cellpadding="0" cellspacing="0" border="0" style=" width:100%">
						<tr>
							<td>
							<input name="nom_ref_fournisseur" id="nom_ref_fournisseur" type="text" value=""  class="classinput_xsize" readonly=""/>
							</td>
							<td style="width:20px">
							<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif"/ style="float:right; cursor:pointer" id="ref_fourn_select_img">
							</td>
						</tr>
					</table>
					
				<script type="text/javascript">
		//effet de survol sur le faux select
			Event.observe('ref_fourn_select_img', 'mouseover',  function(){$("ref_fourn_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_hover.gif";}, false);
			Event.observe('ref_fourn_select_img', 'mousedown',  function(){$("ref_fourn_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_down.gif";}, false);
			Event.observe('ref_fourn_select_img', 'mouseup',  function(){$("ref_fourn_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
			
			Event.observe('ref_fourn_select_img', 'mouseout',  function(){$("ref_fourn_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
			Event.observe('ref_fourn_select_img', 'click',  function(evt){Event.stop(evt); show_mini_moteur_contacts ("recherche_compte_b_set_contact", "\'ref_fournisseur\', \'nom_ref_fournisseur\' "); preselect ('<?php echo $FOURNISSEUR_ID_PROFIL; ?>', 'id_profil_m'); page.annuaire_recherche_mini();}, false);
				</script>
		</td>
		<td style="" class="composant_titre_lib">
			<input name="ref_article_externe" id="ref_article_externe" type="text" value="" class="classinput_xsize" />
		</td>
		<td style="" class="composant_titre_lib">
			<input name="lib_article_externe" id="lib_article_externe" type="text" value="" class="classinput_xsize" />
		</td>
		<td style="" class="composant_titre_lib">
		<span  <?php //permission (6) Acc�s Consulter les prix d�achat
if (!$_SESSION['user']->check_permission ("6")) {?>style="display:none;"<?php } ?> >
			<input name="pa_unitaire" id="pa_unitaire" type="text" value="0" class="classinput_xsize" />
			</span>
		</td>
		<td style="" class="composant_titre_lib">
			<input name="date_pa" id="date_pa" type="text" value="" class="classinput_xsize" />
		</td>
	</tr>
	<tr>
		<td colspan="7" style="text-align:right">
		<input type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-valider.gif"  />
		</td>
	</tr>
</table>
</form>

<script type="text/javascript">

Event.observe('pa_unitaire', "blur", function(evt){
	nummask(evt, 0, "X.XY");
});
Event.observe('date_pa', "blur", function(evt){
	datemask(evt);
});
</script>