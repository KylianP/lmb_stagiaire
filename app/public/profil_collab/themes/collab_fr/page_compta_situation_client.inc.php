<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables n�cessaires � l'affichage
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

<p class="titre">Situation Clients</p>
<div style="height:50px">
<table class="minimizetable" style="background-color:#FFFFFF">
<tr>
<td >
<div style="padding-left:10px; padding-right:10px">

	<span id="compte_client_extrait" class="grey_caisse" style="float:right" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/puce_bleue.gif"  style="padding-right:10px; float:left" vspace="3" /> Grand livre Clients</span>
	
	<span id="compta_livraisons_client_nonfacturees" class="grey_caisse" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/puce_bleue.gif"  style="padding-right:10px; float:left" vspace="3" /> Livraisons non factur�es</span><br /><br />
	
	<span id="compta_factures_client_nonreglees" class="grey_caisse" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/puce_bleue.gif"  style="padding-right:10px; float:left" vspace="3" /> Factures non r�gl�es</span><br /><br />

</div>
</td>
</tr>
</table>

<SCRIPT type="text/javascript">

	Event.observe('compta_livraisons_client_nonfacturees', "click", function(evt){
		page.verify('compta_livraisons_client_nonfacturees','compta_livraisons_client_nonfacturees.php','true','sub_content');
		Event.stop(evt);
});
	Event.observe('compta_factures_client_nonreglees', "click", function(evt){
		page.verify('compta_factures_client_nonreglees','compta_factures_client_nonreglees.php','true','sub_content');
		Event.stop(evt);
});
	Event.observe('compte_client_extrait', "click", function(evt){
		page.verify('compte_client_extrait','compte_client_journal.php','true','sub_content');
		Event.stop(evt);
});
//on masque le chargement
H_loading();
</SCRIPT>
</div>
</div>