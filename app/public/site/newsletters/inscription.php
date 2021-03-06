<?php
// *************************************************************************************************************
// Inscription d'un email ? une newsletter
// *************************************************************************************************************

$_INTERFACE['MUST_BE_LOGIN'] = 0;

require ("__dir.inc.php");

if (!file_exists($DIR."config/newsletter.config.php")) {
	//v?rification de l'existence du code s?curit? de l'envoi de newsletter
	if (!$file_config_newsletter = @fopen ($DIR."config/newsletter.config.php", "w")) {
		$erreur = "Impossible de cr?er le fichier de configuration config/newsletter.config.php "; 
	} else {
		$file_content = "<?php
		// *************************************************************************************************************
		// CODE DE SECURITE DE L'ENVOI DE NEWSLETTERS
		// *************************************************************************************************************
		
		\$CODE_SECU_NEWSLETTER = \"".rand(1000, 9999)."\"; 
		
		?>";
		
		if (!fwrite ($file_config_newsletter, $file_content)) {
			$erreur = "Impossible d'?crire dans le fichier de configuration config/newsletter.config.php"; 
		}
	}
	fclose ($file_config_newsletter);
	
}
require ($DIR."_session.inc.php");
require ($DIR."config/newsletter.config.php");

$liste_newletters = charger_newsletters ();

if (!isset($_REQUEST["id_newsletter"])) {
	$current_newsletter = 0;
	foreach ($liste_newletters as $newsletter) {
	 if ($newsletter->inscription_libre) {$current_newsletter = $newsletter->id_newsletter; break;}
	}
} else {
	$current_newsletter = $_REQUEST["id_newsletter"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inscription ? la newsletter</title>
<style>
body {font: 12px Arial, Helvetica, sans-serif;
color:#000000;
padding:25px;
}
</style>
</head>
<body>
<?php 
if (isset($_REQUEST["email"]) && $_REQUEST["email"] && preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i", $_REQUEST["email"]) && 
		isset($_REQUEST["code"])) {
	$newsletter = new newsletter($current_newsletter);
	// Si l'inscription a bien ?t? valid?e
	if ($newsletter->maj_newsletter_newsletters_inscriptions ($_REQUEST["email"], $_REQUEST["code"])) {
		?>
		Votre inscription ? la newsletter <?php echo $newsletter->getNom_newsletter();?> a bien ?t? prise en compte.
		<?php 
	} else {
		if(isset($GLOBALS['_INFOS']['validation_inscription_newsletter']) && $GLOBALS['_INFOS']['validation_inscription_newsletter'] == -1){
			?>
			Le code de confirmation est incorrect. Votre inscription ne peut pas ?tre valid?e pour la newsletter : <?php echo $newsletter->getNom_newsletter();?>. 
			<?php
		}elseif(isset($GLOBALS['_INFOS']['validation_inscription_newsletter']) && $GLOBALS['_INFOS']['validation_inscription_newsletter'] == -2){
			?>
			Vous avez d?j? valid? votre inscription pour la newsletter <?php echo $newsletter->getNom_newsletter();?>. 
			<?php	
		}else{
			?>
			Votre adresse n'a pas ?t? enregistr?e pour l'abonnement ? la newsletter <?php echo $newsletter->getNom_newsletter();?>. 
			<?php
		}
	}
} elseif ($current_newsletter && isset($_REQUEST["email"]) && 
				$_REQUEST["email"] && preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i", $_REQUEST["email"]) && 
				(!isset($_REQUEST["code"]) )) {
	$newsletter = new newsletter($current_newsletter);
	// Pr?inscription
	if ($url_inscription = $newsletter->add_newsletter_newsletters_inscriptions ($_REQUEST["email"])) {
		$texte = "<br />Merci de cliquez sur le lien suivant pour confirmer votre inscription : <br />";
		$lien	= "<a href='http://".$_SERVER['HTTP_HOST'].str_replace("site/newsletters/inscription.php", "", $_SERVER['PHP_SELF']).
							$url_inscription."' target='_blank'> http://".
							$_SERVER['HTTP_HOST'].str_replace("site/newsletters/inscription.php", "", $_SERVER['PHP_SELF']).$url_inscription."</a>";
		
		// Ent?te du mail
		$limite = "_parties_".md5(uniqid(rand()));
		$mail_mime = "Date: ".date("r")."\n";
		$mail_mime .= "MIME-Version: 1.0\n";
		$mail_mime .= "Content-Type: multipart/mixed;\n";
		$mail_mime .= " boundary=\"----=$limite\"\n\n";
		
		restore_error_handler();
		error_reporting(0);
		// Envoi de l'email
		$mail = new email();
		$mail->prepare_envoi(0, 0);
		if (!$mail->envoi($_REQUEST["email"] , $newsletter->getMail_inscription_titre() , $newsletter->getMail_inscription_corps()."<br />".$texte.$lien."<br />" , 
				"Reply-to: ".$newsletter->getMail_retour()."\nFrom:".$newsletter->getNom_expediteur()." <".$newsletter->getMail_expediteur().">"."\n".$mail_mime)) {
			echo "Une erreur est survenue lors de l'envoi ? ".$_REQUEST["email"]."<br />"; exit;
		}
		set_error_handler("error_handler");
		
		$contact_entreprise = new contact($REF_CONTACT_ENTREPRISE);
		$nom_entreprise = str_replace (CHR(13), " " ,str_replace (CHR(10), " " , $contact_entreprise->getNom()));
		?>
		<p style="font-weight:bolder">Un email de confirmation d'inscription vient de vous ?tre envoy?.</p>
		<br /><br />
		<p style="font-weight:bolder">Afin de valider d?finitivement votre inscription, cliquez sur le lien pr?sent en bas de l'email de confirmation afin recevoir des informations concernant <?php echo $nom_entreprise;?>.</p>
		<br />
		Votre inscription concerne uniquement les emails li?s ? la newsletter "<?php echo $newsletter->getNom_newsletter();?>".<br />
	
		Pour vous d?sinscrire des newsletters, il vous suffit de cliquer au bas des emails que vous recevrez.
		<?php 
	} else {
		?>
		<p style="font-weight:bolder">Cet email (<?php echo $_REQUEST["email"];?>) est d?j? inscrit pour cette newsletter (<?php echo $newsletter->getNom_newsletter();?>).</p>
		<?php 
	}
} elseif (isset($_REQUEST["email"]) && $_REQUEST["email"] && !preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i", $_REQUEST["email"])){
	?>
	Votre adresse email semble invalide.
	<?php
}else {
	?>
	La gestion des newsletters est d?sactiv?e sur ce site, veuillez contacter l'administrateur du site.
	<?php
} 	<p style="font-weight:bolder">Afin de valider d?finitivement votre inscription, cliquez sur le lien pr?sent en bas de l'email de confirmation afin recevoir des informations concernant <?php echo $nom_entreprise;?>.</p>
	<br />
	Votre inscription concerne uniquement les emails li?s ? la newsletter "<?php echo $newsletter->getNom_newsletter();?>".<br />

	Pour vous d?sinscrire des newsletters, il vous suffit de cliquer au bas des emails que vous recevrez.
	<?php
} elseif (isset($current_newsletter) && isset($_REQUEST["email"]) && $_REQUEST["email"] && !preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i", $_REQUEST["email"])){

	?>
	Votre adresse email semble invalide.
	<?php
}else {
	?>
	La gestion des newsletter est d?sactiv?e sur ce site, veuillez contacter l'administrateur du site.
	<?php
} 
?>
</body>
</html>
