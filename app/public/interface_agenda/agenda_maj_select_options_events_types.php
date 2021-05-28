<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

if(!isset($_REQUEST["ref_agenda"])){
	echo "la référence de l'agenda n'est pas spécifiée";
	exit;
}
$ref_agenda = $_REQUEST["ref_agenda"];

$eventsTypesAvecDroitOfAg = $_SESSION["agenda"]["GestionnaireEvenements"]->getEventsTypesAvecDroits($ref_agenda);
//$eventsTypesAvecDroitFirstAg[ID_TYPE_EVENT] = array();
//$eventsTypesAvecDroitFirstAg[ID_TYPE_EVENT]["libEvent"] = string;
//$eventsTypesAvecDroitFirstAg[ID_TYPE_EVENT]["affiche"] = bool;
//$eventsTypesAvecDroitFirstAg[ID_TYPE_EVENT]["droits"] = int[];

reset($eventsTypesAvecDroitOfAg);
for ($i = 0; $i< count($eventsTypesAvecDroitOfAg); $i++){
	$index = key($eventsTypesAvecDroitOfAg); 
	?><option <?php echo 'value="'.$index.'" '; if($i==0){ echo 'selected="selected"'; } ?> ><?php 
	echo $eventsTypesAvecDroitOfAg[$index]["libEvent"];
	?></option>
<?php next($eventsTypesAvecDroitOfAg);} ?>
