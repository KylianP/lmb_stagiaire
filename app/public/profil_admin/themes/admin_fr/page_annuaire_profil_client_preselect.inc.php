
<?php

// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables n?cessaires ? l'affichage
$page_variables = array ("_ALERTES");
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************




// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<?php 
foreach ($_ALERTES as $alerte => $value) {
	echo $alerte." => ".$value."<br>";
}
?>
<script type="text/javascript">
<?php
foreach ($liste_categories_client as $liste_categorie_client){
	if ($liste_categorie_client->id_client_categ == $_REQUEST["id_client_categ"]) {
		?>
		preselect (<?php if (isset($liste_categorie_client->id_tarif)) { echo $liste_categorie_client->id_tarif;} else { echo "0";}?>, "id_tarif");
		preselect (<?php if (isset($liste_categorie_client->factures_par_mois)) { echo $liste_categorie_client->factures_par_mois;} else { echo "0";}?>, "factures_par_mois");
		$("delai_reglement").value = <?php if (isset($liste_categorie_client->delai_reglement)) { echo $liste_categorie_client->delai_reglement;} else { echo "0";}?>;
		$("ref_commercial").value = '<?php if (isset($liste_categorie_client->ref_commercial)) { echo $liste_categorie_client->ref_commercial;} else { echo "";}?>';
		$("nom_commercial").value = '<?php if (isset($liste_categorie_client->nom_commercial)) { echo $liste_categorie_client->nom_commercial;} else { echo "";}?>';
		<?php 
	}
}
?>
</script>