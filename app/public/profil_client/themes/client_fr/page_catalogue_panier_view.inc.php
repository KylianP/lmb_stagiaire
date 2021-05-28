<?php
// *************************************************************************************************************
// visualisation du panier
// *************************************************************************************************************

$Montant_ht = $Montant_ttc = 0;
				
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

//maj de la qte
function maj_line_qte (qte_article, ref_article, indentation) {
	var AppelAjax = new Ajax.Request(
									"catalogue_panier_line_maj_qte.php", 
									{
									parameters: {ref_article: ref_article, qte_article: qte_article, indentation: indentation },
									evalScripts:true,
									onComplete: function () {
												window.open("catalogue_panier_view.php", "_self");
									}
									}
									);
}


//masque de saisie numérique
function nummask(evt, val_def, masque) {
// masque type:
// X.X (nombre flotant
// X.XX nombre à deux desimales
// X nombre entier
// X;X masque de tableau 1;25;50
var to_return = false;
var array_num=new Array;
var id_field = Event.element(evt);
var field_value = id_field.value;
var u_field_num = Array.from(field_value);
var result="";

switch(masque) {
 case "X.X":
	var firstdot= false;
	for( i=0; i < u_field_num.length; i++ ) {
		if ((!isNaN(u_field_num[i]) || u_field_num[i]=="," || u_field_num[i]=="." || u_field_num[i]=="-") && u_field_num[i]!=" "){
			if ((u_field_num[i]=="," || u_field_num[i]==".") && firstdot==false) {
			array_num.push(".");
			firstdot=true;
			} else {
  	 	array_num.push(u_field_num[i]);
		 }
		}
	}
	if ($(id_field.id)) {
	$(id_field.id).value=array_num.toString().replace(/,/g,"");
	}
 break;


}
	
	if ($(id_field.id) && $(id_field.id).value=="") {$(id_field.id).value=val_def; to_return = false;} else {to_return  = true;}
	return to_return;
}

//sup ligne
function doc_sup_line (ref_article) {
	var AppelAjax = new Ajax.Request(
									"catalogue_panier_line_sup.php", 
									{
									parameters: {ref_article: ref_article},
									evalScripts:true,
									onComplete: function () {
												window.open("catalogue_panier_view.php", "_self");
									}
									}
									);
}

//suppression d'une balise
function remove_tag(id_balise) {
		Element.remove($(id_balise));
}
</script>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td>
		<br />
		<br />

		<div class="catalogue" style="background-color:#FFFFFF; padding-left:45px; padding-right:45px">
		<div style=" padding:15px">
		<div class="bg_ico_panier">
		<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/icone_panier.gif" />
		<div class="colorise0">
		</div>
		</div>
		<?php
		if (!count($liste_contenu)) {
			?>
			<div style="background-color:#FFFFFF"><br />

			Votre panier est vide.<br /><br />


			</div>
			<?php
			
		} else {
			?>
			<table  width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="panier_text_etape">
					Votre commande
					</td>
					<td class="panier_text_etape">
					Identification
					</td>
					<td class="panier_text_etape">
					Livraison
					</td>
					<td class="panier_text_etape">
					Paiement
					</td>
					<td class="panier_text_etape">
					Confirmation
					</td>
				</tr>
				<tr >
					<td class="panier_line_etape">
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/panier_white_dot.gif" />
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
						<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/panier_grey_dot.gif" />
					</td>
				</tr>
				<tr>
					<td class="panier_text_etape" colspan="5"><br />

			<br />
					</td>
				</tr>

			</table>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="colorise0">
				<tr>
					<td style="width:28px;" class="colorise0_debut" >
						<div style="width:28px;">
						</div>
					</td>
					<td style=" width:10%" >
						<div >
						Référence
						</div>
					</td>
					<td style="padding-left:3px">
						<div >
						Description
						</div>
					</td>
					<td style=" text-align:center; width:10%">
						<div >
						Qté
						</div>
					</td>	
					<td  style=" text-align:center; width:10%">
						<div >
						Dispo
						</div>
					</td>
					<td style="width:15%; text-align:right;">
						<div style="text-align:right; font-weight:bolder;">Prix Unitaire <?php echo $_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]["app_tarifs"];?>
						</div>
					</td>	
					<td style="width:15%; text-align:right;">
						<div style="text-align:right; font-weight:bolder;">Prix Total <?php echo $_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]["app_tarifs"];?>
						</div>
					</td>	
					<td style="text-align:right;width:5%">&nbsp;
					
					</td>
					<td style="text-align:right;width:5%" class="colorise0_fin" >&nbsp;
					
					</td>
				</tr>
			</table>
			<?php
		}
		?>
		<ul id="lignes" style="padding:0px; width:100%">
		<?php 
		$indentation_contenu = 0;
		foreach ($liste_contenu as $contenu) {
			?>
			<li id="<?php echo $indentation_contenu;?>" class="colorise_td_deco">
				<?php include $DIR.$_SESSION['theme']->getDir_theme()."page_panier_line_".$contenu->type_of_line.".inc.php" ?>
			</li>
			<?php
				$Montant_ht +=  number_format( interface_article_pv ($contenu->article, $contenu->qte)*$contenu->qte, $TARIFS_NB_DECIMALES, ".", ""	);
				
				$Montant_ttc +=  number_format(( interface_article_pv ($contenu->article, $contenu->qte)*(1+$contenu->article->getTva()/100))*$contenu->qte, $TARIFS_NB_DECIMALES, ".", ""	);

			$indentation_contenu++;
		}
		?>
		</ul>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="colorise0">
				<tr>
					<td style="width:28px;">
						<div style="width:28px;">
						</div>
					</td>
					<td style="width:10%">&nbsp;
					
					</td>
					<td style="padding-left:3px">
					</td>
					<td style="width:10%">
					</td>
					<td style="width:10%">
					</td>
					<td style="width:15%" colspan="2">
						<div style="text-align:right; padding-top:3px; padding-bottom:5px;">
						<span class="price_smaller">Prix Total HT:</span><br />
						<span class="price_smaller">Total T.V.A.:</span><br />
						<span class="price_bigger">Prix Total TTC:</span><br />
						</div>
					</td>	
					<td style="width:15%; text-align:right; padding-top:3px; padding-bottom:5px;" >
					<?php if ((!$_SESSION['user']->getLogin() && $AFF_CAT_PRIX_VISITEUR) || ($_SESSION['user']->getLogin() && $AFF_CAT_PRIX_CLIENT)) {?>
						<div style="text-align:right; ">
						<span class="price_smaller"><?php echo price_format($Montant_ht)."&nbsp;".$MONNAIE[1];?></span><br />
						<span class="price_smaller"><?php echo price_format($Montant_ttc-$Montant_ht)."&nbsp;".$MONNAIE[1];?></span><br />
						<span class="price_bigger"><?php echo price_format($Montant_ttc)."&nbsp;".$MONNAIE[1];?></span><br />
						</div>
						<?php }?>
					</td>	
					<td style="width:5%">
					</td>
					<td style="width:5%">
					</td>
				</tr>
			</table>
		</ul>
		<input type="hidden" value="<?php echo $indentation_contenu;?>" id="indentation_contenu" name="indentation_contenu"/>
<br /><span style="float:right">
		<a href="catalogue_panier_validation_step1.php">Valider mon panier</a> >>
		</span><br />
		
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

