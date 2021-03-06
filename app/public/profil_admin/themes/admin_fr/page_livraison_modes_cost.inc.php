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
<div class="emarge">
	<form method="post" action="livraison_modes_cost_mod.php" id="livraison_modes_cost_mod_<?php echo $livraison_mode->getId_livraison_mode(); ?>" name="livraison_modes_cost_mod_<?php echo $livraison_mode->getId_livraison_mode(); ?>" target="formFrame">
	<input name="id_livraison_mode"  type="hidden" value="<?php echo $livraison_mode->getId_livraison_mode();?>" />
<?php
$selected_base = "POIDS";
if (count($livraison_costs) && isset ($livraison_costs[0])) {
	$selected_base = $livraison_costs[0]->base_calcul;
}
?> Base de calcul: 
	<select name="base_calcul_<?php echo $livraison_mode->getId_livraison_mode(); ?>" id="base_calcul_<?php echo $livraison_mode->getId_livraison_mode(); ?>">
		<?php 
		foreach ($BASE_CALCUL_LIVRAISON as $base=>$val) {
			?>
			<option value="<?php echo $base;?>" <?php if ($base == $selected_base) {echo 'selected="selected"';}?>><?php echo $val[0];?></option>
			<?php
		}
		?>
	</select><br />

	<script type="text/javascript">
	Event.observe("base_calcul_<?php echo $livraison_mode->getId_livraison_mode(); ?>", "change",  function(evt){
		Event.stop(evt); 
		 $("livraison_modes_cost_mod_<?php echo $livraison_mode->getId_livraison_mode(); ?>").submit();
	}, false);
	</script>
<?php
$i=1;
foreach ($livraison_costs as $cost) {
	$fixe = substr($cost->formule, 0, strpos($cost->formule, "+"));
	$variab = substr($cost->formule, strpos($cost->formule, "+")+1);
	$nd=0;
	if ($fixe < 0 && $variab <0) {$nd = 1; $fixe = "ND"; $variab = "ND" ;}
	?>
	<div style="border-top:1px solid #999999" id="add_cost_mode_liv_aff_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>">
	
	
	<a href="#" id="link_livraison_modes_cost_sup_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode(); ?>" style="float:right; <?php if ($i == 1) {?>display:none;<?php }?>" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0"></a>
	<script type="text/javascript">
	Event.observe("link_livraison_modes_cost_sup_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode(); ?>", "click",  function(evt){
		Event.stop(evt); 
		 remove_tag("add_cost_mode_liv_aff_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>");
		 $("livraison_modes_cost_mod_<?php echo $livraison_mode->getId_livraison_mode(); ?>").submit();
	}, false);
	</script>
	<table style="width:100%">
		<tr class="smallheight">
			<td style="width:80%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>
		<tr>
			<td><?php echo $BASE_CALCUL_LIVRAISON[$selected_base][0];?> >= <input name="indice_min_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>"  id="indice_min_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>" type="text" value="<?php echo $cost->indice_min;?>" <?php if (!$cost->indice_min) { ?>READONLY<?php } ?> size="5" style="text-align:right" />  <?php echo $BASE_CALCUL_LIVRAISON[$selected_base][1];?>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
				Co?t = 
				<input name="fixe_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>" id="fixe_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>"  type="text" value="<?php echo $fixe ;?>" <?php if ($nd) { echo 'READONLY';}?>  size="5" style="text-align:right" />
				<span style=" <?php if ( $selected_base == "PRIX") {?>display:none;<?php }?>">
			 +  
			 <input name="variab_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>" id="variab_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>"  type="text" value="<?php echo $variab ;?>" <?php if ($nd) { echo 'READONLY';}?> size="5" style="text-align:right"/> x <?php echo $BASE_CALCUL_LIVRAISON[$selected_base][0];?>
				</span>
			</td>
			<td>ou <input name="nd_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>" id="nd_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>"  type="checkbox" value="0" title="Non disponible" <?php if ($nd) { echo 'checked="checked"';}?> /> N.D.
			</td>
		</tr>
	</table>
	</div>
	<script type="text/javascript">
	Event.observe('indice_min_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>', 'blur',  function(evt){
		nummask(evt, 0, "X.X");
	}, false);
	
	Event.observe('fixe_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>', 'blur',  function(evt){
		nummask(evt, 0, "X.X");
	}, false);
	Event.observe('variab_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>', 'blur',  function(evt){
		nummask(evt, 0, "X.X");
	}, false);
	Event.observe('nd_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>', 'click',  function(evt){
			$('fixe_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=false;
			$('variab_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=false;
		if ($('nd_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>').checked) {
			$('fixe_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=true;
			$('variab_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=true;
			$('fixe_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>').value = "ND";
			$('variab_<?php echo $i;?>_<?php echo $livraison_mode->getId_livraison_mode();?>').value = "ND";
		}
	}, false);
	</script>
	<?php
	$i++;
}
?>

<div style=" <?php if (count($livraison_costs)) { ?>display:none;<?php } ?> border-top:1px solid #999999"  id="add_cost_mode_liv_aff_<?php echo $livraison_mode->getId_livraison_mode();?>"><br />

	<table style="width:100%">
		<tr class="smallheight">
			<td style="width:80%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
		</tr>
		<tr>
			<td><?php echo $BASE_CALCUL_LIVRAISON[$selected_base][0];?> >= <input name="indice_min_0_<?php echo $livraison_mode->getId_livraison_mode();?>" id="indice_min_0_<?php echo $livraison_mode->getId_livraison_mode();?>"  type="text" value="<?php if (!count($livraison_costs)) { ?>0<?php } ?>"   size="5" style="text-align:right" <?php if (!count($livraison_costs)) { ?>READONLY<?php } ?> /> <?php echo $BASE_CALCUL_LIVRAISON[$selected_base][1];?>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>Co?t = 
			<input name="fixe_0_<?php echo $livraison_mode->getId_livraison_mode();?>" id="fixe_0_<?php echo $livraison_mode->getId_livraison_mode();?>"  type="text" value="0" class="classinput_nsize" size="5" style="text-align:right" />
				<span style=" <?php if ( $selected_base == "PRIX") {?>display:none;<?php }?>">
			 +  <input name="variab_0_<?php echo $livraison_mode->getId_livraison_mode();?>" id="variab_0_<?php echo $livraison_mode->getId_livraison_mode();?>"  type="text" value="0" class="classinput_nsize" size="5" style="text-align:right"/>
			  x <?php echo $BASE_CALCUL_LIVRAISON[$selected_base][0];?>
				</span>
			</td>
			<td>ou <input name="nd_0_<?php echo $livraison_mode->getId_livraison_mode();?>" id="nd_0_<?php echo $livraison_mode->getId_livraison_mode();?>"  type="checkbox" value="0" title="Non disponible" /> N.D.
			</td>
		</tr>
	</table>
</div>

<div style=" border-top:1px solid #999999"></div>
<div id="add_cost_liv_mode_liv_<?php echo $livraison_mode->getId_livraison_mode();?>" style="cursor:pointer;<?php if (!count($livraison_costs)) { ?>display:none<?php } ?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/ajouter.gif" /> <span style="font-weight:bolder">Ajouter un palier</span></div>
					
<div style="text-align:center; "><br />

				<input name="valider_cost_<?php echo $livraison_mode->getId_livraison_mode();?>" id="valider_cost_<?php echo $livraison_mode->getId_livraison_mode();?>" type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-valider.gif" />
				</div>
</form>

<script type="text/javascript">
	Event.observe('nd_0_<?php echo $livraison_mode->getId_livraison_mode();?>', 'click',  function(evt){
			$('fixe_0_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=false;
			$('variab_0_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=false;
		if ($('nd_0_<?php echo $livraison_mode->getId_livraison_mode();?>').checked) {
			$('fixe_0_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=true;
			$('variab_0_<?php echo $livraison_mode->getId_livraison_mode();?>').readOnly=true;
			$('fixe_0_<?php echo $livraison_mode->getId_livraison_mode();?>').value = "ND";
			$('variab_0_<?php echo $livraison_mode->getId_livraison_mode();?>').value = "ND";
		}
	}, false);
Event.observe('add_cost_liv_mode_liv_<?php echo $livraison_mode->getId_livraison_mode();?>', 'click',  function(){
	$("add_cost_mode_liv_aff_<?php echo $livraison_mode->getId_livraison_mode();?>").show();
	$("add_cost_liv_mode_liv_<?php echo $livraison_mode->getId_livraison_mode();?>").hide();
}, false);


Event.observe('indice_min_0_<?php echo $livraison_mode->getId_livraison_mode();?>', 'blur',  function(evt){
	nummask(evt, 0, "X.X");
}, false);

Event.observe('fixe_0_<?php echo $livraison_mode->getId_livraison_mode();?>', 'blur',  function(evt){
	nummask(evt, 0, "X.X");
}, false);
Event.observe('variab_0_<?php echo $livraison_mode->getId_livraison_mode();?>', 'blur',  function(evt){
	nummask(evt, 0, "X.X");
}, false);
</script>
<table>
	<tr>
		<td colspan="2" style="font-weight:bolder">Exceptions au co?t de livraison / Cat?gories d'articles</td>
		<td>
		<span style="cursor:pointer; text-decoration:underline" id="cost_consult_art_categ">Consulter</span>
		<script type="text/javascript">
			new Event.observe("cost_consult_art_categ", "click", function(evt){
				Event.stop(evt); 
				page.verify('livraison_modes_cost_art_categ','livraison_modes_cost_art_categ.php?id_livraison_mode=<?php echo $livraison_mode->getId_livraison_mode();?>','true','sub_content');
			}, false);
		</script>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="font-weight:bolder">Exceptions au co?t de livraison / Articles</td>
		<td>
		<span style="cursor:pointer; text-decoration:underline" id="cost_consult_article">Consulter</span>
		<script type="text/javascript">
			new Event.observe("cost_consult_article", "click", function(evt){
				Event.stop(evt); 
				page.verify('livraison_modes_cost_article','livraison_modes_cost_article.php?id_livraison_mode=<?php echo $livraison_mode->getId_livraison_mode();?>','true','sub_content');
			}, false);
		</script>
		</td>
	</tr>
</table>
</div>

<SCRIPT type="text/javascript">

//on masque le chargement
H_loading();
</SCRIPT>