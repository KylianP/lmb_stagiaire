<?PHP 
$CONFIGURATION=1;

// CODE NON PARAMETRABLE
global $DOCUMENTS_IMG_LOGO;
$DOC_STANDARD['IMG_LOGO']	= $DOCUMENTS_IMG_LOGO;

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

$DOC_STANDARD['ENTETE_COL_REF'] = "R�f�rence";
$DOC_STANDARD['ENTETE_COL_DES'] = "D�signation";
$DOC_STANDARD['ENTETE_COL_QTE'] = "Qt�";
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
$DOC_STANDARD['CORPS_HAUTEUR_MAX']		= 120;

// PIEDS DE PAGE
$DOC_STANDARD['PIEDS_HAUTEUR_DEPART']	= 230;
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

$DOC_STANDARD['RAISON'] = "NETVOLUTION SAS";
$DOC_STANDARD['FORME_JURIDIQUE'] = "SAS au capital de 5.000 �";
$DOC_STANDARD['ADRESSE1'] = "27, rue Branly";
$DOC_STANDARD['ADRESSE2'] = "59000 Lille - France";
$DOC_STANDARD['TEL'] = "(+33) 3 66 72 13 52";
$DOC_STANDARD['FAX'] = "(+33) 9 72 15 48 67";
$DOC_STANDARD['EMAIL'] = "contact@netvolution.fr";
$DOC_STANDARD['WEB'] = "www.netvolution.fr";
$DOC_STANDARD['RCS'] = "Lille 523 733 467";
$DOC_STANDARD['TVA'] = "FR39 523 733 467";
$DOC_STANDARD['IBAN'] = "FR76 3002 7171 4200 0202 6290 194";
$DOC_STANDARD['BIC'] = "CMCIFRPP";

//variable//type de champ(parametre)//lib�ll�//commentaire
// PARAMETRES MODIFIABLES
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][0]="Montants exprim�s en Euros. Aucun escompte ne sera accord� pour paiement anticip�. Tout retard de r�glement donnera lieu de plein droit et sans qu'aucune mise en demeure ne soit";//TXTE()// Texte entre corps et pied de page//ligne n�1
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][1]="n�cessaire au paiement de p�nalit�s de retard sur la base du taux BCE major� de dix (10) points et au paiement d'une indemnit� forfaitaire pour frais de recouvrement d'un montant de 40�.";//TXTE()// Texte entre corps et pied de page//ligne n�2
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][2]="R�serve de propri�t� applicable selon la loi n�80.335 du 12 mai 1980. En cas de litige, est seul comp�tent le tribunal du ressort du si�ge social de l'entreprise.";//TXTE()// Texte entre corps et pied de page//ligne n�3
// FIN PARAMETRES MODIFIABLES
// CONFIGURATION PAR DEFAUT
// Portion de code recopi�e dans la partie ��param�tres modifiables�� en cas de remise � 0 des param�tres.
/*
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][0]="Aucun escompte ne sera accord� pour paiement anticip�.";//TXTE()// Texte entre corps et pied de page//ligne n�1
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][1]="Tout retard de paiement engendre des p�nalit�s exigibles le jour suivant, calcul�es sur la base du taux l�gal + 5%";//TXTE()// Texte entre corps et pied de page//ligne n�2
$DOC_STANDARD['TEXTE_CORPS_PIEDS'][2]="R�serve de propri�t� applicable selon la loi n�80.335 du 12 mai 1980. En cas de litige, est seul comp�tent le tribunal du ressort du si�ge social de l'entreprise.";//TXTE()// Texte entre corps et pied de page//ligne n�3
*/
// FIN CONFIGURATION PAR DEFAUT
// INFORMATIONS SUR L�AUTEUR
/* 
*/
?>
