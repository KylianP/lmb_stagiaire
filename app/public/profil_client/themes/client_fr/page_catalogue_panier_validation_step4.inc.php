<?php
// *************************************************************************************************************
// visualisation du panier
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
<script type="text/javascript">

</script>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td >
		<br />
		

		<div class="catalogue" style=" padding-left:45px; padding-right:45px">
		<div style=" background-color:#FFFFFF; " >
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td style=" vertical-align:bottom; width:8px">
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/_bg_icopanier_l.gif" />
				</td>
				<td>
						
				<div class="bg_ico_panier">
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/icone_panier.gif" />
				<div class="colorise0">
				</div>
				</div>
				</td>
				<td style=" vertical-align:bottom; width:8px">
				<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/_bg_icopanier_r.gif" />
				</td>
			</tr>
		</table>
	
		<table  width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="panier_text_etape">
				Votre commande
				</td>
				<td class="panier_text_etape">Coordonnées
				</td>
				<td class="panier_text_etape">Livraison
				</td>
				<td class="panier_text_etape">
				Validation
				</td>
				<td class="panier_text_etape">
				Confirmation
				</td>
			</tr>
			<tr >
				<td class="panier_line_etape">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/panier_grey_dot.gif" />
				</td>
				<td class="panier_line_etape">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/panier_grey_dot.gif" />
				</td>
				<td class="panier_line_etape">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/panier_grey_dot.gif" />
				</td>
				<td class="panier_line_etape">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/panier_grey_dot.gif" />
				</td>
				<td class="panier_line_etape">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/panier_white_dot.gif" />
				</td>
			</tr>
			<tr>
				<td class="panier_text_etape" colspan="5"><br />
<br />

				</td>
			</tr>
		</table>
		<br />
	
		<?php 
		$doc_cmm = "";
		$liste_liaisons = $panier->getLiaisons();
		if (isset($liste_liaisons['dest'][0])) { $doc_cmm = open_doc($liste_liaisons['dest'][0]->ref_doc_destination); }
		if (is_object($doc_cmm)) {
		?>
		<div style="padding-left:15px; padding-right:15px">
				<div >
				<p>Votre commande a bien été enregistrée, nous vous en remercions.<br />
				<br />
				Vous pouvez imprimer et consulter l'ensemble de vos  commandes et factures à partir de votre compte.</p>
				</div>
				
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="doc_intit_colors" style="width:25%">Référence</td>
								<td class="doc_intit_colors" style="width:25%" >Date</td>
								<td class="doc_intit_colors" style="width:25%">Etat</td>
								<td class="doc_intit_colors" style="width:25%; text-align:right; padding-right:55px">Montant</td>
								<td class="doc_intit_colors" style="width:25%">&nbsp;</td>
							</tr>
						</table>
						<br />

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="doc_infos_colors" style="width:25%"><?php echo $doc_cmm->getRef_doc();?></td>
						<td class="doc_infos_colors" style="width:25%" ><?php echo date_Us_to_Fr($doc_cmm->getDate_creation());?></td>
						<td class="doc_infos_colors" style="width:25%"><?php echo $doc_cmm->getLib_etat_doc();?></td>
						<td class="doc_infos_colors" style="width:25%; text-align:right; padding-right:55px"><?php echo number_format($doc_cmm->getMontant_ttc(), $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[1]; ?></td>
						<td class="doc_infos_colors" style="width:25%"><a href="documents_editing_print.php?ref_doc=<?php echo $doc_cmm->getRef_doc();?>&code_pdf_modele=<?php echo $CODE_PDF_MODELE_DEV;?>" target="_blank" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif"/></a> </td>
					</tr>
				</table><br />
<br />
<br />

		</div>
		<?php
			
		} else {
		?>
		Aucun panier n'est défini.
		<?php } ?>
		</div>
		</div>
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

