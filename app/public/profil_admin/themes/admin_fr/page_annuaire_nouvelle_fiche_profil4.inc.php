<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables nécessaires à l'affichage
$page_variables = array ("liste_categories_client");
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>

<script type="text/javascript" language="javascript">

</script>

<hr class="bleu_liner" />
<div class="">
	<p class="sous_titre1">Informations client </p>
	<div class="reduce_in_edit_mode">
	<table class="minimizetable">
		<tr>
			<td class="size_strict"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Cat&eacute;gorie de client:</span>
			</td>
			<td>
			<select  id="id_client_categ"  name="id_client_categ" class="classinput_xsize">
				<?php
				foreach ($liste_categories_client as $liste_categorie_client){
					?>
					<option value="<?php echo $liste_categorie_client->id_client_categ;?>" <?php if ($liste_categorie_client->id_client_categ == $DEFAUT_ID_CLIENT_CATEG) {echo 'selected="selected"';}?>>
					<?php echo htmlentities($liste_categorie_client->lib_client_categ); ?></option>
					<?php 
				}
				?>
			</select>
			<script type="text/javascript">
			var listing_defaut_encours = new Array();
			<?php
			foreach ($liste_categories_client as $liste_categorie_client){
			?>
			listing_defaut_encours['<?php echo $liste_categorie_client->id_client_categ;?>'] = "<?php echo $liste_categorie_client->defaut_encours;?>";
			<?php
			}
			?>
			$("encours").value = listing_defaut_encours[$("id_client_categ").value];
			
			Event.observe('id_client_categ', "change",  function(evt){
				Event.stop(evt); 
				$("encours").value = listing_defaut_encours[$("id_client_categ").value];
			}, false);
			</script>
			</td>
		</tr>
		<tr>
			<td class="size_strict"><span class="labelled_ralonger">Type de client:</span>
			</td>
			<td>
			<select  id="type_client"  name="type_client" class="classinput_xsize">
				<option value="piste">Piste</option>
				<option value="prospect">Prospect</option>
				<option value="client">Client</option>
				<option value="ancien client">Ancien client</option>
			</select>
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Commercial:</span>
			</td>
			<td>
				<input name="ref_commercial" id="ref_commercial" type="hidden" value="" />
					<table cellpadding="0" cellspacing="0" border="0" style=" width:100%">
						<tr>
							<td>
							<input name="nom_commercial" id="nom_commercial" type="text" value=""  class="classinput_xsize" readonly=""/>
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
				foreach ($tarifs_liste as $tarif_liste) {
					?>
					<option value="<?php echo $tarif_liste->id_tarif; ?>"><?php echo htmlentities($tarif_liste->lib_tarif); ?>
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
				<span id="lib_adresse_livraison_choisie"></span>
			</div>
			<input name="ref_adr_livraison" id="ref_adr_livraison" type="hidden" class="classinput_xsize" value="" />
							
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
				<span id="lib_adresse_facturation_choisie"></span>
			</div>
			<input name="ref_adr_facturation" id="ref_adr_facturation" type="hidden" class="classinput_xsize" value="" />
			</td>
		</tr>
		<tr>
			<td class="size_strict">
			<span class="labelled_ralonger">Afficher Tarifs:</span>
			</td>
			<td>
			<select id="app_tarifs" name="app_tarifs" class="classinput_xsize">
				<option value="">Automatique</option>
				<option value="HT">HT</option>
				<option value="TTC">TTC</option>
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
				<option value="<?php echo $key;?>"><?php echo $valeur;?></option>
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
						<input id="encours" name="encours" class="classinput_lsize"type="text" value="" size="4"/>
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
						<input name="delai_reglement" id="delai_reglement" type="text" value=""  class="classinput_lsize" size="4"/>
						</td>
						<td> jour(s)
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>

</div>


<script type="text/javascript">

//chargement en cas de changement de client_categ des champs correspondant
Event.observe("id_client_categ", "change", function(evt){ annu_client_categ_preselect ($("id_client_categ").value);}, false);	

annu_client_categ_preselect ($("id_client_categ").value);

//masque numérique pour l'encours
Event.observe("encours", "blur", function(evt){ nummask(evt, "0", "X");}, false);	
//masque numérique pour le délai de règlement
Event.observe("delai_reglement", "blur", function(evt){ nummask(evt, "0", "X");}, false);	
<?php
if (isset($_REQUEST["crea"])) {
	?>
	 pre_start_adresse_crea ("adresse_livraison_choisie", "bt_adresse_livraison_choisie",   "lib_adresse_livraison_choisie", "ref_adr_livraison", "choix_liste_choix_adresse_livraison", "iframe_liste_choix_adresse_livraison");
				
	 pre_start_adresse_crea ("adresse_facturation_choisie", "bt_adresse_facturation_choisie",  "lib_adresse_facturation_choisie", "ref_adr_facturation", "choix_liste_choix_adresse_facturation", "iframe_liste_choix_adresse_facturation");
	<?php 
} else { 
	?>
	 pre_start_adresse ("adresse_livraison_choisie", "bt_adresse_livraison_choisie", $("ref_contact").value, "lib_adresse_livraison_choisie", "ref_adr_livraison", "choix_liste_choix_adresse_livraison", "iframe_liste_choix_adresse_livraison", "annuaire_liste_choix_adresse.php");
				
	 pre_start_adresse ("adresse_facturation_choisie", "bt_adresse_facturation_choisie", $("ref_contact").value, "lib_adresse_facturation_choisie", "ref_adr_facturation", "choix_liste_choix_adresse_facturation", "iframe_liste_choix_adresse_facturation", "annuaire_liste_choix_adresse.php");
	<?php 
}
?>
//on masque le chargement
H_loading();
</script>
