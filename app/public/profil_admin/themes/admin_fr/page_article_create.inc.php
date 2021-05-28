<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables n�cessaires � l'affichage
$page_variables = array ("_ALERTES");
check_page_variables ($page_variables, $articles_categories);



// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

echo "Cr�ation d'une fiche article<br><br>

<form action='' method='POST'>
<input type=hidden name='create' value='1'>";

// Affichage des erreurs
foreach ($_ALERTES as $alerte => $value) {
	echo $alerte." => ".$value."<br>";
}

echo "
<li><b>Libell� de l'article</b><br>
<textarea name='lib_article' rows=2 cols=50></textarea>
<br><br>

<li><b>Cat�gorie</b><br>
<select name='categorie'>";
	foreach ($articles_categories as $categorie) {
		echo "<option value='".$categorie->ref_art_categ."'> ";
		for ($i=0; $i<$categorie->indentation; $i++) { echo "-"; }
		echo $categorie->lib_art_categ."</option>";
	}
echo "</select>
<br><br>";

// Rajouter toutes les autres caracs

echo "
<input type=submit value='Cr�er la fiche de contact'>

</form>

<br><br><br>

<a href='".$DIR.$_SESSION['user']->getProfil_dir()."'>Retour � l'index Administrateur</a><br><br>

<a href='".$DIR."'>Retour � l'index principal</a> ";

?>