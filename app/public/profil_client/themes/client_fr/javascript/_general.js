

function start_commune(idcode, idcommune, cible, iframecible, targeturl) {
		
    var cp = $(idcode).value;
    if (cp.length >= 5) {
			
		var AppelAjax = new Ajax.Updater(
																	cible, 
																	targeturl+cp, 
																	{parameters: {ville: idcommune, choix_ville: cible, iframe_choix_ville: iframecible},
																	evalScripts:true, 
																	onComplete: function(requester) {
																					if (requester.responseText!="") {
																					$(cible).style.display="block";
																					$(iframecible).style.display="block";
																			
																					}
																					}
																	}
																	);
    
  	}	
}


function delay_close (cible,iframecible) {
$(cible).style.display="none";
$(iframecible).style.display="none";
}




//récupére la liste des civilités en fonction d'une catégorie
function start_civilite(idcat, idcivi, cible) {
  civiliteUpdater = new SelectUpdater(idcivi, cible);
  ancienCat = "";
  $(idcat).onchange = function() {
    var cat = $(idcat).value;
      if (cat != ancienCat) {
        civiliteUpdater.run(cat);
        ancienCat = cat;
      }
  }
}

/*-------------------------------------------------------*/
/** DOM event */
if (!window.Event) {
  Event = new Object();
}

Event.event = function(event) {
  // W3C ou alors IE
  return (event || window.event);
}

Event.target = function(event) {
  return (event) ? event.target : window.event.srcElement ;
}

Event.preventDefault = function(event) {
  var event = event || window.event;
  if (event.preventDefault) { // W3C
    event.preventDefault();
  }
  else { // IE
    event.returnValue = false;
  }
}

Event.stopPropagation = function(event) {
  var event = event || window.event;
  if (event.stopPropagation) {
    event.stopPropagation();
  }
  else {
    event.cancelBubble = true;
  }
}

/*-------------------------------------------------------*/
// Permettre new XMLHttpRequest() dans IE sous Windows
if (!window.XMLHttpRequest && window.ActiveXObject) {
  try {
    // Tester si les ActiveX sont autorises
    new ActiveXObject("Microsoft.XMLHTTP");
    // Definir le constructeur
    window.XMLHttpRequest = function() {
      var request;
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(exc) {
        request = new ActiveXObject('Msxml2.XMLHTTP');
      }
      return request;
    }
  }
  catch (exc) {}
}





function SelectUpdater(idSelect, getOptionsUrl) {	
  this.select = document.getElementById(idSelect);
  /** Url de la requête XMLHttpRequest mettant à jour @type String */
  this.url = getOptionsUrl;
  this.request = null;
}

SelectUpdater.prototype = {
	
  run: function(value) {
		
    if (this.request) {
      try {
        this.request.abort();
      }
      catch (exc) {}
    }
    try {
      this.request = new XMLHttpRequest();
      var url = this.url + encodeURIComponent(value);
      this.request.open("GET", url, true);
      this.show();
      var current = this;
      this.request.onreadystatechange = function() {
        try {
          if (current.request.readyState == 4) {
            if (current.request.status == 200) {
              current.onload();
            }
          }
        }
        catch (exc) {}
      }
      this.request.send("");
    }
    catch (exc) {
      //Log.debug(exc);
    }
  },
  
  /** Mettre à jour la liste à la réception de la réponse */
  onload: function() {
    this.select.innerHTML = "";
    this.hide();
    if (this.request.responseText.length != 0) {
      // Le resultat n'est pas vide
      var options = this.request.responseText.split(";");
      var item, option;
      for (var i=0 ; i<options.length ; i++) {
        item = options[i].split("="); // value = text
        option = document.createElement("option");
        option.setAttribute("value", item[0]);
        option.innerHTML = item[1];
        this.select.appendChild(option);
      }
    }
  },
  
  /** Montrer que l'appel est en cours */
  show: function() {

  },
  
  /** Effacer le message */
  hide: function() {

  },
  
  /** Effacer la liste et le message, et annuler l'appel éventuel */
  reset: function() {
    this.select.innerHTML = "";
    try {
      if (this.request) {
        this.request.abort();
      }
    }
    catch (exc) {
    //  Log.debug(exc);
    }
  }
}


function changeclassname (idcible, newclass) {
$(idcible).className=newclass;
}




function check_infos_contact() {

	var listes_alertes = "";

	var admin_alertes = "";

	var email = $("admin_emaila").value;

	var verif = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$/;

	//champs au format normal avant vérification

	changeclassname ("nom", "classinput_xsize");

	changeclassname ("adresse_adresse", "classinput_xsize");

	changeclassname ("adresse_code", "classinput_xsize");

	changeclassname ("admin_pseudo", "classinput_xsize");
	
	changeclassname ("adresse_ville", "classinput_xsize");

	changeclassname ("admin_emaila", "classinput_xsize");

	changeclassname ("admin_emailb", "classinput_xsize");

	changeclassname ("admin_passworda", "classinput_xsize");

	changeclassname ("admin_passwordb", "classinput_xsize");

	//verification que l'email n'est pas déjà utilisé
	
	if ($("admin_emaila")) {
		var AppelAjax = new Ajax.Request(
																		"_check_email_present.php", 
																		{parameters: {email: $("admin_emaila").value},
																		evalScripts:true, 
																		onComplete: function(requester) {
																			if (requester.responseText!="") {
																				admin_alertes += "Cette adresse email est déjà utilisée! \n";
																				changeclassname ("admin_emaila", "alerteform_xsize");
																			}

	if ($("nom").value == "" ) {listes_alertes += "nom, "; changeclassname ("nom", "alerteform_xsize");}

	if ($("adresse_adresse").value == "" ) {listes_alertes += "adresse, "; changeclassname ("adresse_adresse", "alerteform_xsize");}

	if ($("adresse_code").value == "" ) {listes_alertes += "code postal, "; changeclassname ("adresse_code", "alerteform_xsize");}

	if ($("adresse_ville").value == "" ) {listes_alertes += "ville, "; changeclassname ("adresse_ville", "alerteform_xsize");}

	

	if ($("admin_pseudo").value == "" ) {admin_alertes += "Veuillez indiquer un pseudonyme. \n"; changeclassname ("admin_pseudo", "alerteform_xsize");}

	

	if (($("admin_emaila").value == "" || $("admin_emailb").value == "" || verif.exec(email) == null) || $("admin_emaila").value != $("admin_emailb").value ) {

		admin_alertes += "Veuillez indiquez une adresse Email identique et valide. \n";

		changeclassname ("admin_emaila", "alerteform_xsize");

		changeclassname ("admin_emailb", "alerteform_xsize");

	}

	if (($("admin_passworda").value == "" || $("admin_passwordb").value == "") || $("admin_passwordb").value != $("admin_passworda").value ) {

		admin_alertes += "Veuillez indiquer un mot de passe identique. ";

		changeclassname ("admin_passworda", "alerteform_xsize");

		changeclassname ("admin_passwordb", "alerteform_xsize");

	}

	

	if (listes_alertes == "" && admin_alertes == "") {

		$("infos_contact").submit();

	}else {

		part_1 = "";

		part_2 = "";

		if (listes_alertes != "") {part_1 = "Veuillez indiquez le(s) "+listes_alertes+" de contact.";}

		if (admin_alertes != "") {part_2 = admin_alertes;}

		alert (part_1+"\n\n"+part_2);

	}

																		}
																		}
																		);
	}
	

}


//mise à jour du contact
function check_majinfos_contact() {

	var listes_alertes = "";

	var admin_alertes = "";

	var email = $("admin_emaila").value;

	var verif = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$/;

	//champs au format normal avant vérification

	changeclassname ("nom", "classinput_xsize");

	changeclassname ("adresse_adresse", "classinput_xsize");

	changeclassname ("adresse_code", "classinput_xsize");

	changeclassname ("admin_pseudo", "classinput_xsize");
	
	changeclassname ("adresse_ville", "classinput_xsize");

	changeclassname ("admin_emaila", "classinput_xsize");

	changeclassname ("admin_passworda", "classinput_xsize");

	changeclassname ("admin_passwordb", "classinput_xsize");

	//verification que l'email n'est pas déjà utilisé
	
	if ($("admin_emaila") && $("admin_emaila").value != $("admin_emailb").value) {
		var AppelAjax = new Ajax.Request(
																		"_check_email_present.php", 
																		{parameters: {email: $("admin_emaila").value},
																		evalScripts:true, 
																		onComplete: function(requester) {
																			if (requester.responseText!="") {
																				admin_alertes += "Cette adresse email est déjà utilisée! \n";
																				changeclassname ("admin_emaila", "alerteform_xsize");
																			}
																		}
																		}
																		);
	}

	if ($("nom").value == "" ) {listes_alertes += "nom, "; changeclassname ("nom", "alerteform_xsize");}

	if ($("adresse_adresse").value == "" ) {listes_alertes += "adresse, "; changeclassname ("adresse_adresse", "alerteform_xsize");}

	if ($("adresse_code").value == "" ) {listes_alertes += "code postal, "; changeclassname ("adresse_code", "alerteform_xsize");}

	if ($("adresse_ville").value == "" ) {listes_alertes += "ville, "; changeclassname ("adresse_ville", "alerteform_xsize");}

	

	if ($("admin_pseudo").value == "" ) {admin_alertes += "Veuillez indiquer un pseudonyme. \n"; changeclassname ("admin_pseudo", "alerteform_xsize");}

	

	if (($("admin_emaila").value == "" || verif.exec(email) == null) ) {

		admin_alertes += "Veuillez indiquez une adresse Email valide. \n";

		changeclassname ("admin_emaila", "alerteform_xsize");

		changeclassname ("admin_emailb", "alerteform_xsize");

	}
	if ($("admin_password").value != "") {
		if (($("admin_passworda").value == "" || $("admin_passwordb").value == "") || $("admin_passwordb").value != $("admin_passworda").value ) {
	
			admin_alertes += "Veuillez indiquer un nouveau mot de passe identique. ";
	
			changeclassname ("admin_passworda", "alerteform_xsize");
	
			changeclassname ("admin_passwordb", "alerteform_xsize");
	
		}
	}

	

	if (listes_alertes == "" && admin_alertes == "") {

		$("_user_infos_modifier").submit();

	}else {

		part_1 = "";

		part_2 = "";

		if (listes_alertes != "") {part_1 = "Veuillez indiquez le(s) "+listes_alertes+" de contact.";}

		if (admin_alertes != "") {part_2 = admin_alertes;}

		alert (part_1+"\n\n"+part_2);

	}

	

}
