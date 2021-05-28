//mettre le compte bancaire à actif
function set_active_compte (id_compte_bancaire) {
	var AppelAjax = new Ajax.Request(
									"compta_compte_bancaire_active_compte.php", 
									{
									parameters: {id_compte_bancaire: id_compte_bancaire},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();},
									onSuccess: function (requester){
															requester.responseText.evalScripts();
															H_loading(); 
															}
									}
									);
}

//mettre le compte bancaire à inactif
function set_desactive_compte (id_compte_bancaire) {
	var AppelAjax = new Ajax.Request(
									"compta_compte_bancaire_desactive_compte.php", 
									{
									parameters: {id_compte_bancaire: id_compte_bancaire},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();},
									onSuccess: function (requester){
															requester.responseText.evalScripts();
															H_loading(); 
															}
									}
									);
}