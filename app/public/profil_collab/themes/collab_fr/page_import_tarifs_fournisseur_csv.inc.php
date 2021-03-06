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

<div class="emarge">

<p class="titre">Import de tarifs fournisseur (au format CSV)</p>
<div>

<?php
if ($import_tarifs_fournisseur->getEtape() != "") {
	?>
	Un pr?c?dent import non termin? a ?t? d?tect?.<br />
	Souhaitez vous reprendre l'import des donn?es concern?es?  <span id="reprendre_import" style="cursor:pointer; font-weight:bolder"> Reprendre l'import</span>
	<script type="text/javascript">
	Event.observe('reprendre_import', "click", function(evt){
		page.verify('import_tarifs_fournisseur_csv','import_tarifs_fournisseur_csv_step2.php','true','sub_content');  
		Event.stop(evt);
	});
	</script>
	<br />
	<br />
	<?php 
}
?>
<form action="import_tarifs_fournisseur_csv_done.php" 
	enctype="multipart/form-data" method="POST" id="import_tarifs_fournisseur_csv_done" 
	name="import_tarifs_fournisseur_csv_done" target="formFrame" class="classinput_nsize" />
<input type="hidden" name="ref_contact" value="<?php echo $ref_contact; ?>" />
<table class="contactview_corps" style="width:100%;">
	<tr>
		<td>
			<span style="width:280px; text-align: left; float:left;">Indiquez l'emplacement de votre fichier :</span>
			<input type="file" size="35" name="fichier_csv" class="classinput_nsize" />
		</td>
		<td>
			<input type="submit" name="Submit" value="Valider" />
		</td>
	</tr>
</table>
<br />
<span style="width:380px; text-align: right; float:left">&nbsp;</span> 
<br />
<span style="font-weight:bolder">L'utilisation de ce module demande des connaissances techniques (utilisation Excel)</span><br />
En cas de besoin n'h?sitez pas ? contact les ?quipes de <a href="http://www.lundimatin.fr/site/contact.php" target="_blank">LundiMatin</a>
<br />
Le fichier doit ?tre au format CSV. (texte s?par? par ;)
<br />
Les informations de la premi?re ligne doivent correspondre aux diff?rentes informations des articles (R?f?rence OEM, R?f?rence interne, etc) sans symbole particulier.<br />
Id?alement il est recommand? de supprimer les colonnes inutiles.
<br />
<br />
<br />
T?lecharger <span class="common_link" id="download_exemple">ici</span> un exemple de fichier CSV
<br />
<br />
<script type="text/javascript">
Event.observe('download_exemple', "click", function(evt){
	page.verify('exemple_csv', '<?php echo $DIR.$_SESSION['theme']->getDir_theme(); ?>exemple_import_tarifs_fournisseur.csv','true','_blank');  
	Event.stop(evt);
});
</script>
</form>
</div>
<SCRIPT type="text/javascript">
//on masque le chargement
H_loading();
</SCRIPT>
</div>