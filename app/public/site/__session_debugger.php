<?php
// *************************************************************************************************************
// [ADMINISTRATEUR] RECHERCHE D'UNE FICHE D'ARTICLE
// *************************************************************************************************************

$_INTERFACE['MUST_BE_LOGIN'] = 0;

require ("__dir.inc.php");
require ($DIR."_session.inc.php");



echo "
***********************************************************************************<br>
************************************ 	DEBUGGER  ***********************************<br>
***********************************************************************************<br>

<br>
<b>UTILISATEUR :</b> ";
if ($_SESSION['user']->getPseudo()) {
	echo $_SESSION['user']->getPseudo()."<br>
	D?but de session ? ".date("d-m-Y H:i:s", $_SESSION['date_debut_user_session']);
}
else {
	echo "Non identifi?";
}
echo "<hr><br>

<b>MAGASIN</b> :".$_SESSION['magasin']->getLib_magasin()." (<b>".$_SESSION['magasin']->getId_magasin()."</b>)<br>
Tarif associ? : ".$_SESSION['magasin']->getLib_tarif()." (<b>".$_SESSION['magasin']->getId_tarif()."</b>)<br> 
Stock utilis? : ".$_SESSION['magasin']->getLib_stock()." (<b>".$_SESSION['magasin']->getId_stock()."</b>)<br> ";

?>