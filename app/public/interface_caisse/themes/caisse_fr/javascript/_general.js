
//------------------------------------------------
//------------------------------------------------
// FONTIONS GENERALES
//------------------------------------------------
//------------------------------------------------

// observateur de changement d'un formulaire
function formChanged() {
	changed= true;
}

//envois de formulaire
function submitform (nom_form) {
document.forms[nom_form].submit();
}


//suppression d'une balise
function remove_tag(id_balise) {
		Element.remove($(id_balise));
}


//fonction de remplacement de string
function Remplace(expr,a,b) {
	var i=0
	while (i!=-1) {
		i=expr.indexOf(a,i);
		if (i>=0) {
			expr=expr.substring(0,i)+b+expr.substring(i+a.length);
			i+=b.length;
		}
	}
	return expr
}

//affiche la pop_up d'alerte
function show_pop_alerte () {
	$("alert_pop_up_tab").style.display = "block";
	$("framealert").style.display = "block";
	$("alert_pop_up").style.display = "block";
}
//masque la pop up d'alerte
function hide_pop_alerte () {
	$("alert_pop_up_tab").style.display = "none";
	$("framealert").style.display = "none";
	$("alert_pop_up").style.display = "none";
}

//switch deux elements

function switch_element(ref1,ref2) {
	var copie_ref1= $(ref1).cloneNode(true);
	var copie_ref2= $(ref2).cloneNode(true);
	var old_ref1= $(ref1);
	var old_ref2= $(ref2);

old_ref2.parentNode.replaceChild(copie_ref1,old_ref2);
old_ref1.parentNode.replaceChild(copie_ref2,old_ref1);
	
	}

//switch deux contenus d'elements
function switch_inner_element(ref1,ref2) {
	var copie_ref1= $(ref1).innerHTML;
	var copie_ref2= $(ref2).innerHTML;
	$(ref1).innerHTML=	copie_ref2;
	$(ref1).innerHTML.evalScripts();
	$(ref2).innerHTML=	copie_ref1;
	$(ref2).innerHTML.evalScripts();
	
	}



// protype de message d'alerte
function alerte_message(){

}
alerte_message.prototype = {
	//initialisation du syst�me d'affichage des alertes
	initialize : function() {
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
	},
	//alerte de changement sur un formulaire
	changedform : function() {
	
		$("titre_alert").innerHTML = tab_alerte["form_change"][0];
		$("texte_alert").innerHTML = tab_alerte["form_change"][1];
		$("bouton_alert").innerHTML = tab_alerte["form_change"][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		page.showcontent();
		}
	
	},
	//confirmation de base
	confirm_supprimer : function(donnee_aff, formtosend) {
	
		$("titre_alert").innerHTML = tab_alerte[donnee_aff][0];
		$("texte_alert").innerHTML = tab_alerte[donnee_aff][1];
		$("bouton_alert").innerHTML = tab_alerte[donnee_aff][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
		if ($("bouton1")) {
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		submitform (formtosend);
		}
		}
		
	
	},
	//confirm supression d'un profil dans un contact
	confirm_supprimer_profil : function(donnee_aff, formtosend, profil_check) {
	
		$("titre_alert").innerHTML = tab_alerte[donnee_aff][0];
		$("texte_alert").innerHTML = tab_alerte[donnee_aff][1];
		$("bouton_alert").innerHTML = tab_alerte[donnee_aff][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		check_profil (profil_check);
		}
		
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		submitform (formtosend);
		}
		
	
	},
	//confirm supression d'un profil dans un contact
	confirm_supprimer_art_categ_inv : function(donnee_aff, art_categ) {
	
		$("titre_alert").innerHTML = tab_alerte[donnee_aff][0];
		$("texte_alert").innerHTML = tab_alerte[donnee_aff][1];
		$("bouton_alert").innerHTML = tab_alerte[donnee_aff][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
		
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		supprime_art_categ (art_categ);
		}
		
	
	},
	//confirm supression d'une ligne de quantit� d'un tarif
	confirm_supprimer_tag: function(donnee_aff, id_tag_del) {
	
		$("titre_alert").innerHTML = tab_alerte[donnee_aff][0];
		$("texte_alert").innerHTML = tab_alerte[donnee_aff][1];
		$("bouton_alert").innerHTML = tab_alerte[donnee_aff][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
		
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		remove_tag (id_tag_del);
		}
		
	},
		
	//confirm supression d'une ligne de code barre par exemple
	confirm_supprimer_tag_and_callpage: function(donnee_aff, id_tag_del, page2call) {
	
		$("titre_alert").innerHTML = tab_alerte[donnee_aff][0];
		$("texte_alert").innerHTML = tab_alerte[donnee_aff][1];
		$("bouton_alert").innerHTML = tab_alerte[donnee_aff][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
		
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		remove_tag (id_tag_del);
		new Ajax.Request(
										page2call, 
										{
										evalScripts:true, 
										onLoading:S_loading, onException: function () {S_failure();},
										onSuccess: function (requester){
											requester.responseText.evalScripts();
											H_loading(); 
										}
										}
										);
		}
		
	},
		
	//confirm supression d'une ligne de code barre par exemple
	confirm_supprimer_formule: function(donnee_aff, page2call, param) {
	
		$("titre_alert").innerHTML = tab_alerte[donnee_aff][0];
		$("texte_alert").innerHTML = tab_alerte[donnee_aff][1];
		$("bouton_alert").innerHTML = tab_alerte[donnee_aff][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
		
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		
		new Ajax.Request(
										page2call, 
										{
										parameters: param,
										evalScripts:true, 
										onLoading:S_loading,
										onComplete: function (requester){
											requester.responseText.evalScripts();
											H_loading(); 
										}
										}
										);
		}
		
	},
	
	//confirm supression et appel d'une page par ajax.request
	confirm_supprimer_and_callpage: function(donnee_aff, page2call) {
	
		$("titre_alert").innerHTML = tab_alerte[donnee_aff][0];
		$("texte_alert").innerHTML = tab_alerte[donnee_aff][1];
		$("bouton_alert").innerHTML = tab_alerte[donnee_aff][2];
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
		
		$("bouton1").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		new Ajax.Request(
										page2call, 
										{
										evalScripts:true, 
										onLoading:S_loading, onException: function () {S_failure();},
										onSuccess: function (requester){
											requester.responseText.evalScripts();
											H_loading(); 
											}
										}
										);
		}
		
		
	
	},
		
	//alerte d'erreur de saisie avec texte d'erreur envoy� par la fonction (un seul bouton)
	alerte_erreur: function(alerte_titre, alerte_texte, alerte_bouton) {
	
		$("titre_alert").innerHTML = alerte_titre;
		$("texte_alert").innerHTML = alerte_texte;
		$("bouton_alert").innerHTML = alerte_bouton;
	
		$("alert_pop_up_tab").style.display = "block";
		$("framealert").style.display = "block";
		$("alert_pop_up").style.display = "block";
		
		$("bouton0").onclick= function () {
		$("framealert").style.display = "none";
		$("alert_pop_up").style.display = "none";
		$("alert_pop_up_tab").style.display = "none";
		}
	}
	
	
}


//
//observateur de l'historique
//
var hashListener = {
	ie:		/MSIE/.test(navigator.userAgent),
	ieSupportBack:	true,
	hash:	(document.location.hash.substr(1, document.location.hash.length)),
	check:	function () {
		var h = document.location.hash.substr(1, document.location.hash.length);
		if (h != this.hash && h !="") {
			this.hash = h;
			this.onHashChanged();
		}
	},
	init:	function () {
		var self = this;

		// IE
		if ("onpropertychange" in document && "attachEvent" in document) {
			document.attachEvent("onpropertychange", function () {
				if (event.propertyName == "location") {
					self.check();
				}
			});
		}
		// poll for changes of the hash
		window.setInterval(function () { self.check() }, 1000);
	},
	setHash: function (s) {
		// Mozilla always adds an entry to the history
		if (default_show_url.indexOf("documents_nouveau")!=0 && default_show_url.indexOf("documents_edition_generer")!=0) {
			if (this.ie && this.ieSupportBack &&  (default_show_id != "from_histo" && default_show_id != "to_histo")) {
				this.writeFrame(s);
			}
			if (document.location.hash.substr(1, document.location.hash.length) != s ) {
				document.location.hash = s;
			}
		}
	},
	getHash: function () {
		return document.location.hash.substr(1, document.location.hash.length);
	},
	writeFrame:	function (s) {
		var f = document.getElementById("historiqueFrame");
		var d = f.contentDocument || f.contentWindow.document;
		d.open();
		d.write("<script>window._hash = '" + s + "'; show = '" +default_show_url+ "'; window.onload = parent.hashListener.syncHash;<\/script>");
		d.close();
		//$("historiqueFrame").src = "history.php?identifiant="+default_show_id+"&targeturl=" + (s) + "&div_refresh=" + default_show_refresh + "&div_target=" + default_show_target; 
	},
	syncHash:	function () {
		var s = this._hash;
		if (s != document.location.hash) {
			document.location.hash = s;
		}
	},
	onHashChanged:	function () {
		if ((historique[1] == (document.location.hash.substr(1, document.location.hash.length))) && (default_show_id == "from_histo")) {
			historique.shift();
			page.traitecontent ("from_histo",(document.location.hash.substr(1, document.location.hash.length)), true , "sub_content")
		} else {
			if (default_show_url != (document.location.hash.substr(1, document.location.hash.length))) {
				page.traitecontent ("to_histo",(document.location.hash.substr(1, document.location.hash.length)), true , "sub_content");
			}
			historique.unshift((document.location.hash.substr(1, document.location.hash.length)));
		}
		}
};

//rafraichir le cache
function refresh_cache () {
	if (uncache) {
		uncache = false;
		window.name="main";
		var win=window.open('','main');
		win.location.reload(true);
	}
}
//
// fonction d'appel et d'affichage des contenu charg�s par ajax
//
function appelpage(div_cible) {
this.div_cible_proto = div_cible;
}

appelpage.prototype = {
	initialize : function() {
	},
	//verification qu'un message d'alerte ne dois pas �tre d�clench�
	verify : function(identifiant,targeturl,div_refresh,div_target) {
	this.identifiant_proto = identifiant;
	this.targeturl_proto = targeturl;
	this.div_refresh_proto = div_refresh;
	this.div_target_proto = div_target;
	
		if ((changed)&&((this.div_target_proto==this.div_cible_proto ))) {
			alerte.changedform();
		}
		else {
			this.showcontent();
		}
	},
	
	showcontent : function() {
	this.traitecontent(this.identifiant_proto,this.targeturl_proto,this.div_refresh_proto,this.div_target_proto);
	},
	//traitement de l'appel de page et gestion connexe
	traitecontent : function(identifiant,targeturl,div_refresh,div_target) {
		targeturl = targeturl;
		//alert(":)");
		//si le div_target est _blank ou _self ou _parent on ouvre la page
		if (div_target=="_blank" || div_target=="_self" || div_target=="_parent") {
			window.open(targeturl,div_target);
		}
		//on r�initialise les formulaires comme �tants vierges
		changed	=	false;
		
		//ouverture de page depuis un hash 
		if (div_target=="sub_content") {
		lehash = document.location.hash.substr(1, document.location.hash.length);
		if (lehash != "") {
			if (historique.length == 0) {
				targeturl = encodeURI(lehash);
				historique.unshift(targeturl);
				historique_request.unshift(new Array());
				document.location.hash = decodeURI(targeturl);
			}
		} 
		}
		default_show_id = identifiant;
		default_show_url = targeturl;
		default_show_refresh = div_refresh;
		default_show_target = div_target;
		if (targeturl != "") {
			//on v�rifi si le contenu dois �tre recharg� ou non
			if (div_refresh=="false") {
				//si on ne l'a pas en m�moire
				if (global_tab[identifiant] == undefined || global_tab[identifiant] == "") {
				default_show_id = identifiant;
				//on le charge
				var AppelAjax = new Ajax.Updater(
																			div_target,
																			targeturl, 
																			{
																			evalScripts:true, 
																			onLoading:S_loading, 
																			onException: function () {S_failure();},
																			on404: function () {
																				page.traitecontent("_404","__404.php",true,div_target);
																			},
																			onComplete:function (originalRequest) {
																				if (div_target=="sub_content") {
																					hashListener.setHash (encodeURI(targeturl));
																				}
																				//alert(originalRequest.responseText);
																				global_tab[default_show_id]= originalRequest.responseText;
																				H_loading();
																			}
																			}
																			);
																			//overrideMimeType: 'text/html; charset=ISO-8859-15',
																			//encoding: 'iso-8859-15',
																			//requestHeaders: ["Content-type", "iso-8859-15"],
				}
				else {	
				//sinon on le r�cup�re et on eval les sripts contenus
				if (div_target=="sub_content") {
					hashListener.setHash (encodeURI(targeturl));
				}
				$(div_target).innerHTML=global_tab[identifiant];
				global_tab[identifiant].evalScripts();
				}
			}
			else {
			//sinon on le recharge
			var AppelAjax = new Ajax.Updater(
																			div_target, 
																			targeturl, 
																			{
																			evalScripts:true, 
																			onLoading:S_loading, 
																			onException: function () {S_failure();},
																			on404: function () {
																				page.traitecontent("_404","__404.php",true,div_target);
																			},
																			onComplete:function () {
																				H_loading();
																				if (div_target=="sub_content") {
																					hashListener.setHash (encodeURI(targeturl));
																				}
																			}
																			}
																			);
			}
		}
		
		
		
	},
	
	//appel les r�ponses pour le moteur simple recherche contact
	annuaire_recherche_courriers : function() {
//		historique_request[0] = new Array(historique[0]);
//		historique_request[0][1] = "simple";
//		historique_request[0]["page_to_show_s"] =$F('page_to_show_s'); 
//		historique_request[0]["orderby_s"] 		=$F('orderby_s'); 
//		historique_request[0]["orderorder_s"] 	=$F('orderorder_s'); 
		parent.page.traitecontent ("annuaire_recherche_courriers","annuaire_view_courriers.php?ref_contact="+$F('ref_contact')+"&page_to_show="+$F('page_to_show_s')+"&orderby="+$F('orderby_s')+"&orderorder="+$F('orderorder_s'), true , "contactview_courrier");
	},
	//appel les r�ponses pour le moteur avanc� recherche contact
	annuaire_recherche_avancee : function() {
		historique_request[0] = new Array(historique[0]);
		historique_request[0][1] = "avancee";
		historique_request[0]["nom"] 							=$F('nom'); 
		historique_request[0]["id_categorie"]			=$F('id_categorie'); 
		historique_request[0]["id_profil"] 				=$F('id_profil'); 
		historique_request[0]["id_client_categ"] 	=$F('id_client_categ'); 
		historique_request[0]["type_client"] 			=$F('type_client'); 
		historique_request[0]["page_to_show"] 		=$F('page_to_show'); 
		historique_request[0]["tel"] 							=$F('tel'); 
		historique_request[0]["email"] 						=$F('email'); 
		historique_request[0]["url"]							=$F('url'); 
		historique_request[0]["code_postal"] 			=$F('code_postal'); 
		historique_request[0]["ville"] 						=$F('ville'); 
		historique_request[0]["orderby"] 					=$F('orderby'); 
		historique_request[0]["orderorder"] 			=$F('orderorder'); 
		historique_request[0]["archive"] 			=$F('archive'); 
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"annuaire_recherche_avancee_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', nom : escape($F('nom')), id_categorie: $F('id_categorie'), id_profil: $F('id_profil'), id_client_categ: $F('id_client_categ'), type_client: $F('type_client'), page_to_show: $F('page_to_show'), tel: escape($F('tel')), email: escape($F('email')), url: escape($F('url')), code_postal: escape($F('code_postal')), ville: escape($F('ville')), orderby: $F('orderby'), orderorder: $F('orderorder')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
									
	},
	//appel les r�ponses pour le mini moteur recherche contact
	annuaire_recherche_mini : function() {
		var AppelAjax = new Ajax.Updater(
									"resultat_contact_mini", 
									"annuaire_recherche_mini_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', nom : escape($F('nom_m')), id_profil: $F('id_profil_m'), page_to_show: $F('page_to_show_m'), orderby: $F('orderby_m'), orderorder: $F('orderorder_m'), fonction_retour: $F('fonction_retour_m'), param_retour: $F('param_retour_m')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur simple recherche services abo
	article_recherche_abo : function() {
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"catalogue_articles_service_abo_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', page_to_show: $('page_to_show_s').value , orderby: $('orderby_s').value , orderorder: $('orderorder_s').value ,
										ref_article: $('ref_article').options[$("ref_article").selectedIndex].value , ref_client: $('ref_client').value,
										id_client_categ: $('id_client_categ').options[$("id_client_categ").selectedIndex].value,
										etat_abo: $('etat_abo').options[$("etat_abo").selectedIndex].value, date_souscription_min : $('date_souscription_min').value,
										date_souscription_max : $('date_souscription_max').value, date_echeance_min : $('date_echeance_min').value, date_echeance_max : $('date_echeance_max').value,
										date_fin_min : $('date_fin_min').value, date_fin_max : $('date_fin_max').value, adresse_code : $('adresse_code').value, adresse_ville : $('adresse_ville').value,
										adresse_pays : $('adresse_pays').value},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour export csv recherche services abo
	article_recherche_abo_export_csv : function() {
		window.open("catalogue_articles_service_abo_recherche_export_csv.php?recherche=1&nom="+escape($F('nom_s'))+"&id_profil="+$F('id_profil_s')+"&page_to_show="+$F('page_to_show_s')+"&orderby="+$F('orderby_s')+"&orderorder="+$F('orderorder_s')+"&ref_article="+$F('ref_article')+"&id_client_categ="+$F('id_client_categ')+"&type_client="+$F('type_client')+"&type_recherche="+$F('type_recherche')+"&id_categorie="+$F('id_categorie')+"&code_postal="+$F('code_postal'),"_blank")
	
	},
	//appel les r�ponses pour le moteur simple recherche services conso
	article_recherche_conso : function() {
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"catalogue_articles_service_conso_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', nom : escape($F('nom_s')), id_profil: $F('id_profil_s'), page_to_show: $F('page_to_show_s'), orderby: $F('orderby_s'), orderorder: $F('orderorder_s'), ref_article: $F('ref_article'), id_client_categ: $F('id_client_categ'), type_client: $F('type_client'), type_recherche: $F('type_recherche'), id_categorie: $F('id_categorie'), code_postal: $F('code_postal')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur simple recherche articles
	catalogue_recherche_simple : function() {
		var f_stock= "0";
		var f_nouv= "0";
		var f_promo= "0";
		if ($F("in_stock_s")=="1") { f_stock="1";}
		if ($F("is_nouveau_s")=="1") { f_nouv="1";}
		if ($F("in_promotion_s")=="1") { f_promo="1";}
		historique_request[1] = new Array(historique[0]);
		historique_request[1][1] = "simple";
		historique_request[1]["ref_art_categ_s"] 		=$F('ref_art_categ_s');
		historique_request[1]["ref_constructeur_s"] =$F('ref_constructeur_s');
		//historique_request[1]["lib_art_categ_s"] 		=$('lib_art_categ_s').innerHTML;
		historique_request[1]["lib_article_s"] 			=$F('lib_article_s');
		historique_request[1]["in_stock_s"] 				=f_stock;
		historique_request[1]["is_nouveau_s"] 			=f_nouv;
		historique_request[1]["in_promotion_s"] 		=f_promo;
		historique_request[1]["page_to_show_s"] 		=$F('page_to_show_s');  
		historique_request[1]["orderby_s"] 					=$F('orderby_s'); 
		historique_request[1]["orderorder_s"] 			=$F('orderorder_s'); 
		historique_request[1]["id_tarif_s"] 				=$F('id_tarif_s'); 
		historique_request[1]["app_tarifs_s"] 			=$F('app_tarifs_s'); 
		historique_request[1]["id_stock_s"] 				=$F('id_stock_s'); 
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"catalogue_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_art_categ : $F('ref_art_categ_s'), lib_article: escape($F('lib_article_s')), page_to_show: $F('page_to_show_s'), ref_constructeur: $F('ref_constructeur_s'), in_stock: f_stock , is_nouveau: f_nouv , in_promotion: f_promo, orderby: $F('orderby_s'), orderorder: $F('orderorder_s'), id_tarif: $F('id_tarif_s'), id_stock: $F('id_stock_s'), app_tarifs_s: $F('app_tarifs_s')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur avanc� recherche articles
	catalogue_recherche_avancee : function() { 
	
	historique_request[1] = new Array(historique[0]);
	historique_request[1][1] = "avancee";
	//historique_request[1]["lib_art_categ_a"] =$('lib_art_categ_a').innerHTML;
	
	serie_recherche=  ($('form_recherche_a').serialize(true));
	for (key in serie_recherche) {
		historique_request[1][key] = serie_recherche[key];
		serie_recherche[key] = escape(serie_recherche[key]);
	}
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"catalogue_recherche_avancee_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: serie_recherche,
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le mini moteur recherche articles
	 catalogue_recherche_mini_simple : function() {		
		var f_stock= "0";
		var f_nouv= "0";
		var f_promo= "0";
		var AppelAjax = new Ajax.Updater(
									"resultat_cata", 
									" catalogue_recherche_mini_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_art_categ : $F('ref_art_categ_cata_m'), lib_article: escape($F('lib_article_cata_m')), page_to_show: $F('page_to_show_cata_m'), ref_constructeur: $F('ref_constructeur_cata_m'),  in_stock: f_stock , is_nouveau: f_nouv , in_promotion: f_promo, id_tarif: "", id_stock: $F('id_stock_cata_m'), orderby: $F('orderby_cata_m'), orderorder: $F('orderorder_cata_m'), fonction_retour: $F('fonction_retour_cata_m'), param_retour: $F('param_retour_cata_m')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour les articles n'ayant pas de PA d�finis
	catalogue_recherche_non_pa : function() {
		var f_pa_zero= "0";
		if ($F("in_pa_zero_s")=="1") { f_pa_zero="1";}
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"compta_pa_non_defini_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_art_categ : $F('ref_art_categ_s'), lib_article: escape($F('lib_article_s')), page_to_show: $F('page_to_show_s'), ref_constructeur: $F('ref_constructeur_s'), in_pa_zero: f_pa_zero ,  orderby: $F('orderby_s'), orderorder: $F('orderorder_s'), id_tarif: $F('id_tarif_s'), id_stock: $F('id_stock_s'), app_tarifs_s: $F('app_tarifs_s')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur de recherche de documents
	documents_recherche_simple : function() {
		
		historique_request[2] = new Array(historique[0]);
		historique_request[2][1] = "simple";
		historique_request[2]["ref_contact_s"] =$F('ref_contact_s');
		historique_request[2]["ref_contact_nom_s"] =$('ref_contact_nom_s').innerHTML;
		historique_request[2]["id_type_doc_s"] =$F('id_type_doc_s');
		historique_request[2]["id_etat_doc_s"] =$F('id_etat_doc_s');
		historique_request[2]["ref_doc_s"] 		=$F('ref_doc_s');
		historique_request[2]["page_to_show_s"] =$F('page_to_show_s');  
		historique_request[2]["orderby_s"] 			=$F('orderby_s'); 
		historique_request[2]["orderorder_s"] 	=$F('orderorder_s'); 
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"documents_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_contact : $F('ref_contact_s'), id_type_doc: $F('id_type_doc_s'), page_to_show: $F('page_to_show_s'), id_etat_doc: $F('id_etat_doc_s'), ref_doc: $F('ref_doc_s'), orderby: $F('orderby_s'), orderorder: $F('orderorder_s')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur de recherche de commandes clients en cours
	documents_recherche_cmde : function() {
		
		var f_cmdecours = "0";
		var f_cmderec = "0";
		var f_cmderetard = "0";
		var f_cmdeavalid = "0";
		var f_cmdeaprep = "0";
		if ($F("cmdecours_c")=="cmdecours_c") { f_cmdecours="1";}
		if ($F("cmderec_c")=="cmderec_c") { f_cmderec="1";}
		if ($F("cmderetard_c")=="cmderetard_c") { f_cmderetard="1";}
		if ($F("cmdeavalid_c")=="cmdeavalid_c") { f_cmdeavalid="1";}
		if ($F("cmdeaprep_c")=="cmdeaprep_c") { f_cmdeaprep="1";}
		historique_request[6] = new Array(historique[0]);
		historique_request[6][1] = "cmde";
		historique_request[6]["ref_client_c"] =$F('ref_client_c');
		historique_request[6]["ref_client_nom_c"] =$('ref_client_nom_c').innerHTML;
		historique_request[6]["id_name_mag_c"] =$F('id_name_mag_c');
		historique_request[6]["id_name_stock_c"] =$F('id_name_stock_c');
		historique_request[6]["id_name_categ_art_c"] =$F('id_name_categ_art_c');
		historique_request[6]["ref_constructeur_c"] =$F('ref_constructeur_c');
		historique_request[6]["ref_constructeur_nom_c"] =$('ref_constructeur_nom_c').innerHTML;
		historique_request[6]["ref_fournisseur_c"] =$F('ref_fournisseur_c');
		historique_request[6]["ref_fournisseur_nom_c"] =$('ref_fournisseur_nom_c').innerHTML;
		historique_request[6]["cmdecours_c"] = f_cmdecours;
		historique_request[6]["cmderec_c"] = f_cmderec;
		historique_request[6]["cmderetard_c"] = f_cmderetard;
		historique_request[6]["cmdeavalid_c"] = f_cmdeavalid;
		historique_request[6]["cmdeaprep_c"] = f_cmdeaprep;
		historique_request[6]["id_type_doc_c"] =$F('id_type_doc_c');
		historique_request[6]["page_to_show_c"] =$F('page_to_show_c');  
		historique_request[6]["orderby_c"] 			=$F('orderby_c'); 
		historique_request[6]["orderorder_c"] 	=$F('orderorder_c');
		historique_request[6]["app_tarifs_c"] =$F('app_tarifs_c'); 
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"documents_cmde_cli_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_client : $F('ref_client_c'), cmdecours : f_cmdecours, cmderec : f_cmderec, cmderetard : f_cmderetard, cmdeavalid : f_cmdeavalid, cmdeaprep : f_cmdeaprep,  id_type_doc : $F('id_type_doc_c'), id_name_mag: $F('id_name_mag_c'), id_name_stock: $F('id_name_stock_c'), id_name_categ_art: $F('id_name_categ_art_c'), ref_constructeur: $F('ref_constructeur_c'), ref_fournisseur:$F('ref_fournisseur_c'), page_to_show: $F('page_to_show_c'), orderby: $F('orderby_c'), orderorder: $F('orderorder_c'), app_tarifs_c: $F('app_tarifs_c')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur de recherche de commandes fournisseur en cours
	documents_recherche_cmde_fr : function() {
		
		var f_cmdecours = "0";
		var f_cmderec = "0";
		var f_cmderetard = "0";
		if ($F("cmdecours_c")=="cmdecours_c") { f_cmdecours="1";}
		if ($F("cmderec_c")=="cmderec_c") { f_cmderec="1";}
		if ($F("cmderetard_c")=="cmderetard_c") { f_cmderetard="1";}
		historique_request[7] = new Array(historique[0]);
		historique_request[7][1] = "cmde_fr";
		historique_request[7]["id_name_stock_c"] =$F('id_name_stock_c');
		historique_request[7]["id_name_categ_art_c"] =$F('id_name_categ_art_c');
		historique_request[7]["ref_constructeur_c"] =$F('ref_constructeur_c');
		historique_request[7]["ref_constructeur_nom_c"] =$('ref_constructeur_nom_c').innerHTML;
		historique_request[7]["ref_fournisseur_c"] =$F('ref_fournisseur_c');
		historique_request[7]["ref_fournisseur_nom_c"] =$('ref_fournisseur_nom_c').innerHTML;
		historique_request[7]["cmdecours_c"] = f_cmdecours;
		historique_request[7]["cmderec_c"] = f_cmderec;
		historique_request[7]["cmderetard_c"] = f_cmderetard;
		historique_request[7]["id_type_doc_c"] =$F('id_type_doc_c');
		historique_request[7]["page_to_show_c"] =$F('page_to_show_c');  
		historique_request[7]["orderby_c"] 			=$F('orderby_c'); 
		historique_request[7]["orderorder_c"] 	=$F('orderorder_c'); 
		historique_request[7]["app_tarifs_c"] =$F('app_tarifs_c'); 
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"documents_cmde_four_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', cmdecours : f_cmdecours, cmderec : f_cmderec, cmderetard : f_cmderetard, id_type_doc : $F('id_type_doc_c'), id_name_stock: $F('id_name_stock_c'), id_name_categ_art: $F('id_name_categ_art_c'), ref_constructeur: $F('ref_constructeur_c'), ref_fournisseur:$F('ref_fournisseur_c'), page_to_show: $F('page_to_show_c'), orderby: $F('orderby_c'), orderorder: $F('orderorder_c'), app_tarifs_c: $F('app_tarifs_c')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	
	//appel les r�ponses pour le moteur de recherche de devis clients en cours
	documents_recherche_dev : function() {
		
		var f_devcours = "0";
		var f_devaredig = "0";
		var f_devrec = "0";
		var f_devperim = "0";
		if ($F("devcours")=="devcours") { f_devcours="1";}
		if ($F("devaredig")=="devaredig") { f_devaredig="1";}
		if ($F("devrec")=="devrec") { f_devrec="1";}
		if ($F("devperim")=="devperim") { f_devperim="1";}
		historique_request[8] = new Array(historique[0]);
		historique_request[8][1] = "dev";
		historique_request[8]["ref_client"] =$F('ref_client');
		historique_request[8]["ref_client_nom"] =$('ref_client_nom').innerHTML;
		historique_request[8]["ref_constructeur"] =$F('ref_constructeur');
		historique_request[8]["ref_constructeur_nom"] =$('ref_constructeur_nom').innerHTML;
		historique_request[8]["ref_fournisseur"] =$F('ref_fournisseur');
		historique_request[8]["ref_fournisseur_nom"] =$('ref_fournisseur_nom').innerHTML;
		historique_request[8]["ref_commercial"] =$F('ref_commercial');
		historique_request[8]["ref_commercial_nom"] =$('ref_commercial_nom').innerHTML;
		historique_request[8]["id_name_mag"] =$F('id_name_mag');
		historique_request[8]["id_name_categ_art"] =$F('id_name_categ_art');
		historique_request[8]["devcours"] = f_devcours;
		historique_request[8]["devaredig"] = f_devaredig;
		historique_request[8]["devrec"] = f_devrec;
		historique_request[8]["devperim"] = f_devperim;
		historique_request[8]["id_type_doc"] =$F('id_type_doc');
		historique_request[8]["page_to_show"] =$F('page_to_show');  
		historique_request[8]["orderby"] 			=$F('orderby'); 
		historique_request[8]["orderorder"] 	=$F('orderorder');
		historique_request[8]["app_tarifs"] =$F('app_tarifs'); 
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"documents_dev_cli_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_client : $F('ref_client'),ref_constructeur: $F('ref_constructeur'), ref_fournisseur:$F('ref_fournisseur'), ref_commercial:$F('ref_commercial'), devcours : f_devcours, devaredig : f_devaredig, devrec : f_devrec, devperim : f_devperim, id_type_doc : $F('id_type_doc'), id_name_mag: $F('id_name_mag'), id_name_categ_art: $F('id_name_categ_art'),  page_to_show: $F('page_to_show'), orderby: $F('orderby'), orderorder: $F('orderorder'), app_tarifs: $F('app_tarifs')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	
	//appel les r�ponses pour le moteur de recherche avanc� de documents
	documents_recherche_avancee : function() {
		
	historique_request[2] = new Array(historique[0]);
	historique_request[2][1] = "avancee";
	
	serie_recherche=  ($('form_recherche_a').serialize(true));
	for (key in serie_recherche) {
		historique_request[2][key] = serie_recherche[key];
		serie_recherche[key] = escape(serie_recherche[key]);
	}
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"documents_recherche_contenu.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: serie_recherche,
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le mini moteur de recherche de documents
	documents_recherche_mini : function() {

		var AppelAjax = new Ajax.Updater(
									"resultat_documents_mini", 
									"documents_recherche_mini_result.php", 
									{
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_contact : $F('ref_contact_doc_m'), id_type_doc: $F('id_type_doc_doc_m'), page_to_show: $F('page_to_show_m'), id_etat_doc: $F('id_etat_doc_doc_m'), orderby: $F('orderby_doc_m'), orderorder: $F('orderorder_doc_m'), fonction_retour: $F('fonction_retour_doc_m'), param_retour: $F('param_retour_doc_m')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading
									}
									);
	},
	//appel les r�ponses pour le moteur d'etat des stocks
	stock_etat_recherche_simple : function() {
		var f_aff_pa_s= "0";
		var id_stock_s = "";
		
		if ($F("aff_pa_s")=="1") { f_aff_pa_s="1";}
		
		id_stock_s = "";
		
		if ($F('id_stock_l').length >0) {
			id_stock_s = $F('id_stock_l').join(",");
		}
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"stocks_etat_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_art_categ : $F('ref_art_categ_s'), page_to_show: $F('page_to_show_s'), ref_constructeur: $F('ref_constructeur_s'), aff_pa: f_aff_pa_s, orderby: $F('orderby_s'), orderorder: $F('orderorder_s'), id_stock: id_stock_s, in_stock: $F("in_stock_s")},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur des minimum des stocks
	stock_minimum_recherche_simple : function() {
		var f_aff_pa_s= "0";
		if ($F("aff_pa_s")=="1") { f_aff_pa_s="1";}
		historique_request[5] = new Array(historique[0]);
		historique_request[5][1] = "simple";
		historique_request[5]["ref_art_categ_s"] 		=$F('ref_art_categ_s');
		//historique_request[5]["lib_art_categ_s"] 		=$('lib_art_categ_s').innerHTML;
		historique_request[5]["ref_constructeur_s"] =$F('ref_constructeur_s');
		historique_request[5]["aff_pa_s"] 					=f_aff_pa_s;
		historique_request[5]["page_to_show_s"] 		=$F('page_to_show_s');  
		historique_request[5]["orderby_s"] 					=$F('orderby_s'); 
		historique_request[5]["orderorder_s"] 			=$F('orderorder_s');
		historique_request[5]["id_stock_s"] 				=$F('id_stock_l'); 
		id_stock_s = "";
		if ($F('id_stock_l').length >0) {
			id_stock_s = $F('id_stock_l').join(",");
		}
		
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"stocks_minimum_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_art_categ : $F('ref_art_categ_s'), page_to_show: $F('page_to_show_s'), ref_constructeur: $F('ref_constructeur_s'), aff_pa: f_aff_pa_s, orderby: $F('orderby_s'), orderorder: $F('orderorder_s'), id_stock: id_stock_s},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur d'etat des stocks
	stock_mouvements_result : function(id_stock) {
		
		var AppelAjax = new Ajax.Updater(
									"stock_moves_liste", 
									"stocks_moves.php", 
									{
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', page_to_show: $("page_to_show_s").value , id_stock: id_stock, date_debut: $("date_debut").value, date_fin: $("date_fin").value, ref_art_categ: $("ref_art_categ_s").value, ref_constructeur: $("ref_constructeur_s").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading
									}
									);
	},
	//appel les r�ponses pour le moteur des documents des stocks
	stock_docs_result : function(id_stock) {
		
		var AppelAjax = new Ajax.Updater(
									"stock_docs_liste", 
									"stocks_docs_result.php", 
									{
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', page_to_show: $("page_to_show_s").value , id_stock: $("id_stock_l").value, date_debut: $("date_debut").value, date_fin: $("date_fin").value, id_type_doc: $("id_type_doc_s").value, id_etat_doc: $("id_etat_doc_s").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading
									}
									);
	},
	//appel les r�ponses pour le moteur d'etat des stocks
	article_stock_mouvements_result : function(id_stock) {
		var ref_article= $("ref_article_s").value;
		var AppelAjax = new Ajax.Updater(
									"stock_moves_liste", 
									"catalogue_articles_stocks_moves.php", 
									{
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_article: ref_article , page_to_show: $("page_to_show_s").value , id_stock: id_stock, date_debut: $("date_debut").value, date_fin: $("date_fin").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading
									}
									);
	},
	//appel les r�ponses pour le moteur d'etat des stocks
	grand_livre_result : function(ref_contact) {
		var AppelAjax = new Ajax.Updater(
									"grand_livre_liste", 
									"compta_extrait_compte_contact_result.php", 
									{
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', ref_contact: ref_contact , page_to_show: $("page_to_show_s").value , exercice: $("exercice_choix").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading
									}
									);
	},
	//appel les r�ponses pour le moteur simple recherche utilisateur
	utilisateur_recherche_simple : function() {
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"utilisateur_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', nom : escape($F('nom_s')), id_profil: $F('id_profil_s'), page_to_show: $F('page_to_show_s'), orderby: $F('orderby_s'), orderorder: $F('orderorder_s') , date_debut: $("date_debut").value, date_fin: $("date_fin").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function (){S_failure();}, 
									onComplete:H_loading}
									);
	},
	//envois des infos pour la cr�ation d'un document inventaire
	documents_inventaire : function() {
	
	serie_recherche=  ($('creer_document_inventaire').serialize(true));
	for (key in serie_recherche) {
		serie_recherche[key] = escape(serie_recherche[key]);
	}
	//alert (serie_recherche);
		
		var AppelAjax = new Ajax.Updater(
									"sub_content", 
									"documents_inventaire_define_art_categ.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: serie_recherche,
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//Affichage des factures non r�gl�es par pagination
	fact_topay_result : function() {
		var AppelAjax = new Ajax.Updater(
									"fac_liste_content", 
									"compta_factures_client_nonreglees_liste.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_client_categ : $F('id_client_categ'), id_niveau_relance: $F('id_niveau_relance'), page_to_show: $F('page_to_show'), orderby: $F('orderby'), orderorder: $F('orderorder')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//Affichage des factures non r�gl�es par pagination
	fact_fourn_topay_result : function() {
		var AppelAjax = new Ajax.Updater(
									"fac_liste_content", 
									"compta_factures_fournisseur_nonreglees_liste.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_fournisseur_categ : $F('id_fournisseur_categ'), page_to_show: $F('page_to_show'), orderby: $F('orderby'), orderorder: $F('orderorder')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses les op�rations d'un compte bancaire
	compte_bancaire_moves : function() {
		var AppelAjax = new Ajax.Updater(
									"liste_operations", 
									"compta_compte_bancaire_operations_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_compte_bancaire: $F('id_compte_bancaire'), page_to_show: $F('page_to_show'), date_fin: $("date_fin").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function (){S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses les rapprochement d'un compte bancaire
	compte_bancaire_rapprochement : function() {
		var arapp= "0";
		
		if ($("arapp").checked) { arapp="1";}
		
		var AppelAjax = new Ajax.Updater(
									"liste_rapprochement", 
									"compta_compte_bancaire_rapprochement_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_compte_bancaire: $F('id_compte_bancaire'), page_to_show: $F('page_to_show'), date_fin: $("date_fin").value, arapp: arapp, montants: $("montants").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function (){S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses les rapprochement d'un compte bancaire
	compta_compte_bancaire_rapprochement_journal_result : function() {
		var AppelAjax = new Ajax.Updater(
									"compta_compte_bancaire_rapprochement_journal_result_content", 
									"compta_compte_bancaire_rapprochement_journal_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_compte_bancaire: $F('rap_id_compte_bancaire'), page_to_show: $F('page_to_show_rap'), date_debut: $("rap_date_debut").value, date_fin: $("rap_date_fin").value, id_operation_type: $("rap_id_operation_type").value, id_compte_bancaire_move: $("rap_id_compte_bancaire_move").value, id_journal: $("rap_id_compte_journal").value, date_move: $("rap_date_move").value, montant: $("rap_montant").value, delta_montant: $("rap_delta_montant").value},
									evalScripts:true, 
									onLoading:S_loading, onException: function (){S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses sur la recherche d'un compte bancaire
	compte_bancaire_recherche : function() {
		var AppelAjax = new Ajax.Updater(
									"liste_operations", 
									"compta_compte_bancaire_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_compte_bancaire: $F('id_compte_bancaire'), page_to_show: $F('page_to_show'), date_fin: $("date_fin").value, date_debut: $("date_debut").value, libelle: escape($("libelle").value), montant: $("montant").value, delta_montant: $("delta_montant").value, ope_type: $("ope_type").value, orderby: $F('orderby'), orderorder: $F('orderorder')},
									evalScripts:true, 
									onLoading:S_loading, onException: function (){S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses sur la recherche d'un cheque remis�
	compte_bancaire_recherche_chq : function() {
		var AppelAjax = new Ajax.Updater(
									"liste_chq", 
									"compta_compte_bancaire_recherche_chq_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_compte_bancaire: $F('id_compte_bancaire'), page_to_show: $F('page_to_show'), date_fin: $("date_fin").value, date_debut: $("date_debut").value, nom_porteur: escape($("nom_porteur").value), montant: $("montant").value, delta_montant: $("delta_montant").value, banque: $("banque").value, num_cheque: $("num_cheque").value, orderby: $F('orderby'), orderorder: $F('orderorder')},
									evalScripts:true, 
									onLoading:S_loading, onException: function (){S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur recherche compte comptable clients
	compta_client_comptes_plan : function() {
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"compta_client_comptes_plan_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', nom : escape($F('nom')), id_categorie: $F('id_categorie'), id_profil: $F('id_profil'), id_client_categ: $F('id_client_categ'), type_client: $F('type_client'), page_to_show: $F('page_to_show'), orderby: $F('orderby'), orderorder: $F('orderorder')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
									
	},
	//appel les r�ponses pour le moteur recherche compte comptable fournisseurs
	compta_fournisseur_comptes_plan : function() {
		var AppelAjax = new Ajax.Updater(
									"resultat", 
									"compta_fournisseur_comptes_plan_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', nom : escape($F('nom')), id_categorie: $F('id_categorie'), id_profil: $F('id_profil'), id_fournisseur_categ: $F('id_fournisseur_categ'), page_to_show: $F('page_to_show'), orderby: $F('orderby'), orderorder: $F('orderorder')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
									
	},
	//appel les r�ponses pour le moteur simple recherche evenements
	evenements_recherche : function() {
		
		var AppelAjax = new Ajax.Updater(
									"resultat_evenements", 
									"planning_evenements_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_comm_event_type: escape($F('id_comm_event_type')), page_to_show: $F('page_to_show_s'), orderby: $F('orderby_s'), orderorder: $F('orderorder_s')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	},
	//appel les r�ponses pour le moteur simple recherche evenements en rappel
	evenements_rappels_recherche : function() {
		
		var AppelAjax = new Ajax.Updater(
									"resultat_evenements_rappels", 
									"planning_evenements_rappels_recherche_result.php", {
									method: 'post',
									asynchronous: true,
									contentType:  'application/x-www-form-urlencoded',
									encoding:     'UTF-8',
									parameters: { recherche: '1', id_comm_event_type: escape($F('id_comm_event_type')), page_to_show: $F('page_to_show_s'), orderby: $F('orderby_s'), orderorder: $F('orderorder_s')},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();}, 
									onComplete:H_loading}
									);
	}

}

//Enregistrement des donn�es non rafraichies dans un tableau
function showResponse(originalRequest) {
	global_tab[default_show_id]= originalRequest.responseText;
	H_loading();
}

//Chargement en cours...
function S_loading () {
	if ($("load_show").style.visibility == "hidden") {
	$("load_show").style.visibility = "visible";}
}

//Chargement termin�...
function H_loading () {
	$("load_show").style.visibility = "hidden";
}

//erreur de connexion
function S_failure() {
	$("alert_pop_up").style.display = "block";
	$("framealert").style.display = "block";
	$("alert_onException").style.display = "block";
	H_loading();
}

//retour de variable pour l'historique
function history_reload() {
	return default_show_url;
}


//chargement d'appel de feuilles de styles suppl�mentaires
function ajoutcss (fichierCSS) {
	if (!fichierCSS) {
	return;
	}
	var feuillesStyles = document.styleSheets;
	for (var i = 0; i < feuillesStyles.length; i++) {
		if (fichierCSS == feuillesStyles[i].href.toString()) {
		return;
		}
	}
	var link = document.createElement("link");
	link.setAttribute ("type", "text/css");
	link.setAttribute ("rel", "stylesheet");
	link.setAttribute ("href", "<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>"+fichierCSS);
	var head = $$("head")[0];
	head.appendChild(link);
}


function changeclassname (idcible, newclass) {
$(idcible).className=newclass;
}


// ELEMENT de MISE A dimension
//renvois de la hauteur de la fenetre
function getWindowHeight() {
    var windowHeight=0;
    if (typeof(window.innerHeight)=='number') {
        windowHeight=window.innerHeight;
    }
    else {
     if (document.documentElement&&
       document.documentElement.clientHeight) {
         windowHeight = document.documentElement.clientHeight;
    }
    else {
     if (document.body&&document.body.clientHeight) {
         windowHeight=document.body.clientHeight;
      }
     }
    }
    return windowHeight;
}
//renvois de la largeur de la fenetre

function getWindowWidth() {
    var windowWidth=0;
    if (typeof(window.innerWidth)=='number') {
        windowWidth=window.innerWidth;
    }
    else {
     if (document.documentElement&&
       document.documentElement.clientWidth) {
         windowWidth = document.documentElement.clientWidth;
    }
    else {
     if (document.body&&document.body.clientWidth) {
         windowWidth=document.body.clientWidth;
      }
     }
    }
    return windowWidth;
}


// met les �l�ments � la hauteur
function setsize_to_element () {
set_tomax_height("sub_content",0);
set_tomax_height("right_content",0);

	if (navigator.appName=='Microsoft Internet Explorer') {
		$("framealert").style.width="100%";
		$("framealert").style.height=getWindowHeight();
	}

}

function set_tomax_height(id_element, majo) {
	if ($(id_element)) {
   	var position_element=Position.positionedOffset($(id_element));
   	var pos_y=position_element.last();
	$(id_element).style.height = (getWindowHeight()-pos_y+majo)+"px";
	}
}

function positionne_element (evt, element_positionned) {
		var element = Event.element(evt);
    var offsets = Position.positionedOffset(element);
    var top     = offsets[1];
    var left    = offsets[0];
		$(element_positionned).style.position="relative";
		$(element_positionned).style.top = top +"px";
		$(element_positionned).style.left = left+"px";
}

function return_width_element(id_element) {
	if($(id_element)) {
		var dimensions = $(id_element).getDimensions(); 
		return dimensions.width; 
	}
}

function return_height_element(id_element) {
	if($(id_element)) {
		var dimensions = $(id_element).getDimensions(); 
		return dimensions.height; 
	}
}


function centrage_element(id_element){
	if($(id_element)) {
		$(id_element).style.top = ( getWindowHeight()-return_height_element(id_element))/2+"px";
		$(id_element).style.left = (getWindowWidth()-return_width_element(id_element))/2+"px";
	}
}

function centrage_h_element(id_element){
	if($(id_element)) {
		$(id_element).style.left = (getWindowWidth()-return_width_element(id_element))/2+"px";
	}
}


//blocage du retour chariot automatique � la saisie du code barre
function stopifcode_barre (event) {

	var key = event.which || event.keyCode; 
	switch (key) {   
	case Event.KEY_RETURN:     
	Event.stop(event);
	break;   
	}
}

//fonction de s�rialisation d'une liste sans passer par scriptaculous
function serialisation(element, tag) {
var items = $(element).childNodes;
var queryComponents = new Array();

for(var i=0; i<items.length; i++)
if(items[i].tagName && items[i].tagName==tag.toUpperCase())
queryComponents.push(
encodeURIComponent(element) + "[]=" + 
encodeURIComponent(items[i].id.split("_")[1]));

return queryComponents.join("&");
}

//******************************************************
// fonction diverses
//******************************************************

//mise � la bonne largueur poursub_content
function set_size_to_sub_content () {
if (getWindowWidth()>=1280) {
	$("sub_content").style.width= "1280px";
} else {
	$("sub_content").style.width= getWindowWidth()+"px";
}
	
}


//force la s�lection dans un champ select
function preselect (value_index, id_select) {
var selectBox = $(id_select);
for (var i=0; i<selectBox.options.length; i++) {
  if (selectBox.options[i].value == value_index) {
    selectBox.options[i].selected = "selected";
  }
}
}

function PopupCentrer(page,largeur,hauteur,optionsi) {
  var top=(screen.height-hauteur)/2;
  var left=(screen.width-largeur)/2;
  window.open(page,"","top="+top+",left="+left+",width="+largeur+",height="+hauteur+","+optionsi);
}
//rise height
function rise_height (id_element, max_height) {
	if ($(id_element).style.height.replace("px", "") < max_height) {
		$(id_element).style.height = (parseInt($(id_element).style.height.replace("px", ""))+1)+"px";
		setTimeout("rise_height ('"+id_element+"', "+max_height+")", 40);
	}
}


//ouverture d'un document

function open_doc (ref_doc) {
	page.verify("document_edition","index.php#"+escape("documents_edition.php?ref_doc="+ref_doc), "true", "_blank");
}

//rafraichir le contenu en cours (bouton dans barre de menu)
function refresh_sub_content () {
		page.verify("content_frame", unescape(document.location.hash.substr(1, document.location.hash.length)), "true", "sub_content");
}

function session_user_lock(DIR) {
	var AppelAjax = new Ajax.Request(
		DIR+"session_user_lock.php", 
		{
		evalScripts	:true, 
		onSuccess	: function (requester){
						if (requester.responseText!="ok")
						{		ask_login(requester.responseText);}
					}
		}
		);
}