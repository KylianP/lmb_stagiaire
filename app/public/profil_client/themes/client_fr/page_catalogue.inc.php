<?php
// *************************************************************************************************************
// ACCUEIL DU VISITEUR
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
		<td>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="background-color:#330066">
			<tr style=" border:1px solid #bfbfbf;  background-color:#FFFFFF">
				<td>
				<div class="para"><span class="titre">Catalogue</span> <br />
				</div>
				<div>
				<table  border="0" cellspacing="3" cellpadding="0" class="catalogue">
					<tr>
						<td width="49%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
						<td width="2%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
						<td width="49%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
					</tr>	
					<?php 
					$row_tab= 0;
					$main_categorie = 0;
					foreach ($list_catalogue_dir as $catalogue_dir) {
						if ($catalogue_dir->indentation >2) {continue;}
						if ($catalogue_dir->indentation == 0) {
							if ($main_categorie == 2) {
								echo "...<br />";
							}
							if ($main_categorie) {
							$row_tab ++;
								echo "</td><td></td>";
							
								echo ($row_tab % 2)? "" : "</tr><tr><td colspan='3'><div style='height:18px'></div></td></tr><tr>";
							}
							?>
							<td>
							<div style="font-weight:bolder; display:block; width:100%">
							<a href="catalogue_liste_articles.php?id_catalogue_client_dir=<?php echo $catalogue_dir->id_catalogue_client_dir;?>"><?php echo htmlentities($catalogue_dir->lib_catalogue_client_dir);?></a>
							</div>
							<?php
							$main_categorie = 1;
						}
						if ($catalogue_dir->indentation == 1) {
							if ($main_categorie != 1) { echo ",";} else {echo "<div>";}
							
							?> <a href="catalogue_liste_articles.php?id_catalogue_client_dir=<?php echo $catalogue_dir->id_catalogue_client_dir;?>"><?php echo htmlentities($catalogue_dir->lib_catalogue_client_dir);?></a><?php
							
							$main_categorie = 2;
						}
					}
					?>
				</table>
				</div>
				</td>
			</tr>
		</table>
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
