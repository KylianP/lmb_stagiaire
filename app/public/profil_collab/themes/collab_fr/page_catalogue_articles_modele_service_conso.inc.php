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

?><br />
<span class="labelled_text" style="font-weight:bolder">Service prepay?s :</span>
<table style="width:100%">
	<tr>
		<td style="width:40%" class="labelled_text">Dur?e de validit?: </td>
		<td style="width:36%">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
			<tr>
			<td>
			<input type="text" name="duree_validite_mois" id="duree_validite_mois" value="0" size="3"  class="classinput_nsize"/>&nbsp;mois 
			</td>
			<td>
			<input type="text" name="duree_validite_jour" id="duree_validite_jour" value="0" size="3"  class="classinput_nsize"/>&nbsp;jours
			</td>
			</tr>
			</table>
		</td>
		<td style="width:29%"></td>
	</tr>
 <tr>
		<td style="width:40%" class="labelled_text">Nombre de cr?dits: </td>
		<td style="width:36%">
			<input type="text" name="nb_credits" id="nb_credits" value="1" size="3"  class="classinput_nsize"/>
		</td>
		<td style="width:29%"></td>
	</tr>
	<tr>
		<td class="labelled_text"></td>
		<td>&nbsp;</td>
		<td ></td>
	</tr>
</table>


<SCRIPT type="text/javascript">
$("modele").value="<?php echo $id_modele;?>";

 Event.observe("duree_validite_mois", "blur", function(evt){
 	nummask(evt,"0", "X");
 }, false);
 Event.observe("duree_validite_jour", "blur", function(evt){nummask(evt,"0", "X");
 }, false);
 Event.observe("nb_credits", "blur", function(evt){nummask(evt,"1", "X");
 }, false);
//on masque le chargement
H_loading();
</SCRIPT>