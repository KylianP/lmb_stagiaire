<?php
// *************************************************************************************************************
// ACCUEIL DE L'UTILISATEUR ADMINISTRATEUR
// *************************************************************************************************************


require ("_dir.inc.php");
require ("_profil.inc.php");
require ("_session.inc.php");
require ($CONFIG_DIR."profil_".$_SESSION['profils'][$COLLAB_ID_PROFIL]->getCode_profil().".config.php");


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************


?>

<script type="text/javascript">

if ("createEvent" in document)
{
	debugger;
 var element = document.createElement("LMBPrintDataElement");
 element.setAttribute("url", window.location.protocol+"//"+window.location.host+window.location.pathname+"caisse_imprimer_doc.php?ref_doc=<?php echo "BLC-000000-00004";?>");

 //"http://lmb9/lmb9/interface_caisse//interface_caisse/caisse_imprimer_doc.php?ref_doc=BLC-000000-00004"
 element.setAttribute("printer_type", "ticket");
 document.documentElement.appendChild(element);
 
 var ev = document.createEvent("Events");
 ev.initEvent("LMBPrintRequest", true, false);
 element.dispatchEvent(ev);
}
</script>
