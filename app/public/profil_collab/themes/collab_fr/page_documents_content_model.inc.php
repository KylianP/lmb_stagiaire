<?php
// *************************************************************************************************************
// CREATION D'UN NOUVEAU DOC ? PARTIR DES LIGNES D'ARTICLES D'UN ANCIEN
// *************************************************************************************************************

// Variables n?cessaires ? l'affichage
$page_variables = array ();
check_page_variables ($page_variables);



// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

$modeles_lignes = charge_docs_content_model ($id_type_doc);

?>

<div id="pop_up_content_model" class="lines_info_modeles_doc">

  <a href="#" id="link_close_pop_up_content_model" style="float:right">
  <img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/supprime.gif" border="0">
  </a>
<script type="text/javascript">
Event.observe("link_close_pop_up_content_model", "click",  function(evt){Event.stop(evt); $("pop_up_content_model").style.display = "none";}, false);
</script>
<div style="font-weight:bolder">Mod&egrave;les de contenu</div>

<div style="height: 330px;overflow: auto;">
<?php foreach($modeles_lignes as $modeles_ligne) {?>
  <table style="width:100%" class="roundedtable_over">
    <tr class="smallheight">
      <td style="width:2%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
      <td style="width:80%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
      <td style="width:15%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
      <td style="width:3%"><img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="100%" height="1" id="imgsizeform"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      <span class="labelled_text"><?php echo $modeles_ligne->lib_modele; ?></span><br />
      <span style=" font-style:italic"><?php echo $modeles_ligne->desc_modele; ?></span>
      </td>
      <td>
      
      </td>
      <td style="width:20px">
              <span class="common_link" id="add_content_model" >Utiliser ce mod&egrave;le</span>
              <script type="text/javascript">
      Event.observe("add_content_model", "click", function(evt){
    	      add_content_model($("ref_doc").value, '<?php echo $modeles_ligne->ref_doc; ?>');//add_new_line_info_modele ($("ref_doc").value, "information", '');
              $("pop_up_content_model").style.display = "none";
      },false);
      </script>
      </td>
    </tr>
  </table>
<?php }?>
</div>

<SCRIPT type="text/javascript">

//centrage de la pop up
centrage_element("pop_up_content_model");

Event.observe(window, "resize", function(evt){
centrage_element("pop_up_content_model");
});
//on masque le chargement
H_loading();
</SCRIPT>
</div>