<?php

// ******************************************************************
// FONCTIONS LIEES AUX DATES 
// ******************************************************************

// IMPORTANT !!
//
// string setlocale  ( int $category  , array $locale  )
//
// L'information locale est maintenue par processus, non par thread. 
// Si vous faites fonctionner PHP sur un serveur multi-thread? comme 
// IIS ou Apache sur Windows, vous pourriez obtenir des changements 
// soudains des configurations locales pendant qu'un script fonctionne, 
// m?me si celui-ci n'appelle jamais la fonction setlocale().
// Ceci survient ? cause des autres scripts qui fonctionnent dans des 
// threads diff?rents du m?me processus. Ces scripts changent les 
// configurations locales dans le processus au complet en utilisant 
// la fonction setlocale()
//
// Deplus, sur certain serveur LINUX, le setlocale() ne passe pas et emp?che l'impression des pdf
//
// Pour ces raisons, nous d?conseillons l'utilisation de la fonction setlocale()
// 
// Pour les dates, il est pr?f?rable d'utiliser la fonction lmb_strftime(string $format , string $info_locale [, int $timestamp = time()  ] )
// $info_locale <= $INFO_LOCALE variable globale d?finie dans config/config_generale.inc.php


//string lmb_strftime(string $format , string $info_locale [, int $timestamp = time()  ] )
function lmb_strftime(			 $format, 				$info_locale  ,			$timestamp = -1){if($timestamp < 0){$timestamp = time();}

	//Jour
	//%a 	Nom abr?g? du jour de la semaine 	De lun ? dim
	//%A 	Nom complet du jour de la semaine 	De lundi ? dimanche
	$pattern = '(%a|%A)';
	
	//Mois
	//%b 	Nom du mois, abr?g?, suivant la locale 	De janv ? d?c
	//%B 	Nom complet du mois, suivant la locale 	De janvier ? d?cembre
	//%h 	Nom du mois abr?g?, suivant la locale (alias de %b) 	De janv ? d?c
	$pattern.= '|(%b|%B|%h)';
	
	//Heure
	//%X 	Repr?sentation de l'heure, bas?e sur la locale, sans la date 	Exemple : 03:59:16 ou 15:59:16
	//%z 	Soit le d?calage horaire depuis UTC, ou son abr?viation (suivant le syst?me d'exploitation) 	Exemple : -0500 ou EST pour l'heure de l'Est
	//%Z 	Le d?calage horaire ou son abr?viation NON fournie par %z (suivant le syst?me d'exploitation) 	Exemple : -0500 ou EST pour l'heure de l'Est
	$pattern.= '|(%X|%z|%Z)';
	
	//L'heure et la date
	//%c 	Date et heure pr?f?r?es, bas?es sur la locale 	Exemple : Tue Feb 5 00:45:10 2009 pour le 4 F?vrier 2009 ? 12:45:10 AM
	//%x 	Repr?sentation pr?f?r?e de la date, bas?e sur la locale, sans l'heure 	Exemple : 02/05/09 pour le 5 F?vrier 2009
	$pattern.= '|(%c|%x)';
	
	switch($info_locale[0]){
		default:{// fr_FRA
			$format = preg_replace_callback('/'.$pattern.'/',create_function("\$matches", "return _lmb_strftime_fr_FRA(\$matches, ".$timestamp.");"), $format);
			break;
		}
	}
	return strftime($format, $timestamp);
}

// NE PAS UTILISER CETTE FONCTION DIRECTEMENT
function _lmb_strftime_fr_FRA($matches, $timestamp){
	switch ($matches[0]) {
		//JOUR
		case "%a":{//%a 	Nom abr?g? du jour de la semaine 	De lun ? dim
			$tab = array("dim", "lun", "mar", "mer", "jeu", "ven", "sam");
			return $tab[strftime("%w", $timestamp)];
		}
		case "%A":{//%A 	Nom complet du jour de la semaine De lundi ? dimanche
			$tab = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
			return $tab[strftime("%w", $timestamp)];
		}
		//Mois
		case "%b":{//%b 	Nom du mois, abr?g?, suivant la locale 	De janv ? d?c
			$tab = array("janv.", "f?vr.", "mars", "avr.", "mai", "juin", "juil", "ao?t", "sept", "oct", "nov", "d?c");
			return $tab[strftime("%m", $timestamp)-1];
		}
		case "%B":{//%B 	Nom complet du mois, suivant la locale 	De janvier ? d?cembre
			$tab = array("janvier", "f?vrier", "mars", "avril", "mai", "juin", "juillet", "ao?t", "septembre", "octobre", "novembre", "d?cembre");
			return $tab[strftime("%m", $timestamp)-1];
		}
		case "%h":{//%b 	Nom du mois, abr?g?, suivant la locale 	De janv ? d?c
			$tab = array("janv.", "f?vr.", "mars", "avr.", "mai", "juin", "juil", "ao?t", "sept", "oct", "nov", "d?c");
			return $tab[strftime("%m", $timestamp)-1];
		}
		
		//Heure
		//%X 	Repr?sentation de l'heure, bas?e sur la locale, sans la date 	Exemple : 03:59:16 ou 15:59:16
		//%z 	Soit le d?calage horaire depuis UTC, ou son abr?viation (suivant le syst?me d'exploitation) 	Exemple : -0500 ou EST pour l'heure de l'Est
		//%Z 	Le d?calage horaire ou son abr?viation NON fournie par %z (suivant le syst?me d'exploitation) 	Exemple : -0500 ou EST pour l'heure de l'Est
		
		//L'heure et la date
		//%c 	Date et heure pr?f?r?es, bas?es sur la locale 	Exemple : Tue Feb 5 00:45:10 2009 pour le 4 F?vrier 2009 ? 12:45:10 AM
		//%x 	Repr?sentation pr?f?r?e de la date, bas?e sur la locale, sans l'heure 	Exemple : 02/05/09 pour le 5 F?vrier 2009
		
		default:return $matches[0];
	}
}

// Converti une date US en date FR
function date_Us_to_Fr ($requete) {
	$a = substr($requete, 0, 4);
	$m = substr($requete, 5, 2);
	$j = substr($requete, 8, 2);
	$date = $j.'-'.$m.'-'.$a;
	return $date;
}

// Converti une date FR en date US
function date_Fr_to_Us ($requete) {
	$a = substr($requete, 6, 4);
	$m = substr($requete, 3, 2);
	$j = substr($requete, 0, 2);
	$date = $a.'-'.$m.'-'.$j; 
	return $date;
}

// renvois une date en string Lettre FR
// utilisation fortement d?conseill?e !!
function date_Lettre_Fr ($requete) {
	setlocale (LC_TIME, 'fr_FR','fra'); 
	return strftime('%A, %d %B %Y', strtotime($requete));
}

// Retourne l'heure ? partir d'une date
function getTime_from_date ($requete) {
	$aff_seconde = 0;

	if ($aff_seconde) {
	  return substr($requete, 11);
	}
	else {
	  return substr($requete, 11, 5);
	}
}

// *************************************************************************************************************
// FONCTIONS DIVERSES
// *************************************************************************************************************

// Retourne la liste des pays pour un affichage en SELECT
function getPays_select_list () {
	global $bdd;

	$liste_pays = array();
	$query = "SELECT `pays`, `id_pays`, `affichage`
    				FROM `pays`
    				ORDER BY affichage DESC , pays ASC";
	$resultat = $bdd->query ($query);
	while ($tmp = $resultat->fetchObject()) { $liste_pays[] = $tmp; }
	
	return $liste_pays;
}


function affiche_version ($version_brute) {
	$version_brute = number_format ($version_brute, 4);
	$before = substr($version_brute, 0, strpos($version_brute, "."));
	$after = substr($version_brute, strpos($version_brute, ".")+1);
	$after_part1 = substr($after, 0, 3);
	$after_part2 = substr($after, 3, 1);
	return $before.".".$after_part1.".".$after_part2;
}

function getPays_in_list ($list) {
	global $bdd;

	$liste_pays = array();
	$query = "SELECT `pays`, `id_pays`
				FROM `pays` 
				WHERE `id_pays` IN (".$list.")";
	$resultat = $bdd->query ($query);
	while ($tmp = $resultat->fetchObject()) { $liste_pays[] = $tmp; }
	
	return $liste_pays;
}

//fonction de maj des fichier de config (ici principalement utilis? dans le cas de maj_line
//ou l'on peu choisir soit la ligne dans le fichier ? modifier, soit le nom de la variable ? modifier
function maj_configuration_file ($filename, $action, $line_number, $line_texte = "", $dir_file) {
	// Suppression des espaces en fin de ligne & Ajout d'un saut de ligne
	$line_texte = rtrim($line_texte)."\n";

	$new_file = array();
	$old_file = file ($dir_file.$filename);

	switch ($action) {
		case "add_line":
			for ($i=0; $i<count($old_file); $i++) {
				if ($i == $line_number-1) { $new_file[] = $line_texte; }
				$new_file[] = $old_file[$i];
			}
		break;
		case "del_line":
			//on v?rifi que c'est un num?ro de ligne qui est indiqu?
			if (is_numeric($line_number)) {
				for ($i=0; $i<count($old_file); $i++) {
					if ($i == $line_number-1) { continue; }
					$new_file[] = $old_file[$i];
				}
			} else {
				//alors on a indiqu? le nom de la variabe que l'on vas chercher dans tout le fichier
				for ($i=0; $i<count($old_file); $i++) {
					if (substr_count($old_file[$i], $line_number)) { continue; }
					$new_file[] = $old_file[$i];
				}
			}
		break;
		case "maj_line":
			//on v?rifi que c'est un num?ro de ligne qui est indiqu?
			if (is_numeric($line_number)) {
				$new_file = $old_file;
				$new_file[$line_number-1] = $line_texte;
			} else {
				//alors on a indiqu? le nom de la variabe que l'on vas chercher dans tout le fichier
				$new_file = $old_file;
				
				for ($i=0; $i<count($old_file); $i++) {
					if (substr_count($old_file[$i], $line_number)) {
						$new_file[$i] = $line_texte;
					}
				}
			}
		break;
	}
	// Cr?ation du nouveau fichier de coniguration
	$new_file_id = fopen ($dir_file."tmp_".$filename, "w");
	foreach ($new_file as $line) {
		fwrite($new_file_id, $line);
	}
	fclose($new_file_id);

	// Remplacement du fichier existant
	unlink($dir_file.$filename);
	rename ($dir_file."tmp_".$filename, $dir_file.$filename);
	
	return true;
}

//fonction retournant l'existence d'un fichier (distant ou local)
function remote_file_exists ($url)
{
   $head = "";
   $url_p = parse_url ($url);
 
   if (isset ($url_p["host"]))
   { $host = $url_p["host"]; }
   else
   { return false; }
 
   if (isset ($url_p["path"]))
   { $path = $url_p["path"]; }
   else
   { $path = ""; }
 	 restore_error_handler();
	 error_reporting(0);
   $fp = fsockopen ($host, 80, $errno, $errstr, 20);
	 set_error_handler("error_handler");
   if (!$fp)
   { return false; }
   else
   {
       $parse = parse_url($url);
       $host = $parse['host'];
     
       fputs($fp, "HEAD ".$url." HTTP/1.1\r\n" );
       fputs($fp, "HOST: ".$host."\r\n" );
       fputs($fp, "Connection: close\r\n\r\n" );
       $headers = "";
       while (!feof ($fp))
       { $headers .= fgets ($fp, 128); }
   }
   fclose ($fp);
   $arr_headers = explode("\n", $headers);
   $return = false;
   if (isset ($arr_headers[0]))
   { $return = strpos ($arr_headers[0], "404" ) === false; }
   return $return;
}



/*
	Universal Feed Reader Library
	(c) 2007 Xul.fr - Licence Mozilla 1.1.
	Written by Denis Sureau
	http://www.xul.fr/feed/
*/


$Universal_Style = "p";   // replace that by span class="" to custom
$Universal_Date_Font = "size='-1'";

$Universal_FeedArray = array();

$Universal_AtomChannelTags = array("title","link","subTitle","updated");
$Universal_AtomItemTags = array("title","link","summary","pubDate");

$Universal_RssChannelTags = array("title","link","description","lastBuildDate");
$Universal_RssItemTags = array("title","link","description","pubDate");

$Universal_Translation = array("title"=>"title", 
  "link"=>"link",
  "description"=>"description",
  "subTitle"=>"description",
  "summary"=>"description",
  "lastBuildDate"=>"updated",
  "pubDate"=>"updated");

$Universal_Doc = false;


/**
 *  Read the content of a tag
 *  Input: 
 *  - element: the node
 *  - tag: the name of the tag
 *  Ouput:
 *  - the content
 */       

function getTag($element, $tag)
{
  $x = $element->getElementsByTagName($tag);
  if($x->length == 0)
  {
    return false;
  }  
  $x = $x->item(0);
  $x = $x->firstChild->data;
  return $x;
}

/**
 *  Read content of tags for the given list of names
 *  and push them into an array
 *  Input:
 *  - element: a node
 *  - listOfTags: an array holding the names of tags
 *  - type: 0 = channel, 1 = item
 *  Ouput:
 *  - the array that stores the data
 */           

function getTags($element, $listOfTags, $type)
{
  global $Universal_Translation;

  $a = array("type" => $type);
 
  foreach($listOfTags as $tag)
  {
    $b = $Universal_Translation[$tag];
    $a[$b] = getTag($element, $tag);
  }
  return $a;
}

/**
 *  Extract the channel node
 *  Input: name of the tag (feed or channel)
 *  Ouput: the node
 */     

function extractChannel($tag)
{
  global $Universal_Doc;
  $channel = $Universal_Doc->getElementsByTagName($tag);
  return $channel->item(0);
}

/**
 *  Extract all items
 *  Input: the name of the tag
 *  Output: a DOMNodeList
 */    

function extractItems($dnl, $tag)
{
  global $Universal_Doc;
  $items = $Universal_Doc->getElementsByTagName($tag);
  return $items;
}

/**
 *  Default display routine
 *  Input:
 *  - size: the max number of items to display
 *  - chanflag: display the channel or not
 *  - descflag: display the description or not
 *  - dateflag: display the date or not
 *  - Universal_Style: name of the container, default is <p>
 *  - Universal_Data_Font: name of the font
 *  Output:
 *  - the formatted generated text
 */            

function Universal_Display($size = 15, $chanflag = false, $descflag = false, $dateflag = false)
{
  global $Universal_FeedArray;
  global $Universal_Style;
	global $Universal_Date_Font;

  $opened = false;
	$page = "";
	$counter = 0;

  if(count($Universal_FeedArray) == 0)
  {
    die("Error, nothing to display.");
  }

	foreach($Universal_FeedArray as $article)
	{
		$type = $article["type"];
	
		if($type == 0)
		{
			if($chanflag != true) continue;
			if($opened == true)
			{
				$page .="</ul>\n";
				$opened = false;
			}
			//$page .="<b>";
		}
		else
		{
		  if($counter++ >= $size)
      { 
        break;
      }  
			if($opened == false && $chanflag == true) 
			{
				$page .= "<ul>\n";
				$opened = true;
			}
		}
		$title = $article["title"];
		$link = $article["link"];
		$page .= "<".$Universal_Style."><a href=\"$link\" >$title</a>";
		
		if($descflag != false)
		{
			$description = $article["description"];
			if($description != false)
			{
				$page .= "<br>$description";
			}
		}	
		if($dateflag != false)
		{			
			$updated = $article["updated"];
			if($updated != false)
			{
				$page .= "<br /><font $Universal_Date_Font>$updated</font>";
			}
		}	
		$page .= "</".$Universal_Style.">\n";			
		
		/*
		if($type == 0)
		{
			$page .="<br />";
		}
		*/
	}

	if($opened == true)
	{	
		$page .="</ul>\n";
	}
	return $page."\n";
}


/**
 *  Get the data out of a feed 
 *  - Input: the URL of the feed
 *  - Output: a two-dimensional array holding the data  
 */

function Universal_Reader($url)
{
  global $Universal_FeedArray;
	global $Universal_Content;
	global $Universal_Style;
	global $Universal_Date_Font;
	global $Universal_AtomChannelTags;
	global $Universal_RssChannelTags;
	global $Universal_AtomItemTags;
	global $Universal_RssItemTags;
	global $Universal_Doc;
	
	$Universal_FeedArray = array();

	$Universal_Doc  = new DOMDocument("1.0");
		restore_error_handler();
		error_reporting(0);
	$Universal_Doc->load($url);
		set_error_handler("error_handler");

	$Universal_Content = array();

	$channel = extractChannel("feed");
  $isAtom = ($channel != false);

  if($isAtom)
  {
    $channelArray = getTags($channel, $Universal_AtomChannelTags, 0);
    $items = extractItems($channel, "entry");
    $tagSchema = $Universal_AtomItemTags;
  }
  else
  {
    $channel = extractChannel("channel");
    $channelArray = getTags($channel, $Universal_RssChannelTags, 0);
    $items = extractItems($channel, "item");
    $tagSchema = $Universal_RssItemTags;
  }
  
  array_push($Universal_FeedArray, $channelArray);
  
  foreach($items as $item)
  {
     array_push($Universal_FeedArray, getTags($item, $tagSchema, 1));
  }  
  
 	return $Universal_FeedArray;
	
}


function rainbowDegrader($longueur, $coulDep, $coulArr) {

  $degrader = array();

  //$coulDep  Couleur de d?part (gauche), RVB
  // $coulArr Couleur d'arriv?e (droite), RVB

  $sens_r = 0;
  $sens_v = 0;
  $sens_b = 0;
  if($coulArr[0] <= $coulDep[0]) $sens_r = 1;
  if($coulArr[1] <= $coulDep[1]) $sens_v = 1;
  if($coulArr[2] <= $coulDep[2]) $sens_b = 1;

  for($x=0; $x <= $longueur; $x++) {

    if($sens_r) {
      $pas = ($coulDep[0] - $coulArr[0]) / $longueur;
      $rouge = round($coulDep[0] - ($x*$pas));
      $rouge = sprintf("%02s", dechex($rouge) );
    } else {
      $pas = ($coulArr[0] - $coulDep[0]) / $longueur;
      $rouge = round($coulDep[0] + ($x*$pas));
      $rouge = sprintf("%02s", dechex($rouge) );
    }

    if($sens_v) {
      $pas = ($coulDep[1] - $coulArr[1]) / $longueur;
      $vert = round($coulDep[1] - ($x*$pas));
      $vert = sprintf("%02s", dechex($vert) );
    } else {
      $pas = ($coulArr[1] - $coulDep[1]) / $longueur;
      $vert = round($coulDep[1] + ($x*$pas));
      $vert = sprintf("%02s", dechex($vert) );
    }

    if($sens_b) {
      $pas = ($coulDep[2] - $coulArr[2]) / $longueur;
      $bleu = round($coulDep[2] - ($x*$pas));
      $bleu = sprintf("%02s", dechex($bleu) );
    } else {
      $pas = ($coulArr[2] - $coulDep[2]) / $longueur;
      $bleu = round($coulDep[2] + ($x*$pas));
      $bleu = sprintf("%02s", dechex($bleu) );
    }

    $degrader[]= '#' . $rouge . $vert . $bleu;

  }
  return $degrader;
}


function max_valeur ($x) {
	global $TARIFS_NB_DECIMALES;
	return round($x, -(strlen(number_format(abs($x), 0, ".", ""))-2));
}

function min_value ($x) { return -max_value(-$x); }


//fonctions des GED

//fonction de chargement de pieces jointes pour un objet
function charger_ged ($type_objet, $ref_objet) {
	global $bdd;
	
	$pieces_jointes = array();
	$query = "SELECT pa.id_piece, pa.type_objet, pa.ref_objet, p.lib_piece, p.fichier, p.nom, p.note, pt.lib_piece_type
						FROM pieces_associations pa 
							JOIN pieces p ON p.id_piece = pa.id_piece 
							LEFT JOIN pieces_types pt ON p.id_piece_type = pt.id_piece_type
						WHERE pa.ref_objet = '".$ref_objet."' && pa.type_objet = '".$type_objet."'
						ORDER BY pt.lib_piece_type ASC, p.lib_piece ASC";
	$resultat = $bdd->query ($query);
	while ($var = $resultat->fetchObject()) { $pieces_jointes[] = $var;}
	
	return $pieces_jointes;
}

//fonction d'insertion de piece jointe pour un objet
function add_ged ($fichier, $lib_piece, $type_pj, $nom, $note, $type_objet, $ref_objet) {
	global $bdd;
	
	// *************************************************
	// Si les valeurs re?ues sont incorrectes
	if (count($GLOBALS['_ALERTES'])) {
		return false;
	}
	
	// Insertion dans la BDD
	if($type_pj==0){
		$query = "INSERT INTO pieces (lib_piece, id_piece_type, fichier, nom, note)
						VALUES ( '".addslashes($lib_piece)."', NULL,  '".addslashes($fichier)."',  '".addslashes($nom)."',  '".addslashes($note)."')";
	}else{
		$query = "INSERT INTO pieces (lib_piece, id_piece_type, fichier, nom, note)
						VALUES ( '".addslashes($lib_piece)."', '".$type_pj."',  '".addslashes($fichier)."',  '".addslashes($nom)."',  '".addslashes($note)."')";
	}
	
	$bdd->exec ($query);
	
	$id_piece = $bdd->lastInsertId();
	
	$query = "INSERT INTO pieces_associations (id_piece, type_objet, ref_objet)
						VALUES ('".$id_piece."', '".$type_objet."', '".$ref_objet."')";
	$bdd->exec ($query);
	
	return true;
}

//fonction de supression de piece jointe pour un objet
function del_ged ($id_piece, $fichier) {
	global $bdd;
	global $GED_DIR;
	
	// supression dans la BDD	
	$query = "DELETE FROM pieces 
						WHERE id_piece =  '".$id_piece."' ";
	$bdd->exec ($query);
	
	$query = "DELETE FROM pieces_associations 
						WHERE id_piece =  '".$id_piece."' ";
	$bdd->exec ($query);
	
	//suppression du fichier
	if ($fichier) {
		if (file_exists($GED_DIR.$fichier)) {
			@unlink($GED_DIR.$fichier);
		}
		if (file_exists($GED_DIR.$fichier)) {
			@unlink($GED_DIR.$fichier);
		}
	}

	return true;
}

//Fonction de chargement des types de pi?ces jointes
function charger_types_ged(){
	global $bdd;
	
	$types_pieces = array();
	$query = "SELECT * FROM pieces_types ORDER BY systeme ASC, lib_piece_type ASC";
	$resultat = $bdd->query ($query);
	while ($var = $resultat->fetchObject()){
		$types_pieces[] = $var;
	}
	
	return $types_pieces;
}

//Fonction de modification des types de pi?ces jointes
function maj_types_ged($id_type, $lib_type){
	global $bdd;
	
	$query = "UPDATE pieces_types
				SET lib_piece_type = '".$lib_type."'
				WHERE id_piece_type = '".$id_type."'";
	
	$bdd->exec ($query);
	
	return true;
}

//Fonction d'ajout de type de pi?ce jointe
function add_types_ged($lib_type, $syst){
	global $bdd;
	
	$query = "INSERT INTO pieces_types (lib_piece_type, systeme)
				VALUES ('".$lib_type."', '".$syst."')";
	
	$bdd->exec ($query);
	
	return true;
}

//Fonction de suppression de type de pi?ce jointe
function del_types_ged($id_type){
	global $bdd;
	
	$query = "UPDATE pieces
				SET id_piece_type = NULL
				WHERE id_piece_type = '".$id_type."'";
	
	$bdd->exec ($query);
	
	$query = "DELETE FROM pieces_types 
						WHERE id_piece_type =  '".$id_type."' ";
	
	$bdd->exec ($query);
	
	return true;
}




//chargement du CA 
function charger_doc_CA ($periode, $type_data = array()) {
	global $bdd;
	
	$query_select = " SUM(ROUND(dl.qte * dl.pu_ht * (1-dl.remise/100) ,2)) as montant_ht";
	$query_where = "";
	if (isset($periode[1]) && $periode[1] && $periode[1] != "--") {
		$query_where .= "&& date_creation_doc < '".$periode[1]."'";
	}
	if (isset($periode[0]) && $periode[0] && $periode[0] != "--") {
		$query_where .= " && date_creation_doc >= '".$periode[0]."' ";
	}
	if (is_array($type_data) && count($type_data)) {
		if (isset($type_data["modele"])) {
			$query_where .= " && a.modele = '".$type_data["modele"]."' ";
		}
		if (isset($type_data["magasin"])) {
			$query_where .= " && df.id_magasin = '".$type_data["magasin"]."' ";
		}
		if (isset($type_data["categ_client"])) {
			$query_where .= " && ac.id_client_categ = '".$type_data["categ_client"]."' ";
		}
		if (isset($type_data["categ_comm"])) {
			$query_select = " SUM(ROUND(dl.qte * dl.pu_ht * (1-dl.remise/100) * dvc.part /100 ,2)) as montant_ht ";
			$query_where .= " && aco.id_commercial_categ = '".$type_data["categ_comm"]."' ";
		}
		if (isset($type_data["art_categ"])) {
			$query_where .= " && a.ref_art_categ = '".$type_data["art_categ"]."' ";
		}
	}
	
	//CA des ventes
	$montant_CA = 0;
	$query = "SELECT ".$query_select."
						FROM  docs_lines dl
							LEFT JOIN documents d ON dl.ref_doc = d.ref_doc
							LEFT JOIN articles a ON a.ref_article = dl.ref_article
							LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc
							LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc
							LEFT JOIN doc_fac df ON df.ref_doc = d.ref_doc
							LEFT JOIN annu_client ac ON ac.ref_contact = d.ref_contact
							LEFT JOIN doc_ventes_commerciaux dvc ON dvc.ref_doc = d.ref_doc
							LEFT JOIN annu_commercial aco ON aco.ref_contact = dvc.ref_contact
						WHERE dl.ref_doc_line_parent IS NULL && d.id_etat_doc IN (18,19)
									&& dl.visible = 1
									".$query_where."
						ORDER BY date_creation_doc DESC, d.id_type_doc ASC
						";
						
	$resultat = $bdd->query ($query);
	while ($art = $resultat->fetchObject()) { 
		
		$montant_CA += $art->montant_ht;
	}
	$GLOBALS['_ALERTES']['st'][] = $query;
	return round($montant_CA);
		
}

//chargement de la marge
function charger_doc_marge ($periode, $type_donnees = array()) {
	global $bdd;
	
	$query_select = " SUM(ROUND(dl.qte * (dl.pu_ht - a.paa_ht) * (1-dl.remise/100) ,2)) as montant_ht";
	$query_where = "";
	if (isset($periode[1]) && $periode[1] && $periode[1] != "--") {
		$query_where .= "&& date_creation_doc < '".$periode[1]."'";
	}
	if (isset($periode[0]) && $periode[0] && $periode[0] != "--") {
		$query_where .= " && date_creation_doc >= '".$periode[0]."' ";
	}
	if (is_array($type_donnees) && count($type_donnees)) {
		if (isset($type_donnees["modele"])) {
			$query_where .= " && a.modele = '".$type_donnees["modele"]."' ";
		}
		if (isset($type_donnees["magasin"])) {
			$query_where .= " && df.id_magasin = '".$type_donnees["magasin"]."' ";
		}
		if (isset($type_donnees["categ_client"])) {
			$query_where .= " && ac.id_client_categ = '".$type_donnees["categ_client"]."' ";
		}
		if (isset($type_donnees["categ_comm"])) {
			$query_select = " SUM(ROUND(dl.qte * (dl.pu_ht - a.paa_ht) * (1-dl.remise/100) * dvc.part /100 ,2)) as montant_ht ";
			$query_where .= " && aco.id_commercial_categ = '".$type_donnees["categ_comm"]."' ";
		}
		if (isset($type_donnees["art_categ"])) {
			$query_where .= " && a.ref_art_categ = '".$type_donnees["art_categ"]."' ";
		}
	}
	
	//marge des ventes
	$montant_marge = 0;
	$query = "SELECT ".$query_select."
						FROM  docs_lines dl
							LEFT JOIN documents d ON dl.ref_doc = d.ref_doc
							LEFT JOIN articles a ON a.ref_article = dl.ref_article
							LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc
							LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc
							LEFT JOIN doc_fac df ON df.ref_doc = d.ref_doc
							LEFT JOIN annu_client ac ON ac.ref_contact = d.ref_contact
							LEFT JOIN doc_ventes_commerciaux dvc ON dvc.ref_doc = d.ref_doc
							LEFT JOIN annu_commercial aco ON aco.ref_contact = dvc.ref_contact
						WHERE dl.ref_doc_line_parent IS NULL && d.id_etat_doc IN (18,19)
									&& dl.visible = 1
									".$query_where."
						ORDER BY date_creation_doc DESC, d.id_type_doc ASC
						";
						
	$resultat = $bdd->query ($query);
	while ($art = $resultat->fetchObject()) { 
		
		$montant_marge += $art->montant_ht;
	}
	$GLOBALS['_ALERTES']['st'][] = $query;
	return round($montant_marge);
		
}

//chargement du qte 
function charger_doc_qte ($periode, $type_data = array()) {
	global $bdd;
	
	$query_select = " SUM(dl.qte) as quantite";
	$query_where = "";
	if (isset($periode[1]) && $periode[1] && $periode[1] != "--") {
		$query_where .= "&& date_creation_doc < '".$periode[1]."'";
	}
	if (isset($periode[0]) && $periode[0] && $periode[0] != "--") {
		$query_where .= " && date_creation_doc >= '".$periode[0]."' ";
	}
	if (is_array($type_data) && count($type_data)) {
		if (isset($type_data["modele"])) {
			$query_where .= " && a.modele = '".$type_data["modele"]."' ";
		}
		if (isset($type_data["magasin"])) {
			$query_where .= " && df.id_magasin = '".$type_data["magasin"]."' ";
		}
		if (isset($type_data["categ_client"])) {
			$query_where .= " && ac.id_client_categ = '".$type_data["categ_client"]."' ";
		}
		if (isset($type_data["categ_comm"])) {
			$query_select = " SUM(dl.qte) as quantite ";
			$query_where .= " && aco.id_commercial_categ = '".$type_data["categ_comm"]."' ";
		}
		if (isset($type_data["art_categ"])) {
			$query_where .= " && a.ref_art_categ = '".$type_data["art_categ"]."' ";
		}
	}
	
	//CA des ventes
	$total_qte = 0;
	$query = "SELECT ".$query_select."
						FROM  docs_lines dl
							LEFT JOIN documents d ON dl.ref_doc = d.ref_doc
							LEFT JOIN articles a ON a.ref_article = dl.ref_article
							LEFT JOIN documents_types dt ON d.id_type_doc = dt.id_type_doc
							LEFT JOIN documents_etats de ON d.id_etat_doc = de.id_etat_doc
							LEFT JOIN doc_cdc dc ON dc.ref_doc = d.ref_doc
							LEFT JOIN annu_client ac ON ac.ref_contact = d.ref_contact
							LEFT JOIN doc_ventes_commerciaux dvc ON dvc.ref_doc = d.ref_doc
							LEFT JOIN annu_commercial aco ON aco.ref_contact = dvc.ref_contact
						WHERE dl.ref_doc_line_parent IS NULL && d.id_etat_doc IN (9,10)
									&& dl.visible = 1
									".$query_where."
						ORDER BY date_creation_doc DESC, d.id_type_doc ASC
						";
						
	$resultat = $bdd->query ($query);
	while ($qte = $resultat->fetchObject()) { 
		
		$total_qte += $qte->quantite;
	}
	$GLOBALS['_ALERTES']['st'][] = $query;
	return $total_qte;
		
}

function get_semaine($semaine,$annee)
{
// on sait que le 4 janvier est tout le temps en premi?re semaine
// cf. fr.wikipedia.org/wiki/ISO...
// donc on part du 4 janvier et on avance de ($semaine-1) semaines
// et on teste si on est un lundi. Si ce n'est pas le cas on recule
// d'un jour jusqu'? trouver un lundi.
$date_depart = 4 ;
while (date("w",mktime(0,0,0,01,($date_depart+($semaine-1)*7),$annee)) != 1)
$date_depart-- ;

for ($a=0;$a<7;$a++)
$dateSemaine[$a] = date("Y-m-d",mktime(0,0,0,01,($date_depart+$a+($semaine-1)*7),$annee));

return $dateSemaine;
}

function charge_modele_pdf_stats (){
	global $bdd;
	
	$modeles_liste	= array();
	$query = "SELECT id_pdf_modele, id_pdf_type, lib_modele, desc_modele , code_pdf_modele
							FROM pdf_modeles  
							WHERE id_pdf_type = '5'
							";
	$resultat = $bdd->query ($query);
	while ($modele_pdf = $resultat->fetchObject()) { $modeles_liste[] = $modele_pdf;}
	return $modeles_liste;
}


function get_code_pdf_modele_stat(){
	global $bdd;
	$query = "SELECT code_pdf_modele FROM pdf_modeles WHERE id_pdf_modele IN
		( SELECT id_pdf_modele FROM stats_modeles_pdf WHERE `usage` = 'defaut' AND id_stat = '1');";
	$res = $bdd->query($query);
	//return ($res->fetchObject()) ? $res->fetchObject()->code_pdf_modele : '';
	if ($r = $res->fetchObject()) {
		$tmp = $r->code_pdf_modele;
	} else {
		$query = "SELECT code_pdf_modele FROM pdf_modeles WHERE id_pdf_type ='5';";
		$res = $bdd->query($query);
		$tmp = ($r = $res->fetchObject()) ? $r->code_pdf_modele : false;
	}
	return $tmp;
}

//modele pdf par d?faut
function defaut_stats_modele_pdf ($id_stat, $id_pdf_modele) {
	global $bdd;
	
	$query = "UPDATE stats_modeles_pdf
						SET  `usage` = 'actif'
						WHERE id_stat = '".$id_stat."' && `usage` != 'inactif' 
						";
	$bdd->exec ($query);
	
	$query = "UPDATE stats_modeles_pdf
						SET  `usage` = 'defaut'
						WHERE id_stat = '".$id_stat."' && id_pdf_modele = '".$id_pdf_modele."' 
						";
	$bdd->exec ($query);
	return true;
}

//activation d'un modele pdf
function active_stats_modele_pdf ($id_stat, $id_pdf_modele) {
	global $bdd;
	
	$query = "UPDATE stats_modeles_pdf
						SET  `usage` = 'actif'
						WHERE id_stat = '".$id_stat."' && id_pdf_modele = '".$id_pdf_modele."' 
						";
	$bdd->exec ($query);
	return true;
}

//d?sactivation d'un modele pdf
function desactive_stats_modele_pdf ($id_stat, $id_pdf_modele) {
	global $bdd;
	
	$query = "UPDATE stats_modeles_pdf
						SET  `usage` = 'inactif'
						WHERE id_stat = '".$id_stat."' && id_pdf_modele = '".$id_pdf_modele."' 
						";
	$bdd->exec ($query);
	return true;
}

function getListePdfStats(){
	global $bdd;
	
	$liste = array();
	$query = "SELECT smp.id_stat, smp.id_pdf_modele, smp.usage, pm.lib_modele, pm.desc_modele
		FROM stats_modeles_pdf smp
		LEFT JOIN pdf_modeles pm ON smp.id_pdf_modele = pm.id_pdf_modele
		WHERE pm.id_pdf_type = '5'
		ORDER BY pm.lib_modele ASC, smp.usage ASC;";
	$res = $bdd->query($query);
	while ($r = $res->fetchObject()) { $liste[] = $r;}
	return $liste;
}


function dumpDB($path, $host, $db, $user, $pw){      
  ignore_user_abort(TRUE);
  $file = $path."_DBBackup.sql.gz";
  $buffer = '';
  
  $descriptorspec = array(
        0 => array("pipe", "r"),  // stdin
        1 => array("pipe", "w"),  // stdout
        );
  $cmd = "mysqldump -h".$host." -u".$user." -p --opt ".$db." | gzip";//pg_dump -c -U ".$this->DB_USER." -W ".$this->DB_BDD;//-D
  $process = proc_open($cmd, $descriptorspec, $pipes);
  if (is_resource($process)){
    fwrite($pipes[0], $pw."\n");
    fclose($pipes[0]);
          
    while(!feof($pipes[1]))
      $buffer .= fgets($pipes[1], 1024);
    fclose($pipes[1]);
        
    if (proc_close($process) == 0){
      file_put_contents($file, $buffer);
      return true;
    }
    return false;
  }
  return false;
}

function listFiles($path){
  //$dir = glob($path."/*", GLOB_ONLYDIR);
  $files = array();
 /* if (count($dir)>0){
    foreach($dir as $value){
      foreach(glob($value."/*") as $val)
        array_push($files, $val);
    /*array_push($files, glob($value."/*.jpg"));*/
   // }  
  //}
  foreach (glob($path."/*") as $val)
    array_push($files, $val);
  return $files;
}

function tarFiles($path, $files){
  $RESSOURCE_DIR = "../ressources/";
  require_once($RESSOURCE_DIR."Tar.php");
  $tar = new Archive_Tar($path, true);
  $tar->create($files) or die("Erreur lors de l'archivage");
}

function createBackup(){
  global $bdd_hote;
  global $bdd_user;  
  global $bdd_pass; 
  global $bdd_base;
  global $DIR;
  
  $datetime = date('YmdHis');
  $rc = $rc1 = false;
  
  $rc = dumpDB($datetime, $bdd_hote, $bdd_base, $bdd_user, $bdd_pass);
 
  if ($rc) {
		$files = listFiles($DIR);
  	array_push($files, $datetime."_DBBackup.sql.gz");
  	tarFiles($DIR."backup/".$datetime.".tgz", $files);
		if (file_exists($datetime."_DBBackup.sql.gz")) {
  	@unlink($datetime."_DBBackup.sql.gz");
		}
    return "Backup effectu?e avec succ?s.";
  } else {
		if (file_exists($DIR."backup/".$datetime.".tgz")) {
		@unlink($DIR."backup/".$datetime.".tgz");
		}
    return "Erreur lors de la sauvegarde.";
	}
}

function restoreDB($file_dump){
  global $bdd_hote;
  global $bdd_user;  
  global $bdd_pass; 
  global $bdd_base;
  //gunzip <
  $handle = exec('(echo "SET AUTOCOMMIT = 0;"; echo "SET FOREIGN_KEY_CHECKS=0;"; gunzip < '.$file_dump.' ; echo "SET FOREIGN_KEY_CHECKS=1;"; echo "COMMIT"; echo "SET AUTOCOMMIT = 1;") | mysql -h'.$bdd_hote.'-u '.$bdd_user.' -p'.$bdd_pass.' '.$bdd_base);//popen("gunzip < ".$file_dump." | mysql -u ".$bdd_user." -p[pass] [dbname]);//popen("psql -U ".$this->DB_USER." -W -d ".$this->DB_BDD." -f ".$file_dump, "w");
  if ($handle < 0)
	return false;
  //fwrite($handle, $this->DB_PASS."\n");
  //pclose($handle);
  return true;
}

function restoreBackup($path, $file_backup){
  $RESSOURCE_DIR = "../ressources/";
  require_once($RESSOURCE_DIR."Tar.php");
  $tar = new Archive_Tar($file_backup, true);
  $tar->extract($path);
  $dump = glob($path."*_DBBackup.sql.gz");
  $rc = restoreDB($dump[0]);
  unlink($dump[0]);
  if ($rc)
	return true;
  else
    return false;
}

/**
 * @param $string - une chaine de caract?re ? transformer
 * @return string - la chaine de character moins les caract?res suivant:
 * a-zA-Z
 */
function string2ref($string, $pattern = '/[^a-zA-Z0-9\-_\.]/'){
	$replacements = '';
	return preg_replace($pattern,$replacements,$string);
}

/**
 * Actuellement cette fontion n'est pas utilis?e
 * @param $string - une chaine de caract?re ? transformer
 * @return string - la chaine de character moins les caract?res suivant:
 * /[^a-zA-Z0-9\-_\.\(\)\[\]#]/
 */
function string2ref_etendu($string){
	$replacements = '';
	return string2ref($string, '/[^a-zA-Z0-9\-_\.\(\)\[\]#]/');
}


?>
