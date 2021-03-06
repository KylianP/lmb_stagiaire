<?php
// *************************************************************************************************************
// PAGE DE VALIDATION D'INSCRIPTION DE L'UTILISATEUR
// *************************************************************************************************************
unset($GLOBALS['_ALERTES']);
$_INTERFACE['MUST_BE_LOGIN'] = 0;
require ("__dir.inc.php");
require ($DIR."_session.inc.php");

$inscription_ok = 0;
// V?rification des param?tres
if (!isset($_REQUEST['coord']) || !isset($_REQUEST['code'])) {
	$GLOBALS['_ALERTES']["params"] = 1;
}else{
	$ref_coord = $_REQUEST['coord'];
	$code = $_REQUEST['code'];
	// Liste des langages
	$langages = getLangues();
	
	// On v?rifie si on a un enregistrement correspondant aux param?tres dans la table users_creations_invitations
	global $bdd;
	$query = "SELECT COUNT(*) AS nb
				FROM users_creations_invitations 
				WHERE ref_coord = '" . $ref_coord . "' 
					AND code = '" . $code . "';";
	$res = $bdd->query($query);
	if($enr = $res->fetchObject()){
		if(!$enr->nb){
			$GLOBALS['_ALERTES']['no_uci_existing'] = 1;
		}else{
			// On v?rifie si un utilisateur existe d?j? pour la coordonn?e fournie
			$query = "SELECT ref_coord_user, actif, ref_user FROM users WHERE ref_coord_user = '" . $ref_coord . "';";
			$resultat = $bdd->query($query);
			if ($tmp= $resultat->fetchObject()) {
				if ($tmp->actif == -1) {
					// On supprime la ref_coord_user de l'utilisateur archiv?
					$query = "UPDATE users 
										SET ref_coord_user = NULL 
										WHERE ref_user = '".$tmp->ref_user."' ";
					$bdd->exec ($query);
				} else {
					$GLOBALS['_ALERTES']['used_ref_coord_user'] = 1;
				}
			}else{
				// Si aucun utilisateur n'existe pour cette coordonn?e, on peut l'ajouter
				if(isset($_REQUEST['login'])){
					// Traitement
					$pseudo = $_REQUEST['login'];
					$pass = $_REQUEST['password'];
					$actif = 1;
					$id_langage = $_REQUEST['user_id_langage'];
					// On v?rifie que le login n'existe pas d?j?
					$query2 = "SELECT * FROM users WHERE pseudo = '" . $pseudo . "';";
					$res2 = $bdd->query($query2);
					if($res2->rowCount()){
						$GLOBALS['_ALERTES']["login_used"] = 1;
					}else{
						// On cr?? les donn?es
						$coordonnee = new coordonnee($ref_coord);
						$utilisateur = new utilisateur();
						$utilisateur->create($coordonnee->getRef_contact(), $ref_coord, $pseudo, $actif, $pass, $id_langage);
						// Envoyer mail ? l'admin pour dire que le compte a ?t? cr?? : id = $GLOBALS['_INFOS']['Cr?ation_utilisateur'] ?
						
						// On supprime l'invitation dans uci
						$query_del = "DELETE FROM users_creations_invitations WHERE ref_coord = '" . $ref_coord . "';";
						$bdd->query($query_del);
						// On envoie un mail de rappel des identifiants ? l'utilisateur
						// Envoi de l'email avec template
						$mail = new email();
						$mail->prepare_envoi(1, 0);
						restore_error_handler();
						error_reporting(0);
						global $ID_MAIL_TEMPLATE_INVITATION_INSCRIPTION;
						global $ID_MAIL_TEMPLATE;
						global $REF_CONTACT_ENTREPRISE;
						// On r?cup?re l'identifiant du template de mail pour l'invitation ? la cr?ation d'un compte
						$ID_MAIL_TEMPLATE = $ID_MAIL_TEMPLATE_INVITATION_INSCRIPTION;
						// Chargement du nom de l'entreprise
						$contact_entreprise = new contact($REF_CONTACT_ENTREPRISE);
						$nom_entreprise = str_replace (CHR(13), " " ,str_replace (CHR(10), " " , $contact_entreprise->getNom()));
						$lib_civ = $contact_entreprise->getLib_civ_court();
						// Envoi de l'email
						$destinataire = $coordonnee->getEmail();
						$sujet = "[" . $nom_entreprise . "] Votre compte utilisateur LMB";
						$message = "<br /><br />Bonjour, <br />
										Votre inscription sur le site de " . $lib_civ . " " . $nom_entreprise . " a bien ?t? effectu?e. <br />
										Vous pouvez maintenant vous connecter au logiciel Lundi Matin Business ? l'adresse suivante : <br />
										<a href=\"" . url_site() . "\">" . url_site() . "</a><br /><br />
										Pour m?moire, voici vos identifiants : <br />
										Identifiant : " . $pseudo . "<br />
										Mot de passe : " . $pass . "<br />
										Veuillez conserver cet e-mail dans vos archives. 
										<br /><br />
										L'?quipe " . $nom_entreprise;
						if(!$mail->envoi_email_templated($destinataire, $sujet, $message)){
							echo "Une erreur est survenue lors de l'envoi ? ".$this->email."<br />";
						}
						set_error_handler("error_handler");
						$inscription_ok = 1;
						unset($_REQUEST['coord']);
						unset($_REQUEST['code']);
					}
				}
			}
		}
	}
}
$GLOBALS["_ERREURS"] = array();
foreach($_ALERTES as $nom => $valeur){
	switch($nom){
		case "login_used":
			$GLOBALS["_ERREURS"][$nom] = $valeur;
			unset($GLOBALS["_ALERTES"][$nom]);
			break;
		default:
			break;
	}
}
// Chargement du nom de l'entreprise
$contact_entreprise = new contact($REF_CONTACT_ENTREPRISE);
$nom_entreprise = str_replace (CHR(13), " " ,str_replace (CHR(10), " " , $contact_entreprise->getNom()));
$lib_civ = $contact_entreprise->getLib_civ_court();

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************
include ($DIR.$_SESSION['theme']->getDir_theme()."page_valider_inscription.inc.php");

?>