<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables nécessaires à l'affichage
$page_variables = array ();
check_page_variables ($page_variables);



// *************************************************************************************************************
// AFFICHAGE
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" style="height:150px; width:500px">
		
		
		<br />
		<br />
		<div class="para"  style="text-align:center; margin:20px 0px;">
		<br />
		<br />

		<div style="width:500px;	margin:0px auto;">
		
			<table border="0" cellspacing="0" cellpadding="0" style="background-color:#FFFFFF">
				<tr>
					<td class="lightbg_liste1">&nbsp;</td>
					<td class="lightbg_liste"></td>
					<td class="lightbg_liste2">&nbsp;</td>
				</tr>
				<tr>
					<td class="lightbg_liste">&nbsp;</td>
					<td class="lightbg_liste">
					<div class="title_content" style="text-align:right">MODIFICATION DE VOS DONNEES PERSONNELLES <img  src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/icone_contact.gif" style="vertical-align:text-bottom"/> </div>
					<br />
					<br />
					
				<div style="text-align:left">
					Félicitation, votre identité a été confirmée avec succès !<br />
					L'un de nos collaborateurs va prochainement valider votre fiche. Vous recevrez un email de confirmation prochainement.


					</div>
		
					<td class="lightbg_liste">&nbsp;</td>
				</tr>
				<tr>
					<td class="lightbg_liste4"></td>
					<td class="lightbg_liste">&nbsp;</td>
					<td class="lightbg_liste3">&nbsp;</td>
				</tr>
			</table>
		</div>
		<br />
		<br />
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

