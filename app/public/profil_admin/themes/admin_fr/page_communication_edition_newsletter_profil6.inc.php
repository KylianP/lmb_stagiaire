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
<script type="text/javascript" language="javascript">
</script>
<div class=""> 
	<p class="titre_config">Crit?res Constructeurs</p>
	<div class="reduce_in_edit_mode">
		<table class="minimizetable">
			<tr>
				<td style="width:180px"></td>
				<td><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
				<input type="checkbox" value="0" id="tous_constr" name="tous_constr" checked="yes" disabled> Tous les constructeurs.
				</td>
			</tr>
		</table>
	</div>
</div>

<script type="text/javascript">
//on masque le chargement
H_loading();
</script>