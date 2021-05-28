<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables nécessaires à l'affichage
$page_variables = array ();
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************



// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<ul class="choix_email" style="width:100%">
<?php 
$i=0;
if (is_array($liste_email)){
	foreach ($liste_email as $email) {
		if ($email->email == "" ) {continue;}
		?>
		<li class="complete_ville" id="email_<?php echo $i;?>"><?php echo $email->email;?></li>
		<?php 
		$i++;
	}
} else {
	?>
	Aucun email défini.
	<?php
}
?>
		<li class="complete_ville" id="email_perso">Envoyer un email personnalisé</li>
</ul>
<script type="text/javascript">
<?php 
$i=0;
if (is_array($liste_email)){
	foreach ($liste_email as $email) {
		if ($email->email == "" ) {continue;}
		?>
Event.observe("email_<?php echo $i;?>", "mouseout",  function(){changeclassname ("email_<?php echo $i;?>", "complete_ville");}, false);

Event.observe("email_<?php echo $i;?>", "mouseover",  function(){changeclassname ("email_<?php echo $i;?>", "complete_ville_hover");}, false);

Event.observe("email_<?php echo $i;?>", "click",  function(){
	$("choix_send_mail").style.display="none";
	$("iframe_choix_send_mail").style.display="none";
	var AppelAjax = new Ajax.Request(
																	"documents_contact_email_send_doc.php", 
																	{parameters: {ref_doc: "<?php echo $document->getRef_doc()?>", destinataires: "<?php echo $email->email;?>", titre: "<?php echo $document->getLib_type_printed ()." ".$document->getRef_doc()?>", message: "\nLe document ci-joint vous est envoy&eacute; par \"<?php echo $contact_entreprise->getNom();?>\".\nLa lecture du fichier joint n&eacute;cessite la pr&eacute;sence sur votre ordinateur du logiciel Adobe Acrobat Reader.\nSi vous ne poss&eacute;dez pas ce logiciel cliquez sur : www.adobe.fr/products/acrobat/readstep.html pour le t&eacute;l&eacute;charger.\nCet email est g&eacute;n&eacute;r&eacute; par le logiciel LundiMatin Business disponible sur <a href='http://www.lundimatin.fr/'>www.lundimatin.fr</a>"},
																	evalScripts:true, 
																	onLoading:S_loading, onException: function () {S_failure();}, 
																	onComplete: function(requester) {
																						H_loading(); 
																						requester.responseText.evalScripts();

																					}
																	}
																	);
}, false);
			<?php 
		$i++;
	}
}
?>
Event.observe("email_perso", "mouseout",  function(){changeclassname ("email_perso", "complete_ville");}, false);

Event.observe("email_perso", "mouseover",  function(){changeclassname ("email_perso", "complete_ville_hover");}, false);

Event.observe("email_perso", "click",  function(){
	$("choix_send_mail").style.display="none";
	$("iframe_choix_send_mail").style.display="none";
	PopupCentrer("documents_editing_email.php?ref_doc=<?php echo  $document->getRef_doc(); ?>&mode_edition=2",580,450,"menubar=no,statusbar=no,scrollbars=yes,resizable=yes")
	
}, false);
//on masque le chargement
H_loading();

</script>