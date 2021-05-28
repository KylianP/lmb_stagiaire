<?php
// *************************************************************************************************************
// CONTROLE DU THEME
// *************************************************************************************************************

// Variables nécessaires à l'affichage
$page_variables = array ("_ALERTES", "ANNUAIRE_CATEGORIES", "DEFAUT_ID_PAYS", "listepays", "civilites");
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************	



// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

///////////// for delete /////////////////
// pour l'instant
$debut = 1;
///////////// for delete /////////////////


 /* $cfg_nb_pages = 10;
  $barre_nav = "";
  $debut =(($form['page_to_show']-1)*$form['fiches_par_page']);
  
  $barre_nav .= barre_navigation($nb_fiches, $form['page_to_show'], 
                                       $form['fiches_par_page'], 
                                       $debut, $cfg_nb_pages,
                                       'page_to_show_s',
  																		 'page.annuaire_recherche_simple()');

*/

?>
<?php if (!isset($_REQUEST['val_mail'])) {?>
<div id="popup_more_infos" class="mini_moteur_doc" style="display:none;" ></div>
<div class="emarge">

<p class="titre">Validation des inscriptions en attentes</p>
<?php //print_r($listeinscriptions[0]); echo "<br /> ###"; print_r(array_keys($listeinscriptions[0]->infos[4], "nom")); echo "###"; ?>
<div  class="contactview_corps">
<div id="valid_inscription"  style="OVERFLOW-Y: auto; OVERFLOW-X: auto; padding:10px ">
<?php } ?>
<div class="mt_size_optimise">


<div id="affresult">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="text-align:left;">
    	<span id="aff_ins_valid" 
    		<?php 	if ((!isset($_REQUEST['val_mail']) || (isset($_REQUEST['val_mail']) && $_REQUEST['val_mail'] == 1)) && !isset($modifs))
    					echo 'style="font-weight:bold;"';
    				else
    					echo 'style="cursor: pointer;"'; ?>
    	>Inscriptions confirmées</span>
    	&nbsp;&nbsp;&nbsp;
    	<span id="aff_ins_non_valid" 
    		<?php 	if ((isset($_REQUEST['val_mail']) && $_REQUEST['val_mail'] == 0) && !isset($modifs)) 
    					echo 'style="font-weight:bold;"'; 
    				else  
    					echo 'style="cursor: pointer;"'; ?>
    	>Inscriptions non confirmées</span>
    	&nbsp;&nbsp;&nbsp;
    	<span id="aff_mod_valid" 
    		<?php 	if ((!isset($_REQUEST['val_mail']) || (isset($_REQUEST['val_mail']) && $_REQUEST['val_mail'] == 1)) && isset($modifs)) 
    					echo 'style="font-weight:bold;"'; 
    				else  
    					echo 'style="cursor: pointer;"'; ?>
    	>Modifications confirmées</span>
    	&nbsp;&nbsp;&nbsp;
    	<span id="aff_mod_non_valid" 
    		<?php 	if (isset($modifs) && isset($_REQUEST['val_mail']) && $_REQUEST['val_mail'] == 0) 
    					echo 'style="font-weight:bold;"'; 
    				else  
    					echo 'style="cursor: pointer;"';?>
    	>Modifications non confirmées</span>
    <script type="text/javascript">
    <?php if (isset($_REQUEST['val_mail']) && $_REQUEST['val_mail'] == 0) { ?>
      Event.observe("aff_ins_valid", "click", function (evt){
          chargerInsSansMail(1);
      },false);
      <?php } else {?>
      Event.observe("aff_ins_non_valid", "click", function (evt){
          chargerInsSansMail(0);
      },false);
      <?php } ?>
      <?php if (isset($_REQUEST['val_mail']) && $_REQUEST['val_mail'] == 0) { ?>
      Event.observe("aff_mod_valid", "click", function (evt){
          chargerModSansMail(1);
      },false);
      <?php } else {?>
      Event.observe("aff_mod_non_valid", "click", function (evt){
          chargerModSansMail(0);
      },false);
      <?php } ?>
    </script>
    </td>
    <td id="nvbar"><?php //echo $barre_nav;?></td>
    <td style="text-align:right;display:none;"> Inscriptions en attentes : <?php echo count($listeinscriptions); ?></td>
  </tr>
</table></div>

<table  cellspacing="0" id="tableresult">
  <tr class="colorise0">
    <td style="width:30%">
      <a href="#"  id="order_nom">
      Nom (Civilité)
      </a>
    </td>
    <td style="width:25%;">
    Profil
    </td>
    <td style="width:20%;">
       Catégorie
    </td>
    <td style="width:20%">
      + de détails
    </td>
    <td style="width:9%">&nbsp;
    </td>
    <td style="width:9%">&nbsp;
    </td>
  </tr>
  
  <?php
  if (!isset($modifs)) {
  $colorise=0;
  foreach ($listeinscriptions as $inscription) {
    $colorise++;
    $class_colorise= ($colorise % 2)? 'colorise1' : 'colorise2';
    ?>
    <tr id="id_ins_<?php echo $inscription->id_contact_tmp; ?>_<?php echo $inscription->id_interface; ?>" class="<?php  echo  $class_colorise?>" style="width:100%;">
      <td>
      <?php // print_r($inscription->infos); ?>
        <a  href="#" id="nom_<?php echo $inscription->infos['nom']; ?>" style="display:block; width:100%;"> <?php echo $inscription->infos['nom']; ?>
        </a>
        <script type="text/javascript">
        Event.observe("nom_<?php echo $inscription->infos['nom']; ?>", "click",  function(evt){
            Event.stop(evt);
            //page.verify('affaires_affiche_fiche','annuaire_view_fiche.php?ref_contact=<?php //echo ($fiche->ref_contact)?>//','true','sub_content');
        }, false);
        </script>
      </td>
      <td  style="width:25%;">
        <a  href="#" id="profil_<?php echo $inscription->infos['profils_inscription']; ?>" style="display:block; width:100%;" title="<?php  //if ($fiche->text_adresse) { echo (($fiche->text_adresse));}?>">
        <?php echo $listelibprofils[$inscription->infos['profils_inscription']]; ?>&nbsp;
        </a>
        <script type="text/javascript">
        Event.observe("profil_<?php echo $inscription->infos['profils_inscription']; ?>", "click",  function(evt){
            Event.stop(evt);
            //page.verify('affaires_affiche_fiche','annuaire_view_fiche.php?ref_contact=<?php //echo ($fiche->ref_contact)?>//','true','sub_content');
        }, false);
        </script>
      </td>
      <td  style="width:25%;">
        <a  href="#" id="profil_<?php echo $inscription->infos['id_categorie']; ?>" style="display:block; width:100%;" title="<?php  //if ($fiche->text_adresse) { echo (($fiche->text_adresse));}?>">
        <?php echo $listelibannucat[$inscription->infos['id_categorie']]; ?>&nbsp;
        </a>
        <script type="text/javascript">
        Event.observe("profil_<?php echo $inscription->infos['id_categorie']; ?>", "click",  function(evt){
            Event.stop(evt);
            //page.verify('affaires_affiche_fiche','annuaire_view_fiche.php?ref_contact=<?php //echo ($fiche->ref_contact)?>//','true','sub_content');
       	}, false);
        </script>
      </td>
      <td style="width:20%; text-align:left">
        <a  href="#" id="more_<?php echo $inscription->id_contact_tmp; ?>_<?php echo $inscription->id_interface; ?>" style="display:block; width:100%;">
        + de détails
        </a>
        <script type="text/javascript">
        Event.observe("more_<?php echo $inscription->id_contact_tmp; ?>_<?php echo $inscription->id_interface; ?>", "click",  function(evt){Event.stop(evt); chargerInfValIns(<?php echo $inscription->id_contact_tmp; ?>, <?php echo $inscription->id_interface; ?>); $('popup_more_infos').style.display = "block"; });
        </script>
      </td>
      <td style="width:20%; text-align:left">
        <a  href="#" id="valider_<?php echo $inscription->id_contact_tmp; ?>" style="display:block; width:100%;">
        Valider
        </a>
        <script type="text/javascript">
        Event.observe("valider_<?php echo $inscription->id_contact_tmp; ?>", "click",  function(evt){Event.stop(evt);validInfValIns("<?php echo $inscription->id_contact_tmp; ?>", "<?php echo $inscription->id_interface; ?>", 1);}, false);
        </script>
      </td>
      <td style="width:20%; text-align:left">
        <a  href="#" id="refuser_<?php echo $inscription->id_contact_tmp; ?>" style="display:block; width:100%;">
        Refuser
        </a>
        <script type="text/javascript">
        Event.observe("refuser_<?php echo $inscription->id_contact_tmp; ?>", "click",  function(evt){Event.stop(evt);validInfValIns("<?php echo $inscription->id_contact_tmp; ?>", "<?php echo $inscription->id_interface; ?>", 0);}, false);
       
        </script>
      </td>
    </tr>
    <?php
  }}
  ?>


  <?php
  if (isset($modifs)) {
  $colorise=0;
  foreach ($listemodifications as $modification) {
    $colorise++;
    $class_colorise= ($colorise % 2)? 'colorise1' : 'colorise2';
    ?>
    <tr id="id_ins_<?php echo $modification->id_contact_tmp; ?>_<?php echo $modification->id_interface; ?>" class="<?php  echo  $class_colorise?>" style="width:100%;">
      <td>
      <?php // print_r($inscription->infos); ?>
        <a  href="#" id="nom_<?php echo $modification->infos['nom']; ?>" style="display:block; width:100%;"> <?php echo $modification->infos['nom']; ?>
        </a>
        <script type="text/javascript">
        Event.observe("nom_<?php echo $modification->infos['nom']; ?>", "click",  function(evt){Event.stop(evt);page.verify('affaires_affiche_fiche','annuaire_view_fiche.php?ref_contact=<?php //echo ($fiche->ref_contact)?>','true','sub_content');}, false);
        </script>
      </td>
      <td  style="width:25%;">

      </td>
      <td  style="width:25%;">

      </td>
      <td style="width:20%; text-align:left">

      </td>
      <td style="width:20%; text-align:left">
        <a  href="#" id="valider_<?php echo $modification->id_contact_tmp; ?>" style="display:block; width:100%;">
        Valider
        </a>
        <script type="text/javascript">
        Event.observe("valider_<?php echo $modification->id_contact_tmp; ?>", "click",  function(evt){Event.stop(evt);validInfValIns("<?php echo $modification->id_contact_tmp; ?>", "<?php echo $modification->id_interface; ?>", 2);}, false);
        </script>
      </td>
      <td style="width:20%; text-align:left">
        <a  href="#" id="refuser_<?php echo $modification->id_contact_tmp; ?>" style="display:block; width:100%;">
        Refuser
        </a>
        <script type="text/javascript">
        Event.observe("refuser_<?php echo $modification->id_contact_tmp; ?>", "click",  function(evt){Event.stop(evt);validInfValIns("<?php echo $modification->id_contact_tmp; ?>", "<?php echo $modification->id_interface; ?>", 0);}, false);
       
        </script>
      </td>
    </tr>
    <?php
  }}
  ?>
</table>

<!-- <div id="affresult">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="text-align:left;">Inscriptions en attentes :</td>
    <td id="nvbar"><?php //echo $barre_nav;?></td>
    <td style="text-align:right;"> <?php echo $debut+1?> &agrave; <?php echo $debut?> sur <?php echo count($listeinscriptions); ?></td>
  </tr>
</table></div> -->


</div>


<?php if (!isset($_REQUEST['val_mail'])) { ?>
</div>
</div>
</div>

<script type="text/javascript" language="javascript">

//Event.observe("order_nom", "click",  function(evt){Event.stop(evt);$('orderby_s').value='nom'; $('orderorder_s').value='<?php //if ($form['orderorder']=="ASC" && $form['orderby']=="nom") {echo "DESC";} else {echo "ASC";}?>'; page.annuaire_recherche_simple();}, false);
//centrage du mini_moteur de recherche d'un contact
centrage_element("popup_more_infos");
centrage_element("pop_up_mini_moteur");
centrage_element("pop_up_mini_moteur_iframe");

Event.observe(window, "resize", function(evt){
centrage_element("pop_up_mini_moteur_iframe");
centrage_element("pop_up_mini_moteur");
centrage_element("popup_more_infos");
});
//on masque le chargement
H_loading();

// ]]>
</script>
<?php } ?>
