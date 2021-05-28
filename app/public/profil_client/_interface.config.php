<?php
// *************************************************************************************************************
// PARAMETRES GENERAUX DE CONFIGURATION DE L'INTERFACE "PROFIL CLIENT"
// *************************************************************************************************************
$_INTERFACE['ID_INTERFACE'] 	= 4;
$_INTERFACE['ID_PROFIL'] 			= 4;
$_INTERFACE['MUST_BE_LOGIN'] 	= 1;

// *************************************************************************************************************
// PARAMETRES SPECIFIQUES DE CONFIGURATION DE L'INTERFACE "PROFIL CLIENT"
// *************************************************************************************************************

$_INTERFACE['APP_TARIFS'] = "TTC";


$ID_MAGASIN	= 1;
$ID_CATALOGUE_INTERFACE	= 5;

$NOM_LOGO = "logo.jpg";

$AFF_CAT_VISITEUR = 0; //Affichage du catalogue pour les visiteurs non identifi�s
$AFF_CAT_PRIX_VISITEUR = 0;  //Affichage du catalogue (par d�faut) pour les visiteurs non identifi�s
$AFF_CAT_CLIENT = 1; //Affichage des prix pour les visiteurs  identifi�s
$AFF_CAT_PRIX_CLIENT = 1;//Affichage des prix (par d�faut) pour les visiteurs identifi�s

$INSCRIPTION_ALLOWED = 1; //Possibilit� de s'incrire depuis le dossier. 0 non; 1 oui avec validation; 2 oui automatiquement.

$MODIFICATION_ALLOWED = 1; //Possibilit� dmodifier les infos depuis le dossier. 0 non; 1 oui avec validation; 2 oui automatiquement.

$ID_MAIL_TEMPLATE = 1;

$MAIL_ENVOI_INSCRIPTIONS = "";

//dur�e d'affichage des documents termin�s
$DUREE_AFF_DOC_DEV = "7776000";  //dur�e d'affichage dans l'interface des devis clients
$DUREE_AFF_DOC_CDC = "8553600";  //dur�e d'affichage dans l'interface des commandes clients
$DUREE_AFF_DOC_FAC = "259200";  //dur�e d'affichage dans l'interface des factures clients

//type de pdf affich�
$CODE_PDF_MODELE_DEV = "doc_dev_lmb";
$CODE__PDF_MODELE_CDC = "doc_cdc_lmb";
$CODE__PDF_MODELE_FAC = "doc_fac_lmb";

//contenu des mail
$SUJET_INSCRIPTION_VALIDATION = "Inscription � notre site non";
$CONTENU_INSCRIPTION_VALIDATION = "Bonjour et bienvenue, 
Vous venez de vous inscrire sur notre site et n ous vous en remercions. pas

Afin de confirmer votre identit�, veuillez cliquer sur le lien ci-dessous�:";



$SUJET_INSCRIPTION_VALIDATION_FINAL = "Validation de votre inscription � notre site";
$CONTENU_INSCRIPTION_VALIDATION_FINAL = "Bonjour et bienvenue,
Vous venez de vous inscrire sur notre site et nous vous en remercions.
Veuillez trouver ci-dessous vos identifiants de connection.

Retenez bien ces informations:
";

$SUJET_MODIFICATION_VALIDATION = "Modification de vos informations personnelles sur notre site";
$CONTENU_MODIFICATION_VALIDATION = "Bonjour,
Vos informations personnelles ont �t� modifi�es.

Afin de confirmer ces modifications, veuillez cliquer sur le lien ci-dessous�:";



$SUJET_MODIFICATION_VALIDATION_FINAL = "Validation de la modification de vos informations personnelles sur notre site";
$CONTENU_MODIFICATION_VALIDATION_FINAL = "Bonjour,
La modification de vos informations personnelles a �t� valid�e.

Veuillez trouver ci-dessous vos identifiants de connection.

Retenez bien ces informations:
";


//r�glement_modes_valides

$REGLEMENTES_MODES_VALIDES = ""; //mode de r�glement


//pages diverses
$QUISOMMESNOUS = "";
$MENTIONSLEGALES = "";
$CONDITIONSDEVENTES = " ";
$BAS_PAGE = "";

$COMPLEMENT_CHAMPS = array ();


?>