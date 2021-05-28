<?php
// *************************************************************************************************************
// ENVOI D'UN DOCUMENT PAR EMAIL
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

$erreur_email = false;
if (isset($_REQUEST["ref_doc"])) {
	$GLOBALS['_OPTIONS']['CREATE_DOC']['no_charge_all_sn'] = 1;
	$document = open_doc ($_REQUEST['ref_doc']);
	
	if (isset($_REQUEST["filigrane"])) { $GLOBALS['PDF_OPTIONS']['filigrane'] = $_REQUEST["filigrane"];}
	
	if (isset($_REQUEST["code_pdf_modele"])) {
		$document->change_code_pdf_modele ($_REQUEST["code_pdf_modele"]);
	}
	
	$liste_email = array();
	if ($document->getRef_contact()) {
		$liste_email = get_contact_emails ($document->getRef_contact());
	}
	
	$liste_destinataires = explode(";", $_REQUEST["destinataires"]);
	foreach($liste_destinataires as $destinataire){
		if (!preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i", $destinataire)) {
			$erreur_email = true;
			$msg = "Un email de destination n'est pas valide.";
		}
		
	}
	
	if (!$erreur_email) {
	
		if (!$retour = $document->mail_document ($liste_destinataires , $_REQUEST["titre"] , nl2br($_REQUEST["message"]))) {
			$erreur_email = true;
			$msg = "Une erreur est survenue lors de l'envoi de l'email.";
		}
		
	}
}

// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************
if ($erreur_email) {
	$contact_entreprise = new contact($REF_CONTACT_ENTREPRISE);
	include ($DIR.$_SESSION['theme']->getDir_theme()."page_documents_editing_email.inc.php");
} else {
	include ($DIR.$_SESSION['theme']->getDir_theme()."page_documents_editing_email_submit.inc.php");
}

?>