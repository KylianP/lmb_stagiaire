<?php
$CONFIGURATION=0;

// CODE NON PARAMETRABLE
global $DOCUMENTS_IMG_LOGO;
$DOC_STANDARD['IMG_LOGO']	= $DOCUMENTS_IMG_LOGO;

$DOC_STANDARD['AFF_REMISES']	= $AFF_REMISES;
$DOC_STANDARD['AFF_PRIX']="true";

$DOC_STANDARD['HAUTEUR_LIGNE_DEFAUT']  = 3;
$DOC_STANDARD['HAUTEUR_LINE_ARTICLE']			= 3;
$DOC_STANDARD['HAUTEUR_LINE_TAXE']				= 3;
$DOC_STANDARD['HAUTEUR_LINE_INFORMATION']	= 3;
$DOC_STANDARD['HAUTEUR_LINE_SOUSTOTAL']		= 3;
$DOC_STANDARD['HAUTEUR_LINE_DESCRIPTION']	= 3;
$DOC_STANDARD['HAUTEUR_LINE_VIDE']				= 3;

$DOC_STANDARD['HAUTEUR_AFTER_LINE_ARTICLE']			= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_TAXE']				= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_INFORMATION']	= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_SOUSTOTAL']		= 0;
$DOC_STANDARD['HAUTEUR_AFTER_LINE_DESCRIPTION']	= 0;

$DOC_STANDARD['ENTETE_COL_REF'] = "R?f?rence";
$DOC_STANDARD['ENTETE_COL_LIB'] = "D?signation";
$DOC_STANDARD['ENTETE_COL_QTE'] = "Qt?";
$DOC_STANDARD['ENTETE_COL_PU']  = "PU";
$DOC_STANDARD['ENTETE_COL_REM'] = "%";
$DOC_STANDARD['ENTETE_COL_PT']  = "TOTAL";
$DOC_STANDARD['ENTETE_COL_TVA'] = "TVA";

$DOC_STANDARD['LARGEUR_TICKET'] = 80;
$DOC_STANDARD['LARGEUR_LIGNE'] = 70;
$DOC_STANDARD['LARGEUR_RETRAIT'] = 5;

$DOC_STANDARD['LARGEUR_COL_REF'] = 0;
$DOC_STANDARD['LARGEUR_COL_LIB'] = 50;
$DOC_STANDARD['LARGEUR_COL_QTE'] = 5;
$DOC_STANDARD['LARGEUR_COL_PU'] = 0;
$DOC_STANDARD['LARGEUR_COL_REM'] = 0;
$DOC_STANDARD['LARGEUR_COL_PT'] = 15;
$DOC_STANDARD['LARGEUR_COL_TVA'] = 0;


// ***************************************************
// POSITION DES BLOCS
$DOC_STANDARD['MARGE_HAUT']		= 15;
$DOC_STANDARD['MARGE_BAS']		= 15;

// CORPS DU DOCUMENT
$DOC_STANDARD['CORPS_HAUTEUR_DEPART']	= 1000;
$DOC_STANDARD['CORPS_HAUTEUR_MAX']		= 1300;

// PIEDS DE PAGE
$DOC_STANDARD['PIEDS_HAUTEUR_DEPART']	= 2400;
$DOC_STANDARD['PIEDS_HAUTEUR_MAX']		= 3200;

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


//variable//type de champ(parametre)//lib?ll?//commentaire [// option s?par? par un @ exemple: valeur1@valeur2@valeur3 ]
// PARAMETRES MODIFIABLES
$DOC_STANDARD['LIB_NEG']="Ticket de Caisse";//TXTE()// Libell? si total n?gatif // 
$DOC_STANDARD['TEXTE_ENTETE']="";//TXTA()// Texte en en-t?te// 
$DOC_STANDARD['TEXTE_PIED']="";//TXTA()// Texte en pied de page// 
$DOC_STANDARD['REF_ARTICLE']="Article";//SLCT()// Affichage de la colonne r?f?rence //  //Aucune@Article@Interne@Oem
$DOC_STANDARD['AFF_CODE_BARRE']="true";//CBOX()// Afficher le code barre en ent?te// 
$DOC_STANDARD['AFF_PRIX']="true";//CBOX()// Afficher les prix // 
$DOC_STANDARD['AFF_DESC']="true";//CBOX()// Afficher la description courte // 
$DOC_STANDARD['AFF_SN']="";//CBOX()// Afficher les informations de tra?abilit? // 
$DOC_STANDARD['AFF_CG']="";//CBOP()// Afficher au dos les conditions g?n?rales // 
$DOC_STANDARD['CG_VERSO']="";//TXTP()// Conditions g?n?rales : // 
// FIN PARAMETRES MODIFIABLES
// CONFIGURATION PAR DEFAUT
// Portion de code recopi?e dans la partie ??param?tres modifiables?? en cas de remise ? 0 des param?tres.
/*
$DOC_STANDARD['LIB_NEG']="";//TXTE()// Libell? si total n?gatif // 
$DOC_STANDARD['TEXTE_ENTETE']="";//TXTA()// Texte en en-t?te// 
$DOC_STANDARD['TEXTE_PIED']="";//TXTA()// Texte en pied de page// 
$DOC_STANDARD['REF_ARTICLE']="Article";//SLCT()// Affichage de la colonne r?f?rence //  //Aucune@Article@Interne@Oem
$DOC_STANDARD['AFF_CODE_BARRE']="true";//CBOX()// Afficher le code barre en ent?te// 
$DOC_STANDARD['AFF_PRIX']="true";//CBOX()// Afficher les prix // 
$DOC_STANDARD['AFF_DESC']="true";//CBOX()// Afficher la description courte // 
$DOC_STANDARD['AFF_SN']="";//CBOX()// Afficher les informations de tra?abilit? // 
$DOC_STANDARD['AFF_CG']="";//CBOP()// Afficher au dos les conditions g?n?rales // 
$DOC_STANDARD['CG_VERSO']="";//TXTP()// Conditions g?n?rales : // 
*/
// FIN CONFIGURATION PAR DEFAUT
// INFORMATIONS SUR L?AUTEUR
/* 
*/


?>