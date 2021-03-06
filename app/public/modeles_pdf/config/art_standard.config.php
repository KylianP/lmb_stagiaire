<?PHP 
$CONFIGURATION=1;

// CODE NON PARAMETRABLE
global $DOCUMENTS_IMG_LOGO;

$ART_STANDARD['IMG_LOGO']	= $DOCUMENTS_IMG_LOGO;

$ART_STANDARD['FONT'] = 'Times';
$ART_STANDARD['TAILLE'] = 12;
$ART_STANDARD['R'] = 0;
$ART_STANDARD['G'] = 0;
$ART_STANDARD['B'] = 0;
$ART_STANDARD['MARGE_IMAGE_GAUCHE'] = 125;
$ART_STANDARD['MARGE_GAUCHE'] = 20;
$ART_STANDARD['MARGE_IMAGE_HAUT'] = 100;
$ART_STANDARD['MARGE_HAUT'] = 15;

$ART_STANDARD['MARGE_PIED_HAUTEUR'] = 280;


global $PIED_DE_PAGE_GAUCHE_0;
global $PIED_DE_PAGE_GAUCHE_1;
global $PIED_DE_PAGE_DROIT_0;
global $PIED_DE_PAGE_DROIT_1;
$ART_STANDARD['PIEDS_GAUCHE'][0]	= $PIED_DE_PAGE_GAUCHE_0;
$ART_STANDARD['PIEDS_GAUCHE'][1]	= $PIED_DE_PAGE_GAUCHE_1;
$ART_STANDARD['PIEDS_DROIT'][0]	= $PIED_DE_PAGE_DROIT_0;
$ART_STANDARD['PIEDS_DROIT'][1]	= $PIED_DE_PAGE_DROIT_1;


// PARAMETRES MODIFIABLES

// couleur du libell? article
$ART_STANDARD['R_LIB_ARTICLE'] = 51;
$ART_STANDARD['G_LIB_ARTICLE'] = 51;
$ART_STANDARD['B_LIB_ARTICLE'] = 204;

// couleur du prix
$ART_STANDARD['R_PRIX'] = 255;
$ART_STANDARD['G_PRIX'] = 153;
$ART_STANDARD['B_PRIX'] = 51;

// emplacement du logo
$ART_STANDARD['CHEMIN_LOGO'] = $DOCUMENTS_IMG_LOGO;

// contenu du texte en pied de page
$ART_STANDARD['TEXTE_PIED'] = "";
/*$DOC_STANDARD['IMG_LOGO']	= $DOCUMENTS_IMG_LOGO;

$DOC_STANDARD['AFF_REMISES']	= $AFF_REMISES;

$DOC_STANDARD['HAUTEUR_LINE_ARTICLE']			= 5;
$DOC_STANDARD['HAUTEUR_LINE_TAXE']				= 5;
$DOC_STANDARD['HAUTEUR_LINE_INFORMATION']	= 5;
$DOC_STANDARD['HAUTEUR_LINE_SOUSTOTAL']		= 5;
$DOC_STANDARD['HAUTEUR_LINE_DESCRIPTION']	= 5;
$DOC_STANDARD['HAUTEUR_LINE_VIDE']				= 1;

$DOC_STANDARD['HAUTEUR_AFTER_LINE_ARTICLE']			= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_TAXE']				= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_INFORMATION']	= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_SOUSTOTAL']		= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_DESCRIPTION']	= 0;

$DOC_STANDARD['ENTETE_COL_REF'] = "R?f?rence";
$DOC_STANDARD['ENTETE_COL_DES'] = "D?signation";
$DOC_STANDARD['ENTETE_COL_QTE'] = "Qt?";
$DOC_STANDARD['ENTETE_COL_PU']  = "PU ".$this->app_tarifs;
$DOC_STANDARD['ENTETE_COL_REM'] = "Rem.";
$DOC_STANDARD['ENTETE_COL_PT']  = "Montant";
$DOC_STANDARD['ENTETE_COL_TVA'] = "TVA";

$DOC_STANDARD['LARGEUR_COL_REF'] = 30;
$DOC_STANDARD['LARGEUR_COL_LIB'] = 75;
$DOC_STANDARD['LARGEUR_COL_QTE'] = 10;
$DOC_STANDARD['LARGEUR_COL_PRI'] = 20;
$DOC_STANDARD['LARGEUR_COL_REM'] = 15;
$DOC_STANDARD['LARGEUR_COL_TVA'] = 10;

// ***************************************************
// POSITION DES BLOCS
$DOC_STANDARD['MARGE_GAUCHE'] = 15;
$DOC_STANDARD['MARGE_HAUT']		= 15;

// CORPS DU DOCUMENT
$DOC_STANDARD['CORPS_HAUTEUR_DEPART']	= 100;
$DOC_STANDARD['CORPS_HAUTEUR_MAX']		= 130;

// PIEDS DE PAGE
$DOC_STANDARD['PIEDS_HAUTEUR_DEPART']	= 240;
$DOC_STANDARD['PIEDS_HAUTEUR_MAX']		= 32;


// ***************************************************
// TEXTES DE PIEDS DE PAGE
global $PIED_DE_PAGE_GAUCHE_0;
global $PIED_DE_PAGE_GAUCHE_1;
global $PIED_DE_PAGE_DROIT_0;
global $PIED_DE_PAGE_DROIT_1;
$DOC_STANDARD['PIEDS_GAUCHE'][0]	= $PIED_DE_PAGE_GAUCHE_0;
$DOC_STANDARD['PIEDS_GAUCHE'][1]	= $PIED_DE_PAGE_GAUCHE_1;
$DOC_STANDARD['PIEDS_DROIT'][0]	=  $PIED_DE_PAGE_DROIT_0;
$DOC_STANDARD['PIEDS_DROIT'][1]	= $PIED_DE_PAGE_DROIT_1;

//variable//type de champ(parametre)//lib?ll?//commentaire
// PARAMETRES MODIFIABLES
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][0]="Le client reconnait avoir proc?d? ? la v?rification d'usage des marchandises livr?es.";//TXTE()// Texte entre corps et pied de page//ligne n?1
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][1]="A d?faut de mention sur le bon de livraison, aucune r?clamation ne sera admise apr?s r?ception de la marchandise, sauf en cas de vice cach?.";//TXTE()// Texte entre corps et pied de page//ligne n?2
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][2]="R?serve de propri?t? applicable selon la loi n?80.335 du 12 mai 1980.";//TXTE()// Texte entre corps et pied de page//ligne n?3
// FIN PARAMETRES MODIFIABLES
// CONFIGURATION PAR DEFAUT
// Portion de code recopi?e dans la partie ??param?tres modifiables?? en cas de remise ? 0 des param?tres.
/*
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][0]="Le client reconnait avoir proc?d? ? la v?rification d'usage des marchandises livr?es.";//TXTE()// Texte entre corps et pied de page//ligne n?1
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][1]="A d?faut de mention sur le bon de livraison, aucune r?clamation ne sera admise apr?s r?ception de la marchandise, sauf en cas de vis cach?.";//TXTE()// Texte entre corps et pied de page//ligne n?2
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][2]="R?serve de propri?t? applicable selon la loi n?80.335 du 12 mai 1980.";//TXTE()// Texte entre corps et pied de page//ligne n?3
*/
// FIN CONFIGURATION PAR DEFAUT
// INFORMATIONS SUR L?AUTEUR
/* 
*/
?>