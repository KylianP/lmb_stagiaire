<?PHP 
$CONFIGURATION=1;

// CODE NON PARAMETRABLE
global $DOCUMENTS_IMG_LOGO;
$CAISSE_MVMNT['IMG_LOGO']	= $DOCUMENTS_IMG_LOGO;

$CAISSE_MVMNT['HAUTEUR_LINE_ARTICLE']			= 5;
$CAISSE_MVMNT['HAUTEUR_LINE_CATEGORIE']		= 5;
$CAISSE_MVMNT['HAUTEUR_LINE_TOTAUX_CATEGORIE']		= 5;
$CAISSE_MVMNT['HAUTEUR_LINE_TOTAUX_GENERAUX']		= 5;
$CAISSE_MVMNT['HAUTEUR_LINE_VIDE']				= 5;

$CAISSE_MVMNT['HAUTEUR_AFTER_LINE_ARTICLE']			= 0;
$CAISSE_MVMNT['HAUTEUR_AFTER_LINE_CATEGORIE']		= 0;
$CAISSE_MVMNT['HAUTEUR_AFTER_LINE_TOTAUX_CATEGORIE']		= 0;

$CAISSE_MVMNT['ENTETE_COL_DAT'] = "Date";
$CAISSE_MVMNT['ENTETE_COL_CBIL'] = "Lib.";
$CAISSE_MVMNT['ENTETE_COL_CTIER'] = "Utilisateur";
//$CAISSE_MVMNT['ENTETE_COL_LIB'] = "Info. supp.";
$CAISSE_MVMNT['ENTETE_COL_DEB'] = "D?bit";
$CAISSE_MVMNT['ENTETE_COL_CRE'] = "Cr?dit";

$CAISSE_MVMNT['LARGEUR_COL_DAT'] = 40;
$CAISSE_MVMNT['LARGEUR_COL_CBIL'] = 60;
$CAISSE_MVMNT['LARGEUR_COL_CTIER'] = 45;
//$CAISSE_MVMNT['LARGEUR_COL_LIB'] = 0;
$CAISSE_MVMNT['LARGEUR_COL_DEB'] = 20;
$CAISSE_MVMNT['LARGEUR_COL_CRE'] = 20;

// ***************************************************
// POSITION DES BLOCS
$CAISSE_MVMNT['MARGE_GAUCHE'] = 10;
$CAISSE_MVMNT['MARGE_HAUT']		= 10;

// CORPS DU DOCUMENT
$CAISSE_MVMNT['CORPS_HAUTEUR_DEPART']	= 45;
$CAISSE_MVMNT['CORPS_HAUTEUR_MAX']		= 205;

// PIEDS DE PAGE
$CAISSE_MVMNT['PIEDS_HAUTEUR_DEPART']	= 260;
$CAISSE_MVMNT['PIEDS_HAUTEUR_MAX']		= 12;

// ***************************************************
// TEXTES ENTRE CORPS ET PIEDS DE PAGE
$CAISSE_MVMNT['TEXTE_CORPS_PIEDS'][0]	= "";

// ***************************************************
// TEXTES DE PIEDS DE PAGE
global $PIED_DE_PAGE_GAUCHE_0;
global $PIED_DE_PAGE_GAUCHE_1;
global $PIED_DE_PAGE_DROIT_0;
global $PIED_DE_PAGE_DROIT_1;
$CAISSE_MVMNT['PIEDS_GAUCHE'][0]	= $PIED_DE_PAGE_GAUCHE_0;
$CAISSE_MVMNT['PIEDS_GAUCHE'][1]	= $PIED_DE_PAGE_GAUCHE_1;
$CAISSE_MVMNT['PIEDS_DROIT'][0]	= $PIED_DE_PAGE_DROIT_0;
$CAISSE_MVMNT['PIEDS_DROIT'][1]	= $PIED_DE_PAGE_DROIT_1;



//variable//type de champ(parametre)//lib?ll?//commentaire
// PARAMETRES MODIFIABLES
// FIN PARAMETRES MODIFIABLES
// CONFIGURATION PAR DEFAUT
// Portion de code recopi?e dans la partie ??param?tres modifiables?? en cas de remise ? 0 des param?tres.
/*
*/
// FIN CONFIGURATION PAR DEFAUT
// INFORMATIONS SUR L?AUTEUR
/* 
*/
?>