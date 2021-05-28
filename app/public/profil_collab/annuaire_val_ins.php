<?php
// *************************************************************************************************************
// 
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ($DIR."_session.inc.php");

$rc = true;
if (isset($_REQUEST['id_contact_tmp']) && isset($_REQUEST['id_interface']) && isset($_REQUEST['etat'])) {
  $interface = $_SESSION['interfaces'][$_REQUEST['id_interface']];
  if ($_REQUEST['etat']==1) {
    $rc = $interface->valider_inscription_contact($_REQUEST['id_contact_tmp']);
  } else if ($_REQUEST['etat'] == 2){
    $rc = $interface->modification_contact_valide($_REQUEST['id_contact_tmp']);
  } else {
    $interface->supprimer_inscription($_REQUEST['id_contact_tmp']);
  }
}
?>


<script type="text/javascript">
  <?php if ($_REQUEST['etat']==1) { ?>
  alerte.alerte_erreur ('Validation des inscriptions', '<?php echo ($rc) ? "Validation effectuée avec succès." : "Erreur lors de la validation"; ?>','<input type="submit" id="bouton0" name="bouton0" value="Ok" />');
  <?php } if (($_REQUEST['etat'] == 1 && $rc) || $_REQUEST['etat'] != 1)  echo "remove_tag('id_ins_".$_REQUEST['id_contact_tmp']."_".$_REQUEST['id_interface']."');"; ?>
</script>
