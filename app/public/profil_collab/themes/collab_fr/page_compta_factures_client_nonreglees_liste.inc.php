<?php

// *************************************************************************************************************
// AFFICHAGE DES FACTURES CLIENTS NON REGLEES
// *************************************************************************************************************

// Variables n?cessaires ? l'affichage
$page_variables = array ();
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************
// ------------------------------------------------------------------------
// barre_navigation
// ------------------------------------------------------------------------
function barre_navigation($nbtotal,
                          $nbenr, 
                          $cfg_nbres_ppage, 
                          $debut, 
													$cfg_nb_pages,
                          $idformtochange,
													$fonctiontolauch)
													
{
	// --------------------------------------------------------------------
	global $cfg_nb_pages; // Nb de n? de pages affich?es dans la barre
global $DIR;
	$barre= "";	$lien_on 	= "&nbsp;<a href='#' id='link_pagi_{cible}'>{lien}</a>&nbsp;
								<script type='text/javascript'>
								Event.observe('link_pagi_{cible}', 'click',  function(evt){Event.stop(evt); $(\"{idchange}\").value={cibleb}; {fonctionlauch};}, false);
								</script>";
	$lien_off = "&nbsp;{lien}&nbsp;";
	// --------------------------------------------------------------------
    

	// d?but << .
	// --------------------------------------------------------------------
	if ($debut >= $cfg_nbres_ppage)
	{
		$cible = 1;
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/gauche_on.gif');
		$lien = str_replace('{lien}', $image.$image, $lien_on);
		$lien = str_replace('{cible}', $cible-1, $lien);
		$lien = str_replace('{cibleb}', $cible, $lien);
		$lien = str_replace('{fonctionlauch}', $fonctiontolauch, $lien);
		$lien = str_replace('{idchange}', $idformtochange, $lien);
	}
	else
	{
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/gauche_off.gif');
		$lien = str_replace('{lien}', $image.$image, $lien_off);
	}
	$barre .= $lien."&nbsp;<strong>&middot;</strong>";


	// pr?c?dent < .
	// --------------------------------------------------------------------
	if ($debut >= $cfg_nbres_ppage)
	{
		$cible = ($nbenr-1);
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/gauche_on.gif');
		$lien = str_replace('{lien}', $image, $lien_on);
		$lien = str_replace('{cible}', $cible, $lien);
		$lien = str_replace('{cibleb}', $cible, $lien);
		$lien = str_replace('{fonctionlauch}', $fonctiontolauch, $lien);
		$lien = str_replace('{idchange}', $idformtochange, $lien);
	}
	else
	{
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/gauche_off.gif');
		$lien = str_replace('{lien}', $image, $lien_off);
	}
	$barre .= $lien."&nbsp;<B>&middot;</B>";
    

	// pages 1 . 2 . 3 . 4 . 5 . 6 . 7 . 8 . 9 . 10
	// -------------------------------------------------------------------

	if ($debut >= ($cfg_nb_pages * $cfg_nbres_ppage))
	{
		$cpt_fin = ($debut / $cfg_nbres_ppage) + 1;
		$cpt_deb = $cpt_fin - $cfg_nb_pages + 1;
	}
	else
	{
		$cpt_deb = 1;
        
		$cpt_fin = (int)($nbtotal / $cfg_nbres_ppage);
		if (($nbtotal % $cfg_nbres_ppage) != 0) $cpt_fin++;
        
		if ($cpt_fin > $cfg_nb_pages) $cpt_fin = $cfg_nb_pages;
	}

	for ($cpt = $cpt_deb; $cpt <= $cpt_fin; $cpt++)
	{
		if ($cpt == ($debut / $cfg_nbres_ppage) + 1)
		{
				$barre .= "<A CLASS='off'>&nbsp;".$cpt."&nbsp;</A> ";
		}
		else
		{				$barre .= "<a href='#' id='link_txt_".$cpt."";
				$barre .= "'>&nbsp;".$cpt."&nbsp;</a>
								<script type='text/javascript'>
								Event.observe('link_txt_".$cpt."', 'click',  function(evt){Event.stop(evt); $(\"".$idformtochange."\").value=".$cpt."; ".$fonctiontolauch.";}, false);
								</script>";
		}
	}
    

	// suivant . >
	// --------------------------------------------------------------------
	if ($debut + $cfg_nbres_ppage < $nbtotal)
	{
		$cible = ($nbenr+1);
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/droite_on.gif');
		$lien = str_replace('{lien}', $image, $lien_on);
		$lien = str_replace('{cible}', $cible, $lien);
		$lien = str_replace('{cibleb}', $cible, $lien);
		$lien = str_replace('{fonctionlauch}', $fonctiontolauch, $lien);
		$lien = str_replace('{idchange}', $idformtochange, $lien);
	}
	else
	{
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/droite_off.gif');
		$lien = str_replace('{lien}', $image, $lien_off);
	}
	$barre .= "&nbsp;<B>&middot;</B>".$lien;

	// fin . >>
	// --------------------------------------------------------------------
	$fin = ($nbtotal - ($nbtotal % $cfg_nbres_ppage));
	if (($nbtotal % $cfg_nbres_ppage) == 0) $fin = $fin - $cfg_nbres_ppage;

	if ($fin != $debut)
	{
		$cible = (int)($nbtotal/$cfg_nbres_ppage)+1;
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/droite_on.gif');
		$lien = str_replace('{lien}', $image.$image, $lien_on);
		$lien = str_replace('{cible}', $cible+1, $lien);
		$lien = str_replace('{cibleb}', $cible, $lien);
		$lien = str_replace('{fonctionlauch}', $fonctiontolauch, $lien);
		$lien = str_replace('{idchange}', $idformtochange, $lien);
	}
	else
	{
		$image = image_html(  $DIR.$_SESSION['theme']->getDir_theme().'images/droite_off.gif');
		$lien = str_replace('{lien}', $image.$image, $lien_off);
	}
	$barre .= "<B>&middot;</B>&nbsp;".$lien;
	return($barre);
}
// ------------------------------------------------------------------------
// image_html          
// ------------------------------------------------------------------------
function image_html($img)
{
    return '<img src="'.$img.'"    border="0" >';
}

//
//
//cr?ation de la barre de nav
//
//

	$cfg_nb_pages = 10;
	$barre_nav = "";
	$debut =(($form['page_to_show']-1)*$form['fiches_par_page']);
	
	$barre_nav .= barre_navigation($nb_fiches, $form['page_to_show'], 
                                       $form['fiches_par_page'], 
                                       $debut, $cfg_nb_pages,
                                       'page_to_show',
																			 'page.fact_topay_result()');






// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<script type="text/javascript">


dir_profil_fac_np = "<?php echo $_ENV['CHEMIN_ABSOLU'].$_SESSION['profils'][$_SESSION['user']->getId_profil ()]->getDir_profil();?>"

infos_niveau_relance = new Array();
array_menu_fnr_niveau	=	new Array();


	array_menu_fnr_niveau[0] 	=	new Array('fac_liste_content', 'menu_niv_0');
<?php 
$i = 1;
foreach ($liste_niveaux_relance as $niveau_relance) {
	?>
	infos_niveau_relance[<?php echo $niveau_relance->id_niveau_relance;?>] = "<?php echo htmlentities($niveau_relance->lib_niveau_relance);?>";
	array_menu_fnr_niveau[<?php echo $i;?>] 	=	new Array('fac_liste_content', 'menu_niv_<?php echo $i;?>');
	<?php 
	$i++;
}

$onglet_select = false;
?>
</script>
<div style="width:99%;">
<div style="text-align:right">
<span id="print_resultat" style="color:#000000; text-decoration:underline; cursor:pointer" >Imprimer la liste</span><br />
<span id="print_factures" style="color:#000000; text-decoration:underline; cursor:pointer" >Imprimer toutes les factures</span>
</div>
<script type="text/javascript">

Event.observe('print_resultat', "click", function(evt){
	Event.stop(evt);
	window.open("<?php echo $DIR.$_SESSION['profils'][$_SESSION['user']->getId_profil ()]->getDir_profil();?>compta_factures_client_nonreglees_imprimer.php?id_niveau_relance=<?php echo $niveau_relance_var;?>&id_client_categ=<?php echo $categorie_client_var;?>&orderorder="+$("orderorder").value+"&orderby="+$("orderby").value, "_blank");
});
Event.observe('print_factures', "click", function(evt){
	Event.stop(evt);
	window.open("<?php echo $DIR.$_SESSION['profils'][$_SESSION['user']->getId_profil ()]->getDir_profil();?>compta_factures_client_nonreglees_imprimer.php?id_niveau_relance=<?php echo $niveau_relance_var;?>&id_client_categ=<?php echo $categorie_client_var;?>&print_fact=1&orderorder="+$("orderorder").value+"&orderby="+$("orderby").value, "_blank");
});
</script>
<ul id="menu_recherche_niv" class="menu">

	<li id="doc_menu_niv_0">
		<a href="#" id="menu_niv_0" class="menu_<?php if ($niveau_relance_var) {echo "un"; }else {$onglet_select = true;}?>select">Non transmise (<?php echo count_niveau_factures_to_pay($categorie_client_var);?>)</a>
	</li>
<?php 
$i = 1;
foreach ($liste_niveaux_relance as $niveau_relance) {
	?>
	<li id="doc_menu_niv_<?php echo $i;?>">
		<a href="#" id="menu_niv_<?php echo $i;?>" class="menu_<?php if ($niveau_relance->id_niveau_relance != $niveau_relance_var) {echo "un"; }else {$onglet_select = true;}?>select"> <?php echo htmlentities($niveau_relance->lib_niveau_relance);?> (<?php echo htmlentities($niveau_relance->count_fact);?>)</a>
	</li>
	<?php
	$i++;
}
?>
</ul>

	<form action="#" id="fact_topay_result" name="fact_topay_result" method="GET" >
	<input type="hidden" name="id_client_categ" id="id_client_categ" value="<?php echo $categorie_client_var;?>" />
	<input type="hidden" name="id_niveau_relance" id="id_niveau_relance" value="<?php echo $niveau_relance_var;?>" />
	<input type="hidden" name="orderby" id="orderby" value="<?php echo $form['orderby'];?>" />
	<input type="hidden" name="orderorder" id="orderorder" value="<?php echo $form['orderorder'];?>" />
	<input type="hidden" name="page_to_show" id="page_to_show" value="<?php echo $form['page_to_show'];?>" />
	<input type="hidden" name="recherche" value="1" />
	</form>
	<div style="padding:10px">
	<div id="affresult">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="text-align:left;">R&eacute;sultat de la recherche :</td>
			<td id="nvbar"><?php echo $barre_nav;?></td>
			<td style="text-align:right;">R&eacute;ponse <?php echo $debut+1?> &agrave; <?php echo $debut+count($factures)?> sur <?php echo $nb_fiches?></td>
		</tr>
	</table>
	
	
	</div>
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="document_box_head">
			<tr>
				<td style="width:25px; height:24px; line-height:24px;" valign="middle">
					<div style="width:25px;">
					
					</div>
				</td>
				<td style="font-weight:bolder; width:118px">
				R&eacute;f&eacute;rence
				</td>
				<td style="font-weight:bolder;text-align:left;">
				<a href="#"  id="order_ref_contact" style="color:#000000">
				Client
				</a>
				</td>
				<td style="font-weight:bolder; text-align:center; width:90px;">
				<a href="#"  id="order_date_creation" style="color:#000000">
				Cr&eacute;ation
				</a>
				</td>
				<td style="font-weight:bolder; text-align:center; width:130px;">
				Niveau relance
				</td>
				<td style="font-weight:bolder; text-align:center; width:110px;">
				Ech&eacute;ance<br />
				Date de relance
				</td>
				<td style="font-weight:bolder; width:100px; text-align:right">
				<a href="#"  id="order_montant" style="color:#000000">
				Montant<br />
				restant d?
				</a>
				</td>
				<td style="font-weight:bolder; width:70px; text-align:right;">
				<div style="padding-right:1px">
				Magasin
				</div>
				</td>
				<td class="document_border_right" style="width:95px; text-align:right">&nbsp;
				
				</td>
			</tr>
		</table><br />
	<?php
	if (count($factures)){
		?>
		<ul id ="factures_<?php echo $factures[0]->id_niveau_relance?>" style="width:100%">
	<?php
	$indentation = 0;
	$groupe_by_relance = $factures[0]->id_niveau_relance;
	foreach ($factures as $facture) {
		if ($groupe_by_relance != $facture->id_niveau_relance && $indentation != 0) {
		
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="">
				<tr>
					<td rowspan="2" style="width:33px">
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/arrow_ltr.png" />
					</td>
					<td style="height:4px; line-height:4px">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="4px" width="100%"/>
					</td>
					<td style="height:4px; line-height:4px">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="4px" width="100%"/>
					</td>
				</tr>
				<tr>
					<td style="width:325px;">
						<a href="#" id="all_coche_<?php echo $groupe_by_relance?>" class="doc_link_simple">Tout cocher</a> / <a href="#" id="all_decoche_<?php echo $groupe_by_relance?>" class="doc_link_simple">Tout d&eacute;cocher</a> / <a href="#" id="all_inv_coche_<?php echo $groupe_by_relance?>" class="doc_link_simple">Inverser la s&eacute;lection</a> 
					</td>
					<td style="" >
						<select id="coche_action_<?php echo $groupe_by_relance?>" name="coche_action_<?php echo $groupe_by_relance?>" class="classinput_nsize">
							<option value="">Pour la s&eacute;lection</option>
							<option value="0">Non transmise</option>
							<?php 
							foreach ($liste_niveaux_relance as $niveau_relance) {
								?>
								<option value="<?php echo $niveau_relance->id_niveau_relance;?>"><?php echo htmlentities($niveau_relance->lib_niveau_relance);?></option>
								<?php
							}
							?>
							<OPTGROUP disabled="disabled" label="_____________________________" ></OPTGROUP>
							<option value="print">Imprimer</option>
						</select>
					</td>
				</tr>
			</table><br />
			<script type="text/javascript">
			prestart_coche_liste_fac_np("<?php echo $groupe_by_relance?>");			
			
Event.observe("coche_action_<?php echo $groupe_by_relance?>", "change", function(evt){
	if ($("coche_action_<?php echo $groupe_by_relance?>").value != "") {
		action_FAC_np($("coche_action_<?php echo $groupe_by_relance?>").value, "" , "factures_");
	}
});
			</script>
			</ul>
			<?php
			$groupe_by_relance = $facture->id_niveau_relance;
			?>
			<ul id ="factures_<?php echo $groupe_by_relance?>" style="width:100%">
			<?php
		}
		?>
		<li id="lifactures_<?php echo $indentation;?>" class="" style="height:34px; line-height:34px; width:100%">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="document_box_head">
			<tr>
				<td style="width:25px; height:24px; line-height:24px;" valign="middle">
					<div style="width:25px;">
						<input id="check_<?php echo $indentation;?>" name="check_<?php echo $indentation;?>" type="checkbox" value="check_line"/>
						<input id="refdoc_<?php echo $indentation;?>" name="refdoc_<?php echo $indentation;?>" type="hidden" value="<?php echo htmlentities($facture->ref_doc);?>"/>
					</div>				</td>
				<td style="width:118px">
				<a href="#" id ="<?php echo htmlentities($facture->ref_doc);?>" style="text-decoration:none; color:#000000; font-size:10px">
				<?php echo htmlentities($facture->ref_doc);?><br />
				<span <?php if ($facture->id_etat_doc == 16) {?>style="color:#FF0000"<?php } ?>>
				<?php echo htmlentities(($facture->lib_etat_doc));?>				</span>				</a>
				</td>
				<td style="font-weight:bolder;text-align:left;">
				<a href="#" id ="<?php echo htmlentities($facture->ref_doc);?>ctc" style="text-decoration:none; color:#000000;<?php if($facture->ref_contact == "") {?> cursor:default<?php } ?>"><?php  echo htmlentities(substr($facture->nom_contact, 0 , 42));?>...
				</a>&nbsp;
				</td>
				<td style=" text-align:center; width:90px;">
				<?php echo htmlentities(date_Us_to_Fr($facture->date_creation));?>
				</td>
				<td style=" text-align:center; width:130px;">
				<div id="niveau_relance_<?php echo $indentation;?>" style="cursor:pointer">
				<?php 
				if ($facture->id_niveau_relance != NULL) {
					?>
				<?php echo htmlentities(($facture->lib_niveau_relance));?>
					<?php } else { ?>
					Non transmise
					<?php 
				}
				?>
				</div>
				<div style="position:relative;top:0px; left:0px; width:100%;">
				<div id="choix_niveau_relance_<?php echo $indentation;?>" style="display:none; text-align: left; border:1px solid #000000; background-color:#FFFFFF; position: absolute; left:0px; width:180px">
				<a class="choix_etat" id="choix_niveau_relance_0_<?php echo $indentation;?>">Non transmise</a>
					
				<?php 
				foreach ($liste_niveaux_relance as $niveau_relance) {
					?>
					<a class="choix_etat" id="choix_niveau_relance_<?php echo $niveau_relance->id_niveau_relance;?>_<?php echo $indentation;?>"><?php echo htmlentities($niveau_relance->lib_niveau_relance);?></a>
					<?php
				}
				?>
				<script type="text/javascript">
				<?php 
				foreach ($liste_niveaux_relance as $niveau_relance) {
					?>
					prestart_choix_niveau_relance ("<?php echo $niveau_relance->id_niveau_relance;?>", "<?php echo $indentation;?>", "<?php echo htmlentities($facture->ref_doc)?>", infos_niveau_relance[<?php echo $niveau_relance->id_niveau_relance;?>]);
					<?php
				}
				?>
				</script>
				</div>
				</div>
				<script type="text/javascript">
					prestart_ligne_fac_np (dir_profil_fac_np+"#","<?php echo htmlentities($facture->ref_doc);?>",  "<?php echo ($facture->ref_contact)?>", "<?php echo $indentation;?>");
				</script>
				</td>
				<td style=" text-align:center; width:110px;">
				<span style="<?php
														if (round(strtotime($facture->date_echeance)-strtotime(date("c")))<0) {?> color:#FF0000;<?php }
														 ?>">
				<?php echo htmlentities(date_Us_to_Fr($facture->date_echeance));?>				</span><br />

				<?php echo htmlentities(date_Us_to_Fr($facture->date_next_relance));?></td>
				<td style="width:100px; text-align:right">&nbsp;
				
				<?php echo (number_format($facture->montant_ttc, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[1]);?></td>
				<td style="width:60px; text-align:right; padding-right:10px">&nbsp;
				
				<?php echo  htmlentities(($facture->abrev_magasin));?>				</td>
				<td class="document_border_right" style="width:95px; text-align:right">
				
					 <a href="#" id="mail_doc_<?php echo $facture->ref_doc?>" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-email-doc.gif"/></a> 
					 <a href="documents_editing.php?ref_doc=<?php echo $facture->ref_doc?>" target="_blank" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-pdf.gif"/></a> 
					<a href="documents_editing.php?ref_doc=<?php echo $facture->ref_doc?>&print=1" target="_blank" ><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/icone_imprime.gif" alt="Imprimer" title="Imprimer"/></a>
				
					<script type="text/javascript">
					Event.observe("mail_doc_<?php echo $facture->ref_doc?>", "click", function(evt){
					Event.stop(evt);
					var top=(screen.height-350)/2;
					var left=(screen.width-500)/2;
 					window.open("documents_editing_email.php?ref_doc=<?php echo $facture->ref_doc?>&mode_edition=2","","top="+top+",left="+left+",width=500,height=350,menubar=no,statusbar=no,scrollbars=yes,resizable=yes");
					});		
					</script>
				</td>
			</tr>
		</table>
		<br />
		</li>
		<?php 
	$indentation++;
	}
		?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="">
				<tr>
					<td rowspan="2" style="width:33px">
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/arrow_ltr.png" />
					</td>
					<td style="height:4px; line-height:4px">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="4px" width="100%"/>
					</td>
					<td style="height:4px; line-height:4px">
					<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" height="4px" width="100%"/>
					</td>
				</tr>
				<tr>
					<td style="width:325px;">
						<a href="#" id="all_coche_<?php echo $facture->id_niveau_relance?>" class="doc_link_simple">Tout cocher</a> / <a href="#" id="all_decoche_<?php echo $facture->id_niveau_relance?>" class="doc_link_simple">Tout d&eacute;cocher</a> / <a href="#" id="all_inv_coche_<?php echo $facture->id_niveau_relance?>" class="doc_link_simple">Inverser la s&eacute;lection</a> 
					</td>
					<td style="" >
						<select id="coche_action_<?php echo $facture->id_niveau_relance?>" name="coche_action_<?php echo $groupe_by_relance?>" class="classinput_nsize">
							<option value="">Pour la s&eacute;lection</option>
							<option value="0">Non transmise</option>
							<?php 
							foreach ($liste_niveaux_relance as $niveau_relance) {
								?>
								<option value="<?php echo $niveau_relance->id_niveau_relance;?>"><?php echo htmlentities($niveau_relance->lib_niveau_relance);?></option>
								<?php
							}
							?>
							<OPTGROUP disabled="disabled" label="_____________________________" ></OPTGROUP>
							<option value="print">Imprimer</option>
						</select>
					</td>
				</tr>
			</table><br />
			<script type="text/javascript">
			prestart_coche_liste_fac_np("<?php echo $facture->id_niveau_relance?>");	
Event.observe("coche_action_<?php echo $groupe_by_relance?>", "change", function(evt){
	if ($("coche_action_<?php echo $groupe_by_relance?>").value != "") {
		action_FAC_np($("coche_action_<?php echo $groupe_by_relance?>").value, "" , "factures_<?php echo $groupe_by_relance?>");
	}
});		
			</script>
		<?php
		}
	?>
	</ul>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="document_box_head">
			<tr>
				<td style="width:25px; height:24px; line-height:24px;" valign="middle">
					<div style="width:25px;">
					
					</div>
				</td>
				<td style="font-weight:bolder; width:118px">&nbsp;
				</td>
				<td style="font-weight:bolder;text-align:left;">&nbsp;
				</td>
				<td style="font-weight:bolder; text-align:center; width:90px;">&nbsp;
				</td>
				<td style="font-weight:bolder; text-align:right; width:240px;">&nbsp;
				Montant Total d?: 
				</td>
				<td style="font-weight:bolder; width:100px; text-align:right">
				<?php echo(number_format($factures_total, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[1]);?>
				</td>
				<td style="font-weight:bolder; width:70px; text-align:right;">&nbsp;
				</td>
				<td class="document_border_right" style="width:95px; text-align:right">&nbsp;
				
				</td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript">

Event.observe("order_date_creation", "click",  function(evt){Event.stop(evt);$('orderby').value='date_creation'; $('orderorder').value='<?php if ($form['orderorder']=="ASC" && $form['orderby']=="date_creation") {echo "DESC";} else {echo "ASC";}?>'; page.fact_topay_result();}, false);

Event.observe("order_ref_contact", "click",  function(evt){Event.stop(evt);$('orderby').value='nom_contact'; $('orderorder').value='<?php if ($form['orderorder']=="ASC" && $form['orderby']=="nom_contact") {echo "DESC";} else {echo "ASC";}?>'; page.fact_topay_result();}, false);

Event.observe("order_montant", "click",  function(evt){Event.stop(evt);$('orderby').value='montant_ttc'; $('orderorder').value='<?php if ($form['orderorder']=="ASC" && $form['orderby']=="montant_ttc") {echo "DESC";} else {echo "ASC";}?>'; page.fact_topay_result();}, false);


Event.observe('menu_niv_0', "click", function(evt){
	view_menu_1('fac_liste_content', 'menu_niv_0', array_menu_fnr_niveau);
	load_facture_nonreglees ("<?php echo $categorie_client_var;?>" , "");
	Event.stop(evt);
});
<?php 
$i = 1;
foreach ($liste_niveaux_relance as $niveau_relance) {
	?>
	Event.observe('menu_niv_<?php echo $i;?>', "click", function(evt){
		view_menu_1('fac_liste_content', 'menu_niv_<?php echo $i;?>', array_menu_fnr_niveau);
		load_facture_nonreglees ("<?php echo $categorie_client_var;?>" , "<?php echo $niveau_relance->id_niveau_relance;?>");
		Event.stop(evt);
});
	<?php
	$i++; 
}
?>
//on masque le chargement
H_loading();
</script>