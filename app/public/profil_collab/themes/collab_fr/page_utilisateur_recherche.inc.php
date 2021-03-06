<?php

// *************************************************************************************************************
// RECHERCHE DES CONNEXIONS DES UTILISATEURS
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
</script>
<div class="emarge">
<p class="titre">Recherche des connexions des utilisateurs</p>

<div id="recherche" class="corps_moteur">
	<div id="recherche_simple" class="menu_link_affichage">
		<form action="#" id="form_recherche_simple" name="form_recherche_simple" method="GET" onsubmit="page.utilisateur_recherche_simple(); return false;">
			<table style="width:97%">
				<tr class="smallheight">
					<td style="width:5%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
					<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
					<td style="width:30%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
					<td ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
					<td style="width:5%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type=hidden name="recherche" value="1" />
					<input type="hidden" name="orderby_s" id="orderby_s" value="date" />
					<input type="hidden" name="orderorder_s" id="orderorder_s" value="DESC" />
					<span class="labelled">Nom&nbsp;ou&nbsp;D&eacute;nomination:</span></td>
					<td><input type="text" name="nom_s" id="nom_s" value="<?php if (isset($_REQUEST["acc_ref_contact"])) { echo htmlentities($_REQUEST["acc_ref_contact"]);}
	?>"   class="classinput_xsize"/></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><span class="labelled">Profil : </span></td>
					<td><select name="id_profil_s" id="id_profil_s"  class="classinput_xsize">
							<option value="0"> -- Tous </option>
							<?php
							$separateur = 1;
							for ($i=0; $i<count($profils_avancees); $i++) {
								if ($profils_avancees[$i]->getActif() == 2 && $separateur) {
								$separateur = 0;
								?>
								<OPTGROUP disabled="disabled" label="__________________________________" ></OPTGROUP>
								<?php
								}
								?>
								<option value="<?php echo $profils_avancees[$i]->getId_profil()?>"><?php echo $profils_avancees[$i]->getLib_profil()?></option>
								<?php 
							}
							?>
					</select>
					</td>
					<td>&nbsp;</td>
					<td style="text-align:right"></td>
				</tr>
	<tr>
		<td></td>
		<td><span class="labelled">P?riode&nbsp;du&nbsp; </span></td>
		<td><input type="text" id="date_debut" name="date_debut" value="" class="classinput_nsize" size="10" /> au&nbsp;<input type="text" id="date_fin" name="date_fin" value="" class="classinput_nsize" size="10" /></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
				<tr>
					<td></td>
					<td>&nbsp;</td>
					<td><input name="submit_s" type="image" onclick="$('page_to_show_s').value=1;" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-rechercher.gif" style="float:left" /></td>
					<td><!--<input type="image" name="res_s" id="res_s" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-annuler.gif"/>-->	</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td>&nbsp;</td>
					<td></td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<input type="hidden" name="page_to_show_s" id="page_to_show_s" value="1"/>
		</form>
	</div>


</div>

<div id="resultat"></div>

</div>
<SCRIPT type="text/javascript">
	Event.observe("date_debut", "blur", function(evt){
		datemask (evt);
	}, false);
	Event.observe("date_fin", "blur", function(evt){
		datemask (evt);
	}, false);
//on masque le chargement
H_loading();
</SCRIPT>