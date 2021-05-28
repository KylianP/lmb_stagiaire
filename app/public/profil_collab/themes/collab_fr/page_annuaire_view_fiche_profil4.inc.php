

<table style="width:100%">
<tr>
<td>
<div>
<form method="post" action="annuaire_edition_profil_suppression.php" id="annu_edition_profil4_suppression" name="annu_edition_profil4_suppression" target="formFrame">
<input type="hidden" name="ref_contact" value="<?php echo $contact->getRef_contact()?>">
<input type="hidden" name="id_profil" value="<?php echo $id_profil?>">
</form>
<p class="sous_titre1">Informations client </p>
<div class="reduce_in_edit_mode">
<form method="post" action="annuaire_edition_profil.php" id="annu_edition_profil4" name="annu_edition_profil4" target="formFrame" style="display:none;">
<input type="hidden" name="ref_contact" value="<?php echo $contact->getRef_contact()?>">
<input type="hidden" name="id_profil" value="<?php echo $id_profil?>">
	<table class="minimizetable">
		<tr class="smallheight">
			<td class="size_strict"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>	
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Cat&eacute;gorie de client:</span>
			</td>
			<td>
				<select  id="id_client_categ"  name="id_client_categ" class="classinput_xsize">
				<?php
				$id_client_categ = "";
				foreach ($liste_categories_client as $liste_categorie_client){
					?>
					<option value="<?php echo $liste_categorie_client->id_client_categ;?>" <?php if ($profils[$id_profil]->getId_client_categ () == $liste_categorie_client->id_client_categ) {echo 'selected="selected"'; $id_client_categ =  htmlentities($liste_categorie_client->lib_client_categ);}?>>
					<?php echo htmlentities($liste_categorie_client->lib_client_categ)?></option>
					<?php 
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Type de client:</span>
			</td>
			<td>
			<select  id="type_client"  name="type_client" class="classinput_xsize">
				<option value="piste" <?php $type_client = ""; if ($profils[$id_profil]->getType_client() == "piste") {echo 'selected="selected"';$type_client = "Piste";} ?>>Piste</option>
				<option value="prospect" <?php if ($profils[$id_profil]->getType_client() == "prospect") {echo 'selected="selected"';$type_client =  $profils[$id_profil]->getType_client();} ?>>Prospect</option>
				<option value="client" <?php if ($profils[$id_profil]->getType_client() == "client") {echo 'selected="selected"';$type_client =  $profils[$id_profil]->getType_client();} ?>>Client</option>
				<option value="ancien client" <?php if ($profils[$id_profil]->getType_client() == "ancien client") {echo 'selected="selected"';$type_client =  $profils[$id_profil]->getType_client();} ?>>Ancien client</option>
			</select>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Commercial:</span>
			</td>
			<td>
				<input name="ref_commercial" id="ref_commercial" type="hidden" value="<?php echo $profils[$id_profil]->getRef_commercial();?>" />
					<table cellpadding="0" cellspacing="0" border="0" style=" width:100%">
						<tr>
							<td>
							<input name="nom_commercial" id="nom_commercial" type="text" value="<?php echo $profils[$id_profil]->getNom_commercial();?>"  class="classinput_lsize" readonly="" />
							</td>
							<td style="width:20px">
							<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif"/ style="float:right; cursor:pointer" id="ref_commercial_select_img">
							</td>
							<td style="width:20px">
							<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif"/ style=" cursor:pointer" id="ref_commercial_empty_s">
							
							<script type="text/javascript">
							Event.observe('ref_commercial_empty_s', 'click',  function(evt){Event.stop(evt); 
							$("ref_commercial").value = "";
							$("nom_commercial").value = "";
							}, false);
							</script>
							</td>
						</tr>
					</table>
					
				<script type="text/javascript">
				//effet de survol sur le faux select
					Event.observe('ref_commercial_select_img', 'mouseover',  function(){$("ref_commercial_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_hover.gif";}, false);
					Event.observe('ref_commercial_select_img', 'mousedown',  function(){$("ref_commercial_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_down.gif";}, false);
					Event.observe('ref_commercial_select_img', 'mouseup',  function(){$("ref_commercial_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
					
					Event.observe('ref_commercial_select_img', 'mouseout',  function(){$("ref_commercial_select_img").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
					Event.observe('ref_commercial_select_img', 'click',  function(evt){Event.stop(evt); show_mini_moteur_contacts ("recherche_client_set_contact", "\'ref_commercial\', \'nom_commercial\' "); preselect ('<?php echo $COMMERCIAL_ID_PROFIL; ?>', 'id_profil_m'); page.annuaire_recherche_mini();}, false);
				</script>
				
				
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Grille tarifaire:</span>
			</td>
			<td>
			<select id="id_tarif" name="id_tarif" class="classinput_xsize">
				<option value="">Automatique</option>
				<?php 
				$id_client_tarif = "Automatique";
				foreach ($tarifs_liste as $tarif_liste) {
					?>
					<option value="<?php echo $tarif_liste->id_tarif; ?>" <?php if ($profils[$id_profil]->getId_tarif () == $tarif_liste->id_tarif) {echo 'selected="selected"'; $id_client_tarif =  htmlentities($tarif_liste->lib_tarif);}?>><?php echo htmlentities($tarif_liste->lib_tarif); ?>
					</option>
					<?php 
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Adresse de Livraison:</span>
			</td><td>
			<div style="position:relative; top:0px; left:0px; width:100%; height:0px;">
			<iframe id="iframe_liste_choix_adresse_livraison" frameborder="0" scrolling="no" src="about:_blank"  class="choix_liste_choix_coordonnee" style="display:none"></iframe>
			<div id="choix_liste_choix_adresse_livraison"  class="choix_liste_choix_coordonnee" style="display:none"></div></div>
			<div id="adresse_livraison_choisie" class="simule_champs" style="width:99%;cursor: default;">
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select.gif"/ style="float:right" id="bt_adresse_livraison_choisie">
				<span id="lib_adresse_livraison_choisie"><?php echo getLib_adresse($profils[$id_profil]->getRef_adr_livraison ())?></span>
			</div>
			<input name="ref_adr_livraison" id="ref_adr_livraison" type="hidden" class="classinput_xsize" value="<?php echo htmlentities($profils[$id_profil]->getRef_adr_livraison ()); ?>" />
							
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Adresse de Facturation:</span>
			</td><td>
			<div style="position:relative; top:0px; left:0px; width:100%; height:0px;">
			<iframe id="iframe_liste_choix_adresse_facturation" frameborder="0" scrolling="no" src="about:_blank"  class="choix_liste_choix_coordonnee" style="display:none"></iframe>
			<div id="choix_liste_choix_adresse_facturation"  class="choix_liste_choix_coordonnee" style="display:none"></div></div>
			<div id="adresse_facturation_choisie" class="simule_champs" style="width:99%;cursor: default;">
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select.gif"/ style="float:right" id="bt_adresse_facturation_choisie">
				<span id="lib_adresse_facturation_choisie"><?php echo getLib_adresse($profils[$id_profil]->getRef_adr_facturation ())?></span>
			</div>
			<input name="ref_adr_facturation" id="ref_adr_facturation" type="hidden" class="classinput_xsize" value="<?php echo htmlentities($profils[$id_profil]->getRef_adr_facturation ()); ?>" />
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Afficher Tarifs:</span>
			</td><td>
			<select id="app_tarifs" name="app_tarifs" class="classinput_xsize">
				<option value="">Automatique</option>
				<option value="HT" <?php if ($profils[$id_profil]->getApp_tarifs () == "HT") {echo 'selected="selected"';}?>>HT</option>
				<option value="TTC" <?php if ($profils[$id_profil]->getApp_tarifs () == "TTC") {echo 'selected="selected"';}?>>TTC</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Facturation p&eacute;riodique:</span>
			</td>
			<td>
			<select id="factures_par_mois" name="factures_par_mois" class="classinput_xsize">
			<?php 
			foreach ($FACTURES_PAR_MOIS as $key=>$valeur) {
			 	?>
				<option value="<?php echo $key;?>" <?php if ($profils[$id_profil]->getFactures_par_mois () == $key) {echo 'selected="selected"';}?>><?php echo $valeur;?></option>
				<?php
				}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Encours:</span>
			</td>
			<td>
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td style="width:80px">
			<input id="encours" name="encours" class="classinput_lsize"type="text" value="<?php echo htmlentities($profils[$id_profil]->getEncours ()); ?>" size="4"/>
						</td>
						<td> <?php echo $MONNAIE[1];?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">D&eacute;lai de r&egrave;glement des factures:</span>
			</td>
			<td>
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td style="width:80px">
						<input name="delai_reglement" id="delai_reglement" type="text" value="<?php echo htmlentities($profils[$id_profil]->getDelai_reglement ()); ?>"  class="classinput_lsize" size="4"/>
						</td>
						<td> jour(s)
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<p style="text-align:center">
	<input type="image" name="profsubmit<?php echo $id_profil?>" id="profsubmit<?php echo $id_profil?>"  src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-valider.gif"/>
	</p>
	</form>
	
	<table class="minimizetable"  id="start_visible_profil<?php echo $id_profil?>">
		<tr class="smallheight">
			<td class="size_strict"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>	
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Cat&eacute;gorie de client:</span>
			</td>
			<td>
			<a href="#" id="show4_id_client_categ" class="modif_select1"><?php echo  ($id_client_categ)?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Type de client:</span>
			</td>
			<td>
			<a href="#" id="show4_type_client" class="modif_select1"><?php echo  ($type_client)?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Commercial:</span>
			</td>
			<td>
				<a href="#" id="show4_ref_commercial" class="modif_input1"><?php echo $profils[$id_profil]->getNom_commercial();?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Grille tarifaire:</span>
			</td>
			<td>
			<a href="#" id="show4_id_tarif" class="modif_select1"><?php echo  ($id_client_tarif)?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Adresse de Livraison:</span>
			</td>
			<td>
			<a href="#" id="show4_adresse_livraison_choisie" class="modif_input1"><?php echo  htmlentities( getLib_adresse($profils[$id_profil]->getRef_adr_livraison ()))?></a>
				</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Adresse de Facturation:</span>
			</td>
			<td>
			<a href="#" id="show4_adresse_facturation_choisie" class="modif_input1"><?php echo  htmlentities( getLib_adresse($profils[$id_profil]->getRef_adr_facturation ()))?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Tarifs:</span>
			</td>
			<td>
			<a href="#" id="show4_app_tarifs" class="modif_input1"><?php echo  htmlentities($profils[$id_profil]->getApp_tarifs ())?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Facturation p&eacute;riodique:</span>
			</td>
			<td>
			<a href="#" id="show4_factures_par_mois" class="modif_input1">
			 <?php 
			 foreach ($FACTURES_PAR_MOIS as $key=>$valeur) {
			 	?>
				<?php if ($profils[$id_profil]->getFactures_par_mois () == $key) {echo $valeur;}?>
				<?php
				}
			?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Encours autoris&eacute;:</span>
			</td>
			<td>
			<a href="#" id="show4_encours" class="modif_input1"><?php echo  htmlentities($profils[$id_profil]->getEncours ())?> <?php echo $MONNAIE[1];?></a>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">D&eacute;lai de r&egrave;glement des factures:</span>
			</td>
			<td>
				<a href="#" id="show4_delai_reglement" class="modif_input1"><?php echo  htmlentities($profils[$id_profil]->getDelai_reglement ())?> jour(s)</a>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">
			 <img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-modifier.gif" style="cursor:pointer" id="modifier_profil<?php echo $id_profil?>" />
			</td>
		</tr>
	</table>
<script type="text/javascript" language="javascript">
Event.observe("modifier_profil<?php echo $id_profil?>", "click",  function(evt){
	Event.stop(evt); 
	$('annu_edition_profil<?php echo $id_profil?>').toggle();
	$('start_visible_profil<?php echo $id_profil?>').toggle();
}, false);

Event.observe("show4_delai_reglement", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','delai_reglement');}, false);
Event.observe("show4_encours", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','encours');}, false);
Event.observe("show4_factures_par_mois", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','factures_par_mois');}, false);
Event.observe("show4_app_tarifs", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','app_tarifs');}, false);
Event.observe("show4_adresse_facturation_choisie", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','adresse_facturation_choisie');}, false);
Event.observe("show4_adresse_livraison_choisie", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','adresse_livraison_choisie');}, false);
Event.observe("show4_id_tarif", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','id_tarif');}, false);
Event.observe("show4_id_client_categ", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','id_client_categ');}, false);
Event.observe("show4_type_client", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','type_client');}, false);
Event.observe("show4_ref_commercial", "click",  function(evt){Event.stop(evt); show_edit_form('annu_edition_profil<?php echo $id_profil?>', 'start_visible_profil<?php echo $id_profil?>','nom_comm');}, false);

//chargement en cas de changement de client_categ des champs correspondannt
Event.observe("id_client_categ", "change", function(evt){ annu_client_categ_preselect ($("id_client_categ").value);}, false);	

new Form.EventObserver('annu_edition_profil<?php echo $id_profil?>', function(element, value){formChanged();});

//masque numérique pour l'encours
Event.observe("encours", "blur", function(evt){ nummask(evt, "0", "X");}, false);	
//masque numérique pour le délai de règlement
Event.observe("delai_reglement", "blur", function(evt){ nummask(evt, "0", "X");}, false);	
//fonction de choix de adresses

//effet de survol sur le faux select adresse_livraison
	Event.observe('adresse_livraison_choisie', 'mouseover',  function(){$("bt_adresse_livraison_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select_hover.gif";}, false);
	Event.observe('adresse_livraison_choisie', 'mousedown',  function(){$("bt_adresse_livraison_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select_down.gif";}, false);
	Event.observe('adresse_livraison_choisie', 'mouseup',  function(){$("bt_adresse_livraison_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select.gif";}, false);
	Event.observe('adresse_livraison_choisie', 'mouseout',  function(){$("bt_adresse_livraison_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select.gif";}, false);
					
//effet de survol sur le faux select adresse_facturation
	Event.observe('adresse_facturation_choisie', 'mouseover',  function(){$("bt_adresse_facturation_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select_hover.gif";}, false);
	Event.observe('adresse_facturation_choisie', 'mousedown',  function(){$("bt_adresse_facturation_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select_down.gif";}, false);
	Event.observe('adresse_facturation_choisie', 'mouseup',  function(){$("bt_adresse_facturation_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select.gif";}, false);
	Event.observe('adresse_facturation_choisie', 'mouseout',  function(){$("bt_adresse_facturation_choisie").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-arrow_select.gif";}, false);
					
//affichage des choix
	Event.observe('adresse_livraison_choisie', 'click',  function(evt){Event.stop(evt); start_adresse ("<?php echo $contact->getRef_contact()?>", "lib_adresse_livraison_choisie", "ref_adr_livraison", "choix_liste_choix_adresse_livraison", "iframe_liste_choix_adresse_livraison", "annuaire_liste_choix_adresse.php");}, false);
					
	Event.observe('adresse_facturation_choisie', 'click',  function(evt){Event.stop(evt); start_adresse ("<?php echo $contact->getRef_contact()?>", "lib_adresse_facturation_choisie", "ref_adr_facturation", "choix_liste_choix_adresse_facturation", "iframe_liste_choix_adresse_facturation", "annuaire_liste_choix_adresse.php");}, false);
					
//on masque le chargement
H_loading();


//affichage de la liste des boutons des documents client
$("liste_document_client").show();
</script>
</div>
</div>
<br />
<?php
if ($USE_COTATIONS){
?>
<div style="padding-left:10px">
	<a href="#" id="show_cotations" class="common_link">Cotations en cours pour ce contact</a>
	<SCRIPT type="text/javascript">
	Event.observe("show_cotations", "click",  function(evt){Event.stop(evt); page.verify('annuaire_edition_view_cotations','index.php#'+escape('annuaire_edition_view_cotations.php?ref_contact=<?php echo $_REQUEST["ref_contact"];?>'),'true','_blank');}, false);
	</script>
</div>
<?php
}
?>
<br>
<p class="sous_titre2">	Documents en cours:</p>
<?php
$first_docs = 0;
if (count($client_last_DEV_en_cours )) {
	?>

Devis en cours:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_DEV_en_cours as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_DEV_en_cours" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des Devis en cours </div><br />
	<script type="text/javascript">
	Event.observe('show_all_DEV_en_cours', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=1&id_type_doc=1&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?>
<?php
$first_docs = 0;
if (count($client_last_CDC_en_cours )) {
	?>

Commandes en cours:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_CDC_en_cours as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_CDC_en_cours" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des Commandes en cours </div><br />
	<script type="text/javascript">
	Event.observe('show_all_CDC_en_cours', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=1&id_type_doc=2&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?><?php
$first_docs = 0;
if (count($client_last_BLC_en_cours )) {
	?>

Bons de Livraisons en cours:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_BLC_en_cours as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_BLC_en_cours" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des Bons de livraisons en cours </div><br />
	<script type="text/javascript">
	Event.observe('show_all_BLC_en_cours', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=1&id_type_doc=3&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?>
<?php
$first_docs = 0;
if (count($client_last_FAC_en_cours )) {
	?>

Factures en cours:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_FAC_en_cours as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_en_cours_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_en_cours_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_FAC_en_cours" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des Factures en cours </div><br />
	<script type="text/javascript">
	Event.observe('show_all_FAC_en_cours', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=1&id_type_doc=4&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?>
<p class="sous_titre2">	Documents en archive:</p>
<?php
$first_docs = 0;
if (count($client_last_DEV_archive )) {
	?>
Devis en archive:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_DEV_archive as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_DEV_archive" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des devis en archive </div><br />
	<script type="text/javascript">
	Event.observe('show_all_DEV_archive', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=0&id_type_doc=1&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?>
<?php
$first_docs = 0;
if (count($client_last_CDC_archive )) {
	?>
Commandes en archive:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_CDC_archive as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_CDC_archive" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des Commandes en archive </div><br />
	<script type="text/javascript">
	Event.observe('show_all_CDC_archive', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=0&id_type_doc=2&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?>
<?php
$first_docs = 0;
if (count($client_last_BLC_archive )) {
	?>
Bons de commandes en archive:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_BLC_archive as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_BLC_archive" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des Bons de commandes en archive </div><br />
	<script type="text/javascript">
	Event.observe('show_all_BLC_archive', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=0&id_type_doc=3&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?>
<?php
$first_docs = 0;
if (count($client_last_FAC_archive )) {
	?>
Factures en archive:
<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-top:1px solid #93bad7; border-right:1px solid #93bad7;">
	<tr class="smallheight" style="background-color:#93bad7;">
		<td style="width:85px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style=" border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:120px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:100px; border-right:1px solid #FFFFFF;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
	</tr>
	<tr style="background-color:#93bad7;">
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Date</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Document</td>
		<td style=" border-right:1px solid #FFFFFF; text-align:left; padding-left:5px">Etat</td>
		<td style=" border-right:1px solid #FFFFFF;text-align:center; padding-left:5px">Prix</td>
		<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="25px" height="1"/></td>
	</tr>
	</table>
	<?php
	foreach ($client_last_FAC_archive as $contact_last_doc) {
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #93bad7; border-right:1px solid #93bad7;">
		<tr class="smallheight" style="background-color:#FFFFFF;">
			<td style="width:85px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style=" border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:120px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:100px; border-right:1px solid #93bad7;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
			<td style="width:18px;"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="1" id="imgsizeform"/></td>
		</tr>
		<tr style="cursor:pointer; background-color:#FFFFFF; color:#002673">
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo date_Us_to_Fr($contact_last_doc->date_creation);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_type_doc);?> - <?php echo htmlentities($contact_last_doc->ref_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7; border-bottom:1px solid #93bad7; text-align:left; padding-left:5px" id="open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>">
				<?php echo htmlentities($contact_last_doc->lib_etat_doc);?>
			</td>
			<td style=" border-right:1px solid #93bad7;  border-bottom:1px solid #93bad7; text-align:center; padding-left:5px" id="open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>">
			<?php echo htmlentities(price_format($contact_last_doc->montant_ttc))." ".$MONNAIE[1];?>
			</td>
			<td style=" border-bottom:1px solid #93bad7; text-align:center; ">
			<a href="documents_editing.php?ref_doc=<?php echo $contact_last_doc->ref_doc?>" target="edition" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif" alt="PDF" title="PDF"/></a>
			</td>
		</tr>
		</table>
		<script type="text/javascript">
			Event.observe('open_doc_archive_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_1_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_2_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
			Event.observe('open_doc_archive_3_<?php echo ($contact_last_doc->ref_doc);?>', "click", function(evt){ open_doc("<?php echo ($contact_last_doc->ref_doc);?>"); });
		</script>
		<?php 
		$first_docs ++;
	}
	?>
	<div id="show_all_FAC_archive" style="cursor:pointer; font-size:11px; color:#002673;">&gt;&gt;Consulter l'ensemble des Factures en archive </div><br />
	<script type="text/javascript">
	Event.observe('show_all_FAC_archive', "click", function(evt){
	lib_contact_docsearch = $("nom").value.truncate (38);
	page.verify("document_recherche","documents_recherche.php?ref_contact_docsearch=<?php echo $contact->getRef_contact();?>&is_open=0&id_type_doc=4&lib_contact_docsearch=<?php echo urlencode((nl2br(addslashes(substr (str_replace (CHR(13), "" ,str_replace (CHR(10), "" ,preg_replace ("#((\r\n)+)#", "", $contact->getNom()))),0, 38)))))?>", "true", "sub_content");
	});
	</script>
	<?php 
}
?>
</td>
<td style="width:2%">
	&nbsp;
</td>
<td style="width:33%">
	<table border="0" cellspacing="0" cellpadding="0" class="main_aff_ca">
		<tr>
			<td style="padding:10px">
				<table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
					<tr style="">
						<td class="aff_an_article">&nbsp;</td>
						<td class="aff_an_article">N</td>
						<td class="aff_an_article">N-1</td>
						<td class="aff_an_article">N-2</td>
					</tr>
					<tr>
						<td class="aff_tit_article">C.A. Client </td>
						<td class="aff_ca_article">
							<?php if (isset($client_CA[0])) {?>
							<?php echo price_format($client_CA[0])."&nbsp;".$MONNAIE[1];?>
							<?php } ?>
						</td>
						<td class="aff_ca_article">
							<?php if (isset($client_CA[1])) {?>
							<?php echo price_format($client_CA[1])."&nbsp;".$MONNAIE[1];?>
							<?php } ?>
						</td>
						<td class="aff_ca_article">
							<?php if (isset($client_CA[2])) {?>
							<?php echo price_format($client_CA[2])."&nbsp;".$MONNAIE[1];?>
							<?php } ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br />
	<span style="font-weight:bolder">Solde comptable: <?php echo price_format($solde_comptable)." ".$MONNAIE[1];?></span>
	<br />
	<br />
	<?php if (count($client_abo)>0){?>
	<div id="show_abo_client">
		<?php 
		include($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_contact_client_abo.inc.php");
		?>
	</div>
	<?php }?>
	<?php if (count($client_conso)>0){?>
	<div id="show_conso_client">
		<?php 
		include($DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_contact_client_conso.inc.php");
		?>
	</div>
	<?php }?>
</td>
</tr>
</table>
<script type="text/javascript">
	centrage_element("edition_abonnement");
	Event.observe(window, "resize", function(evt){centrage_element("edition_abonnement");});
</script>
<script type="text/javascript">
	centrage_element("edition_consommation");
	Event.observe(window, "resize", function(evt){centrage_element("edition_consommation");});
</script>