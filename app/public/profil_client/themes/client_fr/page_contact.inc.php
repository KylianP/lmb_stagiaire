<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables n�cessaires � l'affichage
$page_variables = array ();
check_page_variables ($page_variables);



// Interface PHP pour mail()
function sendMail($mFrom,$mTo,$sujet,$body) {
	$infos['mail_from_mail'] = $mFrom;
	
	$mail = new email();
	$mail->prepare_envoi(0, 0);
	return $mail->envoi($mTo , $sujet , $body , $infos);
}

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

$filename = "header.php";
if (file_exists($filename)) {
require ($filename);
}

$filename = "top.php";
if (file_exists($filename)) {
require ($filename);
}


$filename = "menu.php";
if (file_exists($filename)) {
require ($filename);
}

$filename = "content_before.php";
if (file_exists($filename)) {
require ($filename);
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" style="height:150px; width:300px">
		<br />
		<br />
		<div class="para"  style="text-align:center; margin:20px 0px;">
		<br />
		<br />

		<div style="width:800px;	margin:0px auto;">
		<div class="title_contact"></div>
		<table border="0" cellspacing="0" cellpadding="0" style="background-color:#FFFFFF">
			<tr>
				<td class="lightbg_liste1">&nbsp;</td>
				<td class="lightbg_liste"></td>
				<td class="lightbg_liste2">&nbsp;</td>
			</tr>
			<tr>
				<td class="lightbg_liste">&nbsp;</td>
				<td class="lightbg_liste">
				<table width="100%">
					<tr>
						<td>	
							<div class="infos_entreprise">
							
		<a href="http://www.lundimatin.fr" target="_blank">
		<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme();?>images/contact_logolmb.gif" />
		</a>
		<br /><br />

							<div class="nom_societe_interne" >
								<?php echo $nom_entreprise; ?>						
							</div>
							<div class="infos_coord">
								
								<?php 
									// Controle de l'adresse de l'entreprise
									if ($adresse_entreprise[0]->getText_adresse()) {
										echo $adresse_entreprise[0]->getText_adresse();		
									} 
								?> <br />
								<?php
									// Controle du code postal de l'entreprise
									if ($adresse_entreprise[0]->getCode_postal()) {
										echo $adresse_entreprise[0]->getCode_postal(), " ";		
									} 
									// Controle de la ville de l'entreprise
									if ($adresse_entreprise[0]->getVille()) {
										echo $adresse_entreprise[0]->getVille();
									}
								?> <br />
								<br />
								<?php 
									// Controle du num�ro de t�l�phone de l'entreprise
									if ($coordonnees_entreprise[0]->getTel1()) {
										echo " T�l : ", $coordonnees_entreprise[0]->getTel1();		
									} 
								?> <br />
								<?php 
									// Controle du num�ro de fax de l'entreprise
									if ($coordonnees_entreprise[0]->getFax()) {
										echo " Fax : ", $coordonnees_entreprise[0]->getFax();	
									} 
								?> <br />
�����
							</div>
							</div>
						</td>
						<td style="width:40%">
							<div class="coordonnees">
								
								<table cellpadding="0" cellspacing="0" border="0" style="width:50%; ">
								<tr>
								<td style="width:50%"></td>
								<td style="width:963px; background-color:#FFFFFF;">
								<!--contenu de la page-->
								<div class="main_content">
									<table cellpadding="0" cellspacing="0" border="0">
									<tr>
									
									<td style="width:50%">
									<div class="main_right">
											<div class="dark_text" >
												<script language="JavaScript">// Teste si le mail a une forme correcte
											function checkmail(email) {
												 var reg = /^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,4}$/
												 return (reg.exec(email)!=null)
											}
											// Teste le contenu des champs du form avant submit
											function test(nom,mail) {
											verif=true;
												 if(nom.value=="") {
														alert("Indiquez votre nom !"); 
														nom.focus(); 
														verif=false;
												 } else if(!checkmail(mail.value)) {
														alert("Email incorrect !"); 
														mail.focus(); 
														verif=false;
												 }
											return verif;
												 
											}
									 </script>
												<FORM method="post" action="" onSubmit="return test(this.Nom,this.Email)">
													</span>
													<table width="100%" border="0" cellspacing="3" cellpadding="0" style="font-size:20px;">
														<tr>
															<td class="lib_contact">							</td>
															<?php
															// On recherche la premi�re adresse mail dans l'adresse du contact
															$i = 0;
															while (!$coordonnees_entreprise[$i]->getEmail()) {
																$i++;
															}																			
															?>
															</select>
														<td>&nbsp;</td>
														<td rowspan="2">&nbsp;</td>
													</tr>
														<tr>
															<td class="lib_contact"><div class="lib_contact">Nom:</div></td>
														<td><input type=text name="Nom"   class="inp_contact"/></td>
														<td>&nbsp;</td>
														<td rowspan="2">&nbsp;</td>
													</tr>
														<tr>
															<td class="lib_contact"><div class="lib_contact">Email:</div></td>
														<td><input type=text name="Email"   class="inp_contact"/></td>
														<td>&nbsp;</td>
														</tr>
														<tr>
															<td class="lib_contact"><div class="lib_contact">T�l�phone:</div></td>
														<td><input type=text name="tel"  class="inp_contact"/></td>
														<td>&nbsp;</td>
														</tr>
														<tr>
															<td><div class="lib_contact">Message:</div></td>
															<td>
										<textarea rows="8" cols="36" name="Message"  class="inp_contact"></textarea></td>
															<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
														<tr>
															<td>&nbsp;</td>
															<td><input name="submit" type="submit" value="Envoyer" /></td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														</table>
														<?php
														// SI LE FORM A ETE POSTE
														if(isset($_POST["Email"])) {
															 // R�cup�re les �l�ments du form
															 $temp="";
															 while (list($truc, $val) = each($_POST)) {
																	$temp .= $truc." : ".$val."\n\n";
																	}
															 // Caract�res sp�ciaux
															 $temp = stripslashes($temp);
															 // Envoie le message
															 // L'�metteur est aussi le r�cepteur dans cet exemple !
															 if(@sendmail($_POST["Email"], $coordonnees_entreprise[1]->getEmail(), "Contact depuis le site Infolys.com",$temp)) {
																	// Affiche un message de confirmation
																	echo "<br /><font color=red>Le message a bien �t� envoy� !</font>";
															 } else {
																	// ou un message d'erreur
																	echo "<br /><font color=red>Impossible d'envoyer le message !</font>";
															 }
														
														} 
														
														?>
											</FORM>
											</div>
									</div>	</td>
									</tr>
									</table>
								</div>
								</td>
								<td style="width:50%"></td>
								</tr>
								</table>
								<script type="text/javascript">
								<?php
								if (isset($_REQUEST["mailto"])) {
									?>
									document.getElementById("mailto").selectedIndex = <?php echo $_REQUEST["mailto"];?>;
									<?php
								}
								?>
								</script>
							</div>	<!-- div coordonnees -->
						</td>


�									</tr>
				</table>
				
		
				</td>
				<td class="lightbg_liste">&nbsp;</td>
			</tr>
			<tr>
				<td class="lightbg_liste4"></td>
				<td class="lightbg_liste">&nbsp;</td>
				<td class="lightbg_liste3">&nbsp;</td>
			</tr>
		</table>
		<br />
		<br />
		</div>
		</div>
		</td>
	</tr>
</table>
<?php 
$filename = "content_after.php";
if (file_exists($filename)) {
require ($filename);
}

$filename = "footer.php";
if (file_exists($filename)) {
require ($filename);
}
?>

