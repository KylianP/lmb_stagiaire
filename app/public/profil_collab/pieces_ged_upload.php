<?php
// *************************************************************************************************************
// AJOUT DES PIECES JOINTES D'UN OBJET
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

ini_set("memory_limit","40M");
//**************************************
// Controle
$erreur = "";

  
// on teste si le formulaire permettant d'uploader un fichier a �t� soumis  
if (isset($_POST['add_pie'])) { 
	// on teste si le champ permettant de soumettre un fichier est vide ou non 
	if (empty($_FILES['pie']['tmp_name']) && $_REQUEST["url_pie"] == "" && $_REQUEST["url_pie2"] == "") { 
		 // si oui, on affiche un petit message d'erreur 
		 $erreur = 'Aucun fichier envoy�.'; 
	} else {
		if (!empty($_FILES['pie']['tmp_name'])) {
			$extension = substr($_FILES["pie"]["name"], strrpos($_FILES["pie"]["name"], "."));
			$lib_piece = $_FILES["pie"]["name"];
			if (!substr_count($extension,"php")) {	 
			
				 $file_upload = md5(uniqid(rand(), true)).$extension;
				 if (is_file($GED_DIR.$file_upload)) {$file_upload = md5(uniqid(rand(), true)).$extension; }
				 
	
				 // on copie le fichier que l'on vient d'uploader dans le r�pertoire des images de grande taille 
				 if (!empty($_FILES['pie']['tmp_name'])) {
					copy ($_FILES['pie']['tmp_name'], $GED_DIR.$file_upload); 
				 } 
	
			} else { 
				 // si notre image n'est pas de type jpeg ou png, on supprime le fichier upload� et on affiche un petit message d'erreur 
				 unlink($_FILES['pie']['tmp_name']); 
				 $erreur = 'Votre fichier est d\'un format non support�.'; 
			} 
		}elseif(!empty($_REQUEST["url_pie"])){
			$extension = substr($_REQUEST["url_pie"], strrpos($_REQUEST["url_pie"], "."));
			$lib_piece = substr($_REQUEST["url_pie"], strrpos($_REQUEST["url_pie"], "/")+1);
			if (!substr_count($extension,"php")){
				$file_upload = md5(uniqid(rand(), true)).$extension;
				if (is_file($GED_DIR.$file_upload)){
					$file_upload = md5(uniqid(rand(), true)).$extension;
				}
				
				// on copie le fichier que l'on vient d'uploader dans le r�pertoire 
				if (!empty($_REQUEST["url_pie"])) {
					copy ($_REQUEST["url_pie"], $GED_DIR.$file_upload);
				}
			} else {
				// si notre image n'est pas de type jpeg ou png, on supprime le fichier upload� et on affiche un petit message d'erreur 
				unlink($_REQUEST["url_pie"]);
				$erreur = 'Votre fichier est d\'un format non support�.';
			}
		}else{
			$fichier = $GED_TMP_DIR.$_REQUEST["url_pie2"];
			$extension = substr($fichier, strrpos($fichier, "."));
			$lib_piece = substr($fichier, strrpos($fichier, "/")+1);
			if (!substr_count($extension,"php")){
				$file_upload = md5(uniqid(rand(), true)).$extension;
				if (is_file($GED_DIR.$file_upload)){
					$file_upload = md5(uniqid(rand(), true)).$extension;
				}
				
				// on copie le fichier que l'on vient d'uploader dans le r�pertoire 
				if (!empty($fichier)) {
					copy ($fichier, $GED_DIR.$file_upload);
				}
			} else {
				// si notre image n'est pas de type jpeg ou png, on supprime le fichier upload� et on affiche un petit message d'erreur 
				unlink($fichier);
				$erreur = 'Votre fichier est d\'un format non support�.';
			}
		}
	}  
}  

if (isset($file_upload)) {
	add_ged ($file_upload, $lib_piece, $_REQUEST["type_pie"], $_REQUEST["nom_pie"], $_REQUEST["desc_pie"], $_REQUEST["type_objet"], $_REQUEST["ref_objet"]);
}
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_pieces_ged_upload.inc.php");

?>