// Catalogues clients

function add_catalogue_client_dir(id_catalogue_client, ref_art_categ, ref_art_categ_parent) {

	var AppelAjax = new Ajax.Request(
									"catalogues_clients_dir_add.php", 
									{
									parameters: {id_catalogue_client: id_catalogue_client, ref_art_categ: ref_art_categ, ref_art_categ_parent: ref_art_categ_parent  },
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();},
									onSuccess: function (requester){
									requester.responseText.evalScripts();
									H_loading();
									}
									}
									);
}
 
 
 

function del_catalogue_client_dir(id_catalogue_client, ref_art_categ) {
	var AppelAjax = new Ajax.Request(
									"catalogues_clients_dir_del.php", 
									{
									parameters: {id_catalogue_client: id_catalogue_client, ref_art_categ: ref_art_categ},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();},
									onSuccess: function (requester){
									requester.responseText.evalScripts();
									H_loading();
									}
									}
									);
	
}

function add_all_art_categ_to_catalogue(nb_lignes , id_catalogue_client) {
	for (i=0; i < nb_lignes ; i++) {
		$("ins_"+id_catalogue_client+"_"+i).checked = true;
	}
	
	var AppelAjax = new Ajax.Request(
									"catalogues_clients_dir_add_all.php", 
									{
									parameters: {id_catalogue_client: id_catalogue_client},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();},
									onSuccess: function (requester){
									requester.responseText.evalScripts();
									H_loading();
									}
									}
									);
}

function del_all_art_categ_to_catalogue(nb_lignes , id_catalogue_client) {
	for (i=0; i < nb_lignes ; i++) {
		$("ins_"+id_catalogue_client+"_"+i).checked = false;
	}
	var AppelAjax = new Ajax.Request(
									"catalogues_clients_dir_del_all.php", 
									{
									parameters: {id_catalogue_client: id_catalogue_client},
									evalScripts:true, 
									onLoading:S_loading, onException: function () {S_failure();},
									onSuccess: function (requester){
									requester.responseText.evalScripts();
									H_loading();
									}
									}
									);
	
}