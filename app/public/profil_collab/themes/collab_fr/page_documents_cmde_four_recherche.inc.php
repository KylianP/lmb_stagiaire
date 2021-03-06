
<?php

// *************************************************************************************************************
// RECHERCHE D'UNE COMMANDE EN COURS
// *************************************************************************************************************

// Variables n?cessaires ? l'affichage
$page_variables = array ("_ALERTES");
check_page_variables ($page_variables);

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

// Affichage des erreurs
foreach ($_ALERTES as $alerte => $value) {
	echo $alerte." => ".$value."<br>";
}

// Formulaire de recherche
?>

<script type="text/javascript" language="javascript">
array_menu_r_article	=	new Array();
array_menu_r_article[0] 	=	new Array('recherche_cmde_fr', 'menu_1');
</script>
<div class="emarge">
<p class="titre">Recherche de commandes fournisseurs en cours</p>
<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_annuaire_recherche_mini.inc.php" //mini_moteur contact?>

<div id="recherche" class="corps_moteur">
<div id="recherche_cmde_fr" class="menu_link_affichage">
<form action="#" method="GET" id="form_recherche_c" name="form_recherche_c">
	<table style="width:97%">
		<tr class="smallheight">
			<td style="width:2%">&nbsp;</td>
			<td style="width:15%">&nbsp;</td>
			<td style="width:30%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:10%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:20%">&nbsp;</td>
			<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:3%">&nbsp;</td>
		</tr>
		<tr>
			<td style="width:2%">&nbsp;</td>
			<td style="width:15%; font-style : italic ; font-weight:bold">Crit?res d'affichage</td>
			<td style="width:30%"></td>
			<td style="width:10%"></td>
			<td style="width:20%; font-style : italic; font-weight:bold">Etat de la commande</td>
			<td style="width:20%"></td>
			<td style="width:3%">&nbsp;</td>
		</tr>
		<tr class="smallheight">
			<td style="width:2%">&nbsp;</td>
			<td style="width:15%">&nbsp;</td>
			<td style="width:30%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:10%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:20%">&nbsp;</td>
			<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:3%">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			<span class="labelled_text">Par fournisseur :</span>
			
			</td>
			<td>
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
					<tr>
						<td>
						<span style=" width:100%;" class="simule_champs" id="liste_de_fournisseur_c">
						<span id="ref_fournisseur_nom_c" style=" float:left; height:18px; margin-left:3px; line-height:18px;"><?php if (isset($_REQUEST["lib_fournisseur_docsearch"])) { echo (urldecode($_REQUEST["lib_fournisseur_docsearch"]));} else { ?>Tous<?php } ?></span>						</span>						</td>
						<td style="width:28px; text-align:right">
						<a href="#" id="ref_fournisseur_select_c" style="display:block; width:100%;">
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif"/ style="float:right" id="ref_fournisseur_select_img_c">						</a>						</td>
					</tr>
				</table>
				<script type="text/javascript">
				
		//effet de survol sur le faux select
			Event.observe('ref_fournisseur_select_c', 'mouseover',  function(){$("ref_fournisseur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_hover.gif";}, false);
			Event.observe('ref_fournisseur_select_c', 'mousedown',  function(){$("ref_fournisseur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_down.gif";}, false);
			Event.observe('ref_fournisseur_select_c', 'mouseup',  function(){$("ref_fournisseur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
			
			Event.observe('ref_fournisseur_select_c', 'mouseout',  function(){$("ref_fournisseur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
			Event.observe('ref_fournisseur_select_c', 'click',  function(evt){Event.stop(evt); show_mini_moteur_contacts ("recherche_docu_set_contact", "\'ref_fournisseur_c\', \'ref_fournisseur_nom_c\' "); preselect ('<?php echo $FOURNISSEUR_ID_PROFIL; ?>', 'id_profil_m'); page.annuaire_recherche_mini();}, false);
			Event.observe('liste_de_fournisseur_c', 'click',  function(evt){Event.stop(evt); show_mini_moteur_contacts ("recherche_docu_set_contact", "\'ref_fournisseur_c\', \'ref_fournisseur_nom_c\' "); preselect ('<?php echo $FOURNISSEUR_ID_PROFIL; ?>', 'id_profil_m'); page.annuaire_recherche_mini();}, false);
				</script>
			</td>
			<td>
			<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif"/ style=" cursor:pointer" id="ref_fournisseur_empty_c">
			
			<script type="text/javascript">
			Event.observe('ref_fournisseur_empty_c', 'click',  function(evt){Event.stop(evt); 
			$("ref_fournisseur_c").value = "";
			$("ref_fournisseur_nom_c").innerHTML = "Tous";
			}, false);
			</script>
			</td>
			<td style="width:25%">
			
			<input type="radio" name="etat_c" id="cmdecours_c" value="cmdecours_c" checked="checked" />
			<input type="hidden" name="ref_fournisseur_c" id="ref_fournisseur_c" value="<?php if (isset($_REQUEST["ref_contact_docsearch"])) { echo $_REQUEST["ref_contact_docsearch"];}?>" />
			<input type="hidden" name="ref_client_c" id="ref_client_c" value="" />
			<input type="hidden" name="ref_constructeur_c" id="ref_constructeur_c" value="" />
			<input type="hidden" name="orderby_c" id="orderby_c" value="date_doc" />
			<input type="hidden" name="orderorder_c" id="orderorder_c" value="DESC" />
			<input type="hidden" name="id_type_doc_c" id="id_type_doc_c" value="6" />
			<input type="hidden" name="app_tarifs_c" id="app_tarifs_c" value="<?php echo $DEFAUT_APP_TARIFS_FOURNISSEUR;?>" />
			<input type="hidden" name="recherche" value="1" />
			
			
			<span class="labelled_text">Toutes les commandes en cours</span>
			</td>
			
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><span class="labelled_text">Par stock d'arriv?e :</span></td>
			<td>
			<select name="id_name_stock_c" id="id_name_stock_c" class="classinput_xsize" style="width:100%"/>
			<option value="">Tous</option>
			<?php 
				$liste_stock = fetch_all_stocks ();
				foreach ($liste_stock as $stock) {
					?>
					<option value="<?php echo $stock->id_stock;?>" <?php if (isset($_REQUEST["id_stock"]) && $stock->id_stock == $_REQUEST["id_stock"]) { echo ' selected="selected"'; }?> ><?php echo htmlentities($stock->lib_stock);?></option>
					<?php 
				}
				?>
				</select>			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="width:30%">
			
				<input type="radio" name="etat_c" id="cmderec_c" value="cmderec_c" />
			
			<span class="labelled_text">Uniquement les commandes r?centes</span>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><span class="labelled_text">Par cat?gorie d'article :</span>
			<input type="hidden"value="" />
			</td>
			<td>
			<select name="id_name_categ_art_c" id="id_name_categ_art_c" class="classinput_xsize" style="width:100%"/>
			<option value="">Toutes</option>
			<?php 
				$select_art_categ =	get_articles_categories();
					foreach ($select_art_categ  as $s_art_categ){
			?>
			<option value="<?php echo ($s_art_categ->ref_art_categ)?>">
			<?php for ($i=0; $i<$s_art_categ->indentation; $i++) {?>&nbsp;&nbsp;&nbsp;<?php }?><?php echo htmlentities($s_art_categ->lib_art_categ)?>
			</option>
			<?php
				}
			?>
			</select>
			</td>
			<td></td>
			
			<td style="width:30%">
			
				<input type="radio" name="etat_c" id="cmderetard_c" value="cmderetard_c" />
			
			<span class="labelled_text">Uniquement les commandes en retard</span>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		<tr>
			<td>&nbsp;</td>
			<td>
			<span class="labelled_text">Par fabricant :</span>
			
			</td>
			<td>
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
					<tr>
						<td>
						<span style=" width:100%;" class="simule_champs" id="liste_de_constructeur_c">
						<span id="ref_constructeur_nom_c" style=" float:left; height:18px; margin-left:3px; line-height:18px;"><?php if (isset($_REQUEST["lib_constructeur_docsearch"])) { echo (urldecode($_REQUEST["lib_constructeur_docsearch"]));} else { ?>Tous<?php } ?></span>						</span>						</td>
						<td style="width:28px; text-align:right">
						<a href="#" id="ref_constructeur_select_c" style="display:block; width:100%;">
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif"/ style="float:right" id="ref_constructeur_select_img_c">						</a>						</td>
					</tr>
				</table>
				<script type="text/javascript">
				
		//effet de survol sur le faux select
			Event.observe('ref_constructeur_select_c', 'mouseover',  function(){$("ref_constructeur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_hover.gif";}, false);
			Event.observe('ref_constructeur_select_c', 'mousedown',  function(){$("ref_constructeur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find_down.gif";}, false);
			Event.observe('ref_constructeur_select_c', 'mouseup',  function(){$("ref_constructeur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
			
			Event.observe('ref_constructeur_select_c', 'mouseout',  function(){$("ref_constructeur_select_img_c").src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_contact_find.gif";}, false);
			Event.observe('ref_constructeur_select_c', 'click',  function(evt){Event.stop(evt); show_mini_moteur_contacts ("recherche_docu_set_contact", "\'ref_constructeur_c\', \'ref_constructeur_nom_c\' "); preselect ('<?php echo $CONSTRUCTEUR_ID_PROFIL; ?>', 'id_profil_m'); page.annuaire_recherche_mini();}, false);
			Event.observe('liste_de_constructeur_c', 'click',  function(evt){Event.stop(evt); show_mini_moteur_contacts ("recherche_docu_set_contact", "\'ref_constructeur_c\', \'ref_constructeur_nom_c\' "); preselect ('<?php echo $CONSTRUCTEUR_ID_PROFIL; ?>', 'id_profil_m'); page.annuaire_recherche_mini();}, false);
			</script>
			</td>
			<td>
			<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif"/ style=" cursor:pointer" id="ref_constructeur_empty_c">
			
			<script type="text/javascript">
			Event.observe('ref_constructeur_empty_c', 'click',  function(evt){Event.stop(evt); 
			$("ref_constructeur_c").value = "";
			$("ref_constructeur_nom_c").innerHTML = "Tous";
			}, false);
			</script>
			</td>
			
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
		
		
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="text-align:right">
			<input name="submit" type="image" onclick="$('page_to_show_c').value=1;" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-rechercher.gif"  style="float:left" />
			<input type="image" name="annuler_recherche_c" id="annuler_recherche_c" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-annuler.gif"/>
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td></td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td colspan="5"></td>
		<td>&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="page_to_show_c" id="page_to_show_c" value="1"/>
</form>
</div>

<div id="resultat"></div>

</div>
<script type="text/javascript">
//remise ? zero du formulaire
Event.observe('annuler_recherche_c', "click", function(evt){Event.stop(evt); $('form_recherche_c').reset();});
//lance la recherche
Event.observe('form_recherche_c', "submit", function(evt){page.documents_recherche_cmde_fr();  
	Event.stop(evt);});//centrage du mini_moteur de recherche de contact

centrage_element("pop_up_mini_moteur");
centrage_element("pop_up_mini_moteur_iframe");

Event.observe(window, "resize", function(evt){
centrage_element("pop_up_mini_moteur_iframe");
centrage_element("pop_up_mini_moteur");
});


//remplissage si on fait un retour dans l'historique
if (historique_request[7][0] == historique[0] && (default_show_id == "from_histo" || default_show_id == "to_histo")) {
	//history sur recherche simple
	if (historique_request[7][1] == "cmde_fr") {
	<?php if (!isset($_REQUEST["ref_contact_docsearch"])) {?>
	if (historique_request[7]["ref_fournisseur_c"] != "") {
	$("ref_fournisseur_nom_c").innerHTML = historique_request[7]["ref_fournisseur_nom_c"];
	}
	$('ref_fournisseur_c').value = historique_request[7]["ref_fournisseur_c"];
	<?php } ?>
	if (historique_request[7]["ref_constructeur_c"] != "") {
	$("ref_constructeur_nom_c").innerHTML = historique_request[7]["ref_constructeur_nom_c"];
	}
	$('ref_constructeur_c').value = historique_request[7]["ref_constructeur_c"];
	
	preselect (parseInt(historique_request[7]["id_name_stock_c"]), 'id_name_stock_c');
	preselect ((historique_request[7]["id_name_categ_art_c"]), 'id_name_categ_art_c');
	if (historique_request[7]["cmdecours_c"] == "1") {	$('cmdecours_c').checked = true;	}
	if (historique_request[7]["cmderec_c"] == "1") {	$('cmderec_c').checked = true;	}
	if (historique_request[7]["cmderetard_c"] == "1") {	$('cmderetard_c').checked = true;	}
	
	$('page_to_show_c').value = historique_request[7]["page_to_show_c"];  
	$('orderby_c').value = historique_request[7]["orderby_c"]; 
	$('orderorder_c').value = historique_request[7]["orderorder_c"]; 
	
	<?php if (!isset($_REQUEST["ref_contact_docsearch"]) && !isset($_REQUEST["acc_ref_document"])) {?>
	page.documents_recherche_cmde_fr();
	<?php } ?>
	}

}
//on masque le chargement
H_loading();
</SCRIPT>
