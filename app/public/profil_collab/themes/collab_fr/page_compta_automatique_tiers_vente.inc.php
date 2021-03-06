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
<script type="text/javascript">
</script>
<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_compta_plan_recherche_mini.inc.php" ?>
<div class="emarge">
<div style=" float:right; text-align:right">
<span id="retour_compta_auto" style="cursor:pointer; text-decoration:underline">Retour ? la comptabilit? automatique</span>
<script type="text/javascript">
Event.observe('retour_compta_auto', 'click',  function(evt){
Event.stop(evt); 
page.verify('compta_automatique','compta_automatique.php','true','sub_content');
}, false);
</script>
</div>
<p class="titre">Num?ros de compte associ?s aux cat?gories de clients </p>
<div style="height:50px">
<table class="minimizetable">
<tr>
<td class="contactview_corps">
<div style="padding-left:10px; padding-right:10px">

				<table width="100%">
				<tr class="smallheight">
				<td style=""><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				<td style="width:15%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				<td style="width:10%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				<td style="width:50%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				</tr>
				<tr>
				<td colspan="4">&nbsp;
				</td>
				</tr>
				<tr class="smallheight">
				<td style=" font-weight:bolder;  text-align:center">Cat?gories de clients</td>
				<td style=" font-weight:bolder;  text-align:center">Num?ro de compte VENTE</td>
				<td>&nbsp;</td>
				<td style=" font-weight:bolder; text-align:left">
				<span>Libell?:</span>
				</td>
				</tr>
				<tr>
				<td colspan="4">&nbsp;
				</td>
				</tr>
				<?php
				//liste des categories
				foreach ($liste_categories  as $categorie){
					?>
					<tr>
					<td style="text-align:center">
							<?php echo $categorie->lib_client_categ;?>
					
					</td>
					<td style="text-align:center">
					<span id="aff_num_compte_vente_<?php echo $categorie->id_client_categ;?>" style="cursor:pointer; text-decoration:underline; padding-right:15px;" ><?php if ($categorie->defaut_numero_compte) { echo $categorie->defaut_numero_compte;} else { echo $DEFAUT_COMPTE_TIERS_VENTE;}?></span>
					<script type="text/javascript">
					Event.observe("aff_num_compte_vente_<?php echo $categorie->id_client_categ;?>", "click",  function(evt){Event.stop(evt); ouvre_compta_plan_mini_moteur(); 
					charger_compta_plan_mini_moteur ("compte_plan_comptable_search.php?cible=client_categ&cible_id=<?php echo $categorie->id_client_categ;?>&retour_value_id=aff_num_compte_vente_<?php echo $categorie->id_client_categ;?>&retour_lib_id=lib_aff_num_compte_vente_<?php echo $categorie->id_client_categ;?>&indent=num_compte_vente_<?php echo $categorie->id_client_categ;?>&num_compte=<?php echo $DEFAUT_COMPTE_TIERS_VENTE;?>");}, false);
					</script>
					</td>
				<td>&nbsp;</td>
					<td>
					<span id="lib_aff_num_compte_vente_<?php echo $categorie->id_client_categ;?>">
					<?php if ($categorie->defaut_lib_compte) { echo $categorie->defaut_lib_compte;} else {  $lcpt = new compta_plan_general($DEFAUT_COMPTE_TIERS_VENTE); echo $lcpt->getLib_compte();}?>
					</span>
					</td>
					</tr>
					<tr>
					<td colspan="4">&nbsp;
					</td>
					</tr>
					<?php 
				}
				?>

				</table>


</div>
</td>
</tr>
</table>

<SCRIPT type="text/javascript">
//on masque le chargement
H_loading();
</SCRIPT>
</div>
</div>