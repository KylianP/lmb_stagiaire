<?php
$CONFIGURATION=0;

// CODE NON PARAMETRABLE
global $DOCUMENTS_IMG_LOGO;
$DOC_STANDARD['IMG_LOGO']	= $DOCUMENTS_IMG_LOGO;

global $REF_CONTACT_ENTREPRISE;
$DOC_STANDARD['REF_CONTACT_ENTREPRISE'] = "$REF_CONTACT_ENTREPRISE";

$DOC_STANDARD['AFF_REMISES']	= $AFF_REMISES;
$DOC_STANDARD['AFF_PRIX']="true";

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

// OBJET DU DOCUMENT
$DOC_STANDARD['OBJET_HAUTEUR_DEPART']	= 90;

// CORPS DU DOCUMENT
$DOC_STANDARD['CORPS_HAUTEUR_DEPART']	= 115;
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
$DOC_STANDARD['PIEDS_DROIT'][0]	= $PIED_DE_PAGE_DROIT_0;
$DOC_STANDARD['PIEDS_DROIT'][1]	= $PIED_DE_PAGE_DROIT_1;


//variable//type de champ(parametre)//lib�ll�//commentaire [// param�tre pour les SLCT s�par� par un @ exemple: valeur1@valeur2@valeur3 ]
/* 
 * Liste des types de champs possibles
 * TXTE : input de type texte
 * TXTA : textarea
 * TXTP : grand textarea
 * CBOX : checkbox
 * CBOP : checkbox permettant le masquage de l'option suivante si != true
 * SLCT : champs de type select avec pour diff�rentes valeurs celle pass�es en param�tre
 */
// PARAMETRES MODIFIABLES
$DOC_STANDARD['LIB_NEG']="";//TXTE()// Libell� si total n�gatif // 
$DOC_STANDARD['TEXTE_CORPS_PIEDS']="";//TXTA()// Texte entre corps et pied de page// 
$DOC_STANDARD['REF_ARTICLE']="Article";//SLCT()// Affichage de la colonne r�f�rence //  //Aucune@Article@Interne@Oem
$DOC_STANDARD['AFF_CODE_BARRE']="true";//CBOX()// Afficher le code barre en ent�te// 
$DOC_STANDARD['AFF_PRIX']="true";//CBOX()// Afficher les prix // 
$DOC_STANDARD['AFF_SN']="";//CBOX()// Afficher les informations de tra�abilit� // 
$DOC_STANDARD['AFF_CG']="";//CBOP()// Afficher au dos les conditions g�n�rales // 
$DOC_STANDARD['CG_VERSO']="";//TXTP()// Conditions g�n�rales : // 
// FIN PARAMETRES MODIFIABLES
// CONFIGURATION PAR DEFAUT
// Portion de code recopi�e dans la partie ��param�tres modifiables�� en cas de remise � 0 des param�tres.
/*
$DOC_STANDARD['LIB_NEG']="";//TXTE()// Libell� si total n�gatif // 
$DOC_STANDARD['TEXTE_CORPS_PIEDS']="";//TXTA()// Texte entre corps et pied de page// 
$DOC_STANDARD['REF_ARTICLE']="Article";//SLCT()// Affichage de la colonne r�f�rence //  //Aucune@Article@Interne@Oem
$DOC_STANDARD['AFF_CODE_BARRE']="true";//CBOX()// Afficher le code barre en ent�te// 
$DOC_STANDARD['AFF_PRIX']="true";//CBOX()// Afficher les prix // 
$DOC_STANDARD['AFF_SN']="";//CBOX()// Afficher les informations de tra�abilit� // 
$DOC_STANDARD['AFF_CG']="";//CBOP()// Afficher au dos les conditions g�n�rales // 
$DOC_STANDARD['CG_VERSO']="";//TXTP()// Conditions g�n�rales : // 
*/
// FIN CONFIGURATION PAR DEFAUT
// INFORMATIONS SUR L�AUTEUR
/* 
*/
?>