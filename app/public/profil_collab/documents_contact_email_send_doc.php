<?php
// *************************************************************************************************************
// ENVOI D'UN DOCUMENT PAR EMAIL envois rapide vers 1 destinataire
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

$erreur_email = false;
$msg = "";
if (isset($_REQUEST["ref_doc"])) {
	$document = open_doc ($_REQUEST['ref_doc']);
	
	$liste_email = array();
	if ($document->getRef_contact()) {
		$liste_email = get_contact_emails ($document->getRef_contact());
	}
	
	$liste_destinataires = explode(";", $_REQUEST["destinataires"]);
	foreach($liste_destinataires as $destinataire){
		if (!preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i", $destinataire)) {
			$erreur_email = true;
			$msg = "L'email de destination n'est pas valide.";
		}
		
	}
	if (!$erreur_email) {
	
		if (!$retour = $document->mail_document ($_REQUEST["destinataires"] , $_REQUEST["titre"] , $_REQUEST["message"])) {
			$erreur_email = true;
			$msg = "Une erreur est survenue lors de l'envoi de l'email.";
		}
		
	}
}

// *************************************************************************************************************
// AFFICHAGE
// -*************************************************************************************************************
include ($DIR.$_SESSION['theme']->getDir_theme()."page_documents_contact_email_send_doc.inc.php");

?>