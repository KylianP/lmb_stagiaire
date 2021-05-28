<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables nécessaires à l'affichage
$page_variables = array ();
check_page_variables ($page_variables);



// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

$filename = "header.php";
if (file_exists($filename)) {
require ($filename);
}

$filename = "top.php";
if (file_exists($filename)) {
require ($filename);
}


$filename = "menu.php";
if (file_exists($filename)) {
require ($filename);
}

$filename = "content_before.php";
if (file_exists($filename)) {
require ($filename);
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr style="">
		<td colspan="3" style="">
		<br />
		<br />
		<div class="para"  style="text-align:center; margin:20px 0px;">
		<br />
		<br />

		<div style="width:880px;	margin:0px auto;">


	<form action="_inscription_envoi.php" method="post" id="infos_contact">
	<table class="minimizetable">
		<tr>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>	
		<tr>
			<td style="width:48%">
			<table border="0" cellspacing="0" cellpadding="0" style="background-color:#FFFFFF">
				<tr>
					<td class="lightbg_liste1">&nbsp;</td>
					<td class="lightbg_liste"></td>
					<td class="lightbg_liste2">&nbsp;</td>
				</tr>
				<tr>
					<td class="lightbg_liste">&nbsp;</td>
					<td class="lightbg_liste">
			<input type="hidden" id="inscription" name="inscription"  value=""/>
			<input type="hidden" id="profils_inscription" name="profils_inscription"  value="<?php echo $_INTERFACE['ID_PROFIL'];?>"/>
			
		<div class="title_content" style="text-align:right">INFORMATIONS PERSONNELLES <img  src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/icone_contact.gif" style="vertical-align:text-bottom"/> </div>
			<br />
			<br />
			<br />
			<br />
			<br />

			
	<div class="sous_titre1">Identité</div>
	<table class="minimizetable">
		<tr>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>	
		<tr>
			<td  class="size_strict">
					<span class="labelled_court">Cat&eacute;gorie:</span>
			</td>
			<td>
				<select id="id_categorie" name="id_categorie" class="classinput_xsize">
					<option value="1" selected="selected">Particulier</option>
					<option value="2">Soci&eacute;t&eacute;</option>
					<option value="3">Administration</option>
					<option value="4">Association</option>
					<option value="5">Autre</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="labelled_court">Civilit&eacute;:</span>
			</td>
			<td>
				<select name="civilite" id="civilite" class="classinput_xsize">
					<option value="5"></option>
					<option value="1">M.</option>
					<option value="8">M. ou Mme</option>
					<option value="7">Melle</option>
					<option value="2">Mme</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="labelled_court">Nom: *</span>
			</td>
			<td>
			<textarea id="nom" name="nom" rows="2"  class="classinput_xsize"></textarea>
			</td>
		</tr>
		<tr id="line_siret" style="display:none">
			<td>
				<span class="labelled_court" title="Numéro de Siret">Siret:</span>
			</td>
			<td>
			<input type="text" id="siret" name="siret" maxlength="20" value="" class="classinput_xsize"/>
			</td>
		</tr>
		<tr id="line_tva_intra" style="display:none">
			<td>
				<span class="labelled_court" title="Numéro de T.V.A. intracommunautaire">T.V.A. intra:</span>
			</td>
			<td>
			<input type="text" id="tva_intra" name="tva_intra" maxlength="20" value="" class="classinput_xsize"/>
			</td>
		</tr>
	</table>
	<br/>
	<div class="sous_titre1">Vos identifiants de connexion</div><br />
		
	<table class="minimizetable">
		<tr>
			<td class="size_strict"><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr><tr>
			<td  class="size_strict">
			<span class="labelled_ralonger">Pseudonyme: *</span>
			</td>
			<td>
			<input id="admin_pseudo" name="admin_pseudo" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_ralonger">Email: *</span>
			</td>
			<td>
			<input id="admin_emaila" name="admin_emaila" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_ralonger">Confirmer l'adresse Email: *</span>
			</td>
			<td>
			<input id="admin_emailb" name="admin_emailb" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_ralonger">Mot de passe: *</span>
			</td>
			<td>
			<input type="password" id="admin_passworda" name="admin_passworda" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_ralonger">Confirmer le mot de passe: *</span>
			</td>
			<td>
			<input type="password" id="admin_passwordb" name="admin_passwordb" value="" class="classinput_xsize"/>
			</td>
		</tr>
	</table>
	<br /><br /><br />

				</td>
				<td class="lightbg_liste">&nbsp;</td>
			</tr>
			<tr>
				<td class="lightbg_liste4"></td>
				<td class="lightbg_liste">&nbsp;</td>
				<td class="lightbg_liste3">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td style="width:25px;">
	</td>
	<td>
		<table border="0" cellspacing="0" cellpadding="0" style="background-color:#FFFFFF">
			<tr>
				<td class="lightbg_liste1">&nbsp;</td>
				<td class="lightbg_liste"></td>
				<td class="lightbg_liste2">&nbsp;</td>
			</tr>
			<tr>
				<td class="lightbg_liste">&nbsp;</td>
				<td class="lightbg_liste">
				
	<div id="adresse_livraison_block" >
	<div class="sous_titre1">Adresse de Livraison</div>
	<table class="minimizetable">
		<tr class="smallheight">
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>
		<tr>
			<td  class="size_strict">
			<span class="labelled_court">Adresse: </span>
			</td><td>
			<textarea id="livraison_adresse" name="livraison_adresse" rows="2" class="classinput_xsize"/></textarea>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_court">Code Postal: </span> </td>
			<td>
			<input id="livraison_code" name="livraison_code" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_court">Ville: </span>
			</td>
			<td>
			<div style="position:relative; top:0px; left:0px; width:100%; height:0px;">
			<iframe id="iframe_choix_livraison_ville" frameborder="0" scrolling="no" src="about:_blank"  class
	="choix_complete_ville"></iframe>
			<div id="choix_livraison_ville"  class="choix_complete_ville"></div></div>
			<input name="livraison_ville" id="livraison_ville" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_court">Pays: </span> </td>
			<td>
			<?php 
				$listepays = getPays_select_list ();
			?>
			
			<select id="id_pays_livraison"  name="id_pays_livraison" class="classinput_xsize" title="Pays">

				<?php
				$separe_listepays = 0;
				foreach ($listepays as $payslist){
					if ((!$separe_listepays) && (!$payslist->affichage)) { 
						$separe_listepays = 1; ?>
						<OPTGROUP disabled="disabled" label="__________________________________" ></OPTGROUP>
						<?php 		 
					}
					?>
					<option value="<?php echo $payslist->id_pays?>" <?php if ( $DEFAUT_ID_PAYS == $payslist->id_pays) {echo 'selected="selected"';}?>>
					<?php echo htmlentities($payslist->pays)?></option>
					<?php 
				}
				?>
			</select>
			<script type="text/javascript">
				Event.observe('livraison_ville', 'focus',  function(evt){start_commune("livraison_code", "livraison_ville", "choix_livraison_ville", "iframe_choix_livraison_ville", "liste_ville.php?cp=");}, false);
					
				Event.observe('id_pays_livraison', 'focus',  function(){delay_close("choix_livraison_ville", "iframe_choix_livraison_ville");}, false);
			</script>
			</td>
		</tr><tr>
			<td>
			</td>
			<td>
			</td>
		</tr>
	</table>
		<span id="adresse_livraison_identique" style="display:">Adresse de facturation identique à l'adresse de livraison <input id="same_adresse_livraison" name="same_adresse_livraison" type="checkbox" value="1" /></span><br />

	<script type="text/javascript">
		Event.observe('same_adresse_livraison', 'click',  function(evt){
		if ($("same_adresse_livraison").checked){
		
			$("adresse_adresse").value = $("livraison_adresse").value;
			$("adresse_code").value = $("livraison_code").value;
			$("adresse_ville").value = $("livraison_ville").value;
			$("id_pays_contact").selectedIndex = $("id_pays_livraison").selectedIndex;
		}
		}, false);
	</script>
	</div>
	<br/>
	<div class="sous_titre1">Adresse de facturation</div>
	<table class="minimizetable">
		<tr class="smallheight">
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>
		<tr>
			<td  class="size_strict">
			<span class="labelled_court">Adresse: *</span>
			</td><td>
			<textarea id="adresse_adresse" name="adresse_adresse" rows="2" class="classinput_xsize"/></textarea>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_court">Code Postal: *</span> </td>
			<td>
			<input id="adresse_code" name="adresse_code" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_court">Ville: *</span>
			</td>
			<td>
			<div style="position:relative; top:0px; left:0px; width:100%; height:0px;">
			<iframe id="iframe_choix_adresse_ville" frameborder="0" scrolling="no" src="about:_blank"  class
	="choix_complete_ville"></iframe>
			<div id="choix_adresse_ville"  class="choix_complete_ville"></div></div>
			<input name="adresse_ville" id="adresse_ville" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
			<span class="labelled_court">Pays: *</span> </td>
			<td>
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
					<option value="<?php echo $payslist->id_pays?>" <?php if ( $DEFAUT_ID_PAYS == $payslist->id_pays) {echo 'selected="selected"';}?>>
					<?php echo htmlentities($payslist->pays)?></option>
					<?php 
				}
				?>
			</select>
			<script type="text/javascript">
				Event.observe('adresse_ville', 'focus',  function(evt){start_commune("adresse_code", "adresse_ville", "choix_adresse_ville", "iframe_choix_adresse_ville", "liste_ville.php?cp=");}, false);
					
				Event.observe('id_pays_contact', 'focus',  function(){delay_close("choix_adresse_ville", "iframe_choix_adresse_ville");}, false);
			</script>
			</td>
		</tr><tr>
			<td>
			</td>
			<td>
			</td>
		</tr>
	</table>
		<br />

	<div class="sous_titre1">Coordonnées</div>
	<table class="minimizetable">
		<tr>
			<td class="size_strict"><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>

			<td><img src="'.$distant_install_images.'blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr><tr>
			<td  class="size_strict">
				<span class="labelled_court">T&eacute;l&eacute;phone 1:</span>
			</td><td>
				<input id="coordonnee_tel1" name="coordonnee_tel1" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
				<span class="labelled_court">T&eacute;l&eacute;phone 2:</span>
			</td><td>
				<input id="coordonnee_tel2" name="coordonnee_tel2" value="" class="classinput_xsize"/>
			</td>
		</tr><tr>
			<td>
				<span class="labelled_court">Fax:</span>
			</td><td>
				<input id="coordonnee_fax" name="coordonnee_fax" value="" class="classinput_xsize"/>
			</td>
		</tr>
	</table>
	<div style="text-align:right">
			<input type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt_valider.gif" />
			</div>
				</td>
				<td class="lightbg_liste">&nbsp;</td>
			</tr>
			<tr>
				<td class="lightbg_liste4"></td>
				<td class="lightbg_liste">&nbsp;</td>
				<td class="lightbg_liste3">&nbsp;</td>
			</tr>
		</table>
			</td>
			</tr>
		</table>
	</form>
	<script type="text/javascript">
	
	Event.observe("infos_contact", "submit",  function(evt){Event.stop(evt); check_infos_contact(); }, false);
	start_civilite("id_categorie", "civilite", "civilite.php?cat=");
	
	Event.observe("id_categorie", "change",  function(evt){
		if ($("id_categorie").value == "2") {
			$("line_siret").show(); 
			$("line_tva_intra").show(); 
		} else {
			$("line_siret").hide(); 
			$("line_tva_intra").hide(); 
		}
	}, false);

	
	
	</script>
	</div><br />

		</td>
	</tr>
</table>
<?php 
$filename = "content_after.php";
if (file_exists($filename)) {
require ($filename);
}

$filename = "footer.php";
if (file_exists($filename)) {
require ($filename);
}
?>

