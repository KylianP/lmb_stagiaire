<?php
// *************************************************************************************************************
// CATALOGUE CLIENT PANIER PAIEMENT
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$CLIENT_ID_PROFIL]->getCode_profil().".config.php");


$GLOBALS['_OPTIONS']['CREATE_DOC']['ref_contact'] = $_SESSION['user']->getRef_contact ();
gestion_panier();

$liste_contenu = $_SESSION["panier_interface_".$_INTERFACE['ID_INTERFACE']]["contenu"];

$panier = open_client_panier ();
$panier->maj_id_livraison_mode ($_REQUEST['id_livraison_mode']) ;

//$liste_contenu = $panier->getContenu();



	$livraison_modes = charger_livraisons_modes();
	
	foreach ($livraison_modes as $liv_mod) {
		$tmp_livraison_mode = new livraison_modes ($liv_mod->id_livraison_mode);
		$liv_mod->cout_liv = $tmp_livraison_mode->contenu_calcul_frais_livraison($panier);
		$liv_mod->nd = 0;
		if (isset($GLOBALS['_INFOS']['calcul_livraison_mode_ND']) || isset($GLOBALS['_INFOS']['calcul_livraison_mode_nozone']) || isset($GLOBALS['_INFOS']['calcul_livraison_mode_impzone'])) {
			$liv_mod->nd = 1;
			unset($GLOBALS['_INFOS']['calcul_livraison_mode_ND'], $GLOBALS['_INFOS']['calcul_livraison_mode_nozone'], $GLOBALS['_INFOS']['calcul_livraison_mode_impzone']);
		}
	}
	sort($livraison_modes);
	
	
	$reglements_dispos = array();
	$reglements = explode(";", $REGLEMENTES_MODES_VALIDES);
	$reglements_modes	 = getReglements_modes();
	foreach ($reglements_modes as $reglement) {
		if (!in_array($reglement->id_reglement_mode, $reglements) ) { continue;}
		$reglements_dispos[] = $reglement;
	}
// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

include ($DIR.$_SESSION['theme']->getDir_theme()."page_catalogue_panier_validation_step3.inc.php");

?>