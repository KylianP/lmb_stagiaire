<?php

// *************************************************************************************************************
// EDITION D'UNE TACHE
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

if (!$reglement->getRef_reglement()) {
	?>
	<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" id="close_reglement_edit" style="cursor:pointer; float:right" alt="Fermer" title="Fermer" />
	<span style="font-weight:bolder">Ce règlement n'existe pas ou a été supprimé</span>
	
	<SCRIPT type="text/javascript">
		
	Event.observe("close_reglement_edit", "click", function(evt){
	$("edition_reglement").innerHTML="";
	$("edition_reglement").hide();
	$("edition_reglement_iframe").hide();
	}, false);
	
	//on masque le chargement
	H_loading();
	</SCRIPT>
	<?php 
	exit();
}
?>
<script type="text/javascript">
</script>

<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" id="close_reglement_edit" style="cursor:pointer; float:right" alt="Fermer" title="Fermer" />
<span style="font-weight:bolder">Edition d'un règlement</span><br />
<br />

<table width="100%" border="0">
	<tr>
		<td style="width:50%; border:1px solid #d2d2d2;">	
			<table width="100%" border="0">
				<tr>
					<td style=" text-align:left; padding-left:10px; font-size:10px; width:20%;">
					<?php echo htmlentities($reglement->getLib_reglement_mode ()); ?>
					</td>
					<td style=" text-align:center; font-size:10px;"> le :
					<?php 
					if ($reglement->getDate_reglement ()!= 0000-00-00) {
						echo htmlentities ( date_Us_to_Fr ($reglement->getDate_reglement ()));
					}
					?>
					</td>
					<td style=" text-align:left; font-size:10px; ">
					<?php echo price_format($reglement->getMontant_reglement ())." ".$MONNAIE[1]; ?> r&eacute;gl&eacute;s<br />

					<?php echo number_format($reglement->getMontant_disponible (), $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[1];  ?> non attribués
					
					</td>
					<td style=" text-align:center; font-size:10px;">
					</td>
					<td style=" text-align:right; padding-right:10px; font-size:10px; width:20%; ">
					<form method="post" action="compta_reglements_sup.php" id="compta_reglements_sup_<?php echo $reglement->getRef_reglement(); ?>" name="compta_reglements_sup_<?php echo $reglement->getRef_reglement(); ?>" target="formFrame">
					<?php 
					if (isset($ref_contact)) {
						?>
						<input name="ref_contact_<?php echo $reglement->getRef_reglement(); ?>" id="ref_contact_<?php echo $reglement->getRef_reglement(); ?>" type="hidden" value="<?php echo $ref_contact; ?>" />
						<?php
					}
					?>
					<?php 
					if (isset($ref_doc)) {
						?>
						<input name="ref_doc_<?php echo $reglement->getRef_reglement(); ?>" id="ref_doc_<?php echo $reglement->getRef_reglement(); ?>" type="hidden" value="<?php echo $ref_doc; ?>" />
						<?php
					}
					?>
					<input name="ref_reglement" id="ref_reglement" type="hidden" value="<?php echo $reglement->getRef_reglement(); ?>" />
					</form>
					<a href="#" id="link_compta_reglements_sup_<?php echo $reglement->getRef_reglement(); ?>"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0"></a>
					<script type="text/javascript">
					Event.observe("link_compta_reglements_sup_<?php echo $reglement->getRef_reglement(); ?>", "click",  function(evt){Event.stop(evt); alerte.confirm_supprimer('documents_reglements_sup', 'compta_reglements_sup_<?php echo $reglement->getRef_reglement(); ?>');}, false);
					</script>
					</td>
				</tr>
		</table><br />
<br />

		<form action="compta_reglement_maj.php" method="post" id="compta_reglement_maj" name="compta_reglement_maj" target="formFrame" >
	<table border="0" cellspacing="0" cellpadding="0" style="width:100%; display:none">
		<tr>
			<td style="width:55%">
			<input id="id_reglement_mode" name="id_reglement_mode" value="<?php echo $reglement->getId_reglement_mode(); ?>" type="hidden" />
			
				<input id="ref_contact" name="ref_contact" value="<?php if (isset($ref_contact)) { echo $ref_contact; }	?>" type="hidden" /> 
				
			<?php 
			foreach ($lettrages as $lettrage) {
				?>
				<input name="docs_<?php echo $lettrage->ref_doc; ?>" id="docs_<?php echo $lettrage->ref_doc; ?>" value="<?php echo $lettrage->ref_doc; ?>" type="text" />
				<?php
			}
			?>
			<input id="direction_reglement" name="direction_reglement" value="<?php echo $reglement->getType_reglement ();?>" type="hidden" />			 
			Montant:
			</td>
			<td><input id="montant_reglement" name="montant_reglement" value="<?php echo price_format($reglement->getMontant_reglement ()); ?>" type="text" class="classinput_xsize" /></td>
		</tr>
			<tr>
				<td>
				Date règlement : 
				</td>
				<td>
				<input id="date_reglement" name="date_reglement" value="<?php echo date_Us_to_Fr($reglement->getDate_reglement ());?>" type="text" class="classinput_xsize"/> 
				</td>
			</tr>
			<tr>
				<td>
				Date échéance : 
				</td>
				<td>
			<input id="date_echeance" name="date_echeance" value="<?php if ($reglement->getDate_echeance ()) { echo date_Us_to_Fr($reglement->getDate_echeance ());}?>" type="text" class="classinput_xsize" />

				</td>
			</tr>
		<?php 
		foreach ($reglements_infos as $inf=>$val) {
			if ($inf == "ref_reglement") {continue;}
			?>
			<tr>
				<td>
				<?php echo $inf;?> : 
				</td>
				<td>
				<input id="<?php echo $inf;?>" name="<?php echo $inf;?>" value="<?php echo $val; ?>" type="text" class="classinput_xsize" />
				</td>
			</tr>
			<?php
		}?>
			<tr>
				<td>
				</td>
				<td>
		<input type="hidden" value="<?php echo $reglement->getRef_reglement();?>" id="ref_reglement" name="ref_reglement" />
		<input type="image" src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-modifier.gif" />
				</td>
			</tr>
		</table>
		</form>
		</td>
		<td style="width:35px">&nbsp;
		</td>
		<td >
		<span style=" font-weight:bolder">Liste des documents liés à ce règlement</span>
		<div style=" background-color:#FFFFFF; border:1px solid #d6d6d6;">
		
			<?php
			$indentation_lettrage = 0;
			foreach ($lettrages as $lettrage) {
				?>
		<table width="100%" border="0"  cellspacing="0" id="view_doc_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>">
			<tr>
				<td style="width:25%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				<td style="width:45%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				<td style="width:20%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
				<td style=""><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
			</tr>
				<tr>
					<td style="font-size:10px; cursor:pointer" id="doc1_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>">
					
					</td>
					<td style="font-size:10px; cursor:pointer; <?php if (!$lettrage->liaison_valide) {echo 'color:#CCCCCC;';}?>" id="doc2_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>">
					<?php echo $lettrage->ref_doc;?>
					</td>
					<td style="text-align:right; font-size:11px; padding-right:10px;  cursor:pointer" id="doc3_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>">
					<?php	if ($lettrage->montant) { echo number_format($lettrage->montant, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[1]; }?>
					</td>
					<td style="padding-left:11px">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/unlink.gif" border="0" style="cursor:pointer" id="unlink_doc1_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>">
					</td>
				</tr>
				<tr>
					<td colspan="4"><div style="height:8px; line-height:8px; border-bottom:1px solid #d6d6d6;"></div>
					<script type="text/javascript">
					Event.observe('doc1_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>', "click", function(evt){
						page.verify ('document_edition_fac','index.php#'+escape('documents_edition.php?ref_doc=<?php echo $lettrage->ref_doc; ?>'),'true','_blank');
					});
					Event.observe('doc2_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>', "click", function(evt){
						page.verify ('document_edition_fac','index.php#'+escape('documents_edition.php?ref_doc=<?php echo $lettrage->ref_doc; ?>'),'true','_blank');
					});
					Event.observe('doc3_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>', "click", function(evt){
						page.verify ('document_edition_fac','index.php#'+escape('documents_edition.php?ref_doc=<?php echo $lettrage->ref_doc; ?>'),'true','_blank');
					});
					
					Event.observe('unlink_doc1_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>', "click", function(evt){
						unlink_doc_to_reglement ('<?php echo $lettrage->ref_doc;?>', '<?php echo $reglement->getRef_reglement();?>', 'view_doc_<?php echo $indentation_lettrage;?>_<?php echo $lettrage->ref_doc;?>', '<?php if (isset($ref_doc)) { echo $ref_doc; } ?>', '<?php if (isset($ref_contact)) { echo $ref_contact; } ?>');
					});
					</script>
					</td>
				</tr>
			</table>
				<?php
			$indentation_lettrage++;
			}
			?>
		</div>
		</td>
	</tr>
</table>

<SCRIPT type="text/javascript">
	
Event.observe("close_reglement_edit", "click", function(evt){
$("edition_reglement").innerHTML="";
$("edition_reglement").hide();
$("edition_reglement_iframe").hide();
}, false);


$("edition_reglement").show();
$("edition_reglement_iframe").show();
//on masque le chargement
H_loading();
</SCRIPT>