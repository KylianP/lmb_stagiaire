var tab_alerte	=	new Array;

// alertes navigateur autre que firefox
tab_alerte["alert_nav"]	=	new Array ('<div style="text-align:right"><img src="themes/admin_fr/images/supprime.gif" id="bouton0" style="cursor:pointer" title="fermer la fen�tre" /></div>', '<a href="http://www.mozilla-europe.org/fr/firefox/" target="_blank"><img src="themes/admin_fr/images/telecharger-firefox.jpg"/></a>', '');

// alertes relatives � la gestion des contact de l'annuaire
tab_alerte["contact_profil2_supprime"]	=	new Array ('Suppression des informations Administrateur', 'Confirmez la suppression de ce profil', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_profil3_supprime"]	=	new Array ('Suppression des informations Collaborateur', 'Confirmez la suppression de ce profil', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_profil4_supprime"]	=	new Array ('Suppression des informations Client', 'Confirmez la suppression de ce profil', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_profil5_supprime"]	=	new Array ('Suppression des informations Fournisseur', 'Confirmez la suppression de ce profil', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_profil6_supprime"]	=	new Array ('Suppression des informations Constructeur', 'Confirmez la suppression de ce profil', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_profil7_supprime"]	=	new Array ('Suppression des informations Commercial', 'Confirmez la suppression de ce profil', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_site_supprime"]	=	new Array ('Suppression d\'un site', 'Confirmez la suppression de ce site', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_coordonnee_supprime"]	=	new Array ('Suppression d\'une coordonn�e', 'Confirmez la suppression de cette coordonn�e', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_adresse_supprime"]	=	new Array ('Suppression d\'une adresse', 'Confirmez la suppression de cette adresse', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_user_supprime"]	=	new Array ('Suppression d\'un utilisateur', 'Confirmez la suppression de cet utilisateur', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["user_compte_maitre"]	=	new Array ('Suppression de l\'utilisateur impossible', 'Cet utilisateur est un compte ma�tre, sa suppression est impossible', '<input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["fusionner_contact"]	=	new Array ('Fusionner deux contact', 'Confirmer la fusion des deux fiches de contact', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_suspendre_user"]	=	new Array ('Suspendre les utilisateurs', 'Confirmer la suspension des utilisateurs de ce contact', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["contact_archivage"]	=	new Array ('Supprimer ce contact', 'Confirmer la suppression de ce contact', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

tab_alerte["evenements_contact_sup"]	=	new Array ('Supprimer ce type d\'�v�nement', 'Confirmer la suppression de ce type d\'�v�nement', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//suppression d'un code barre
tab_alerte["envoyer_a_del"]	=	new Array ('Supprimer cet email?', 'Confirmer la suppression de cet email de la liste', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//******************************************
// alerte de modification d'un formulaire
tab_alerte["form_change"]	=	new Array ('Formulaire modifi�', 'Le formulaire � �t� modifi�', '<input type="submit" name="bouton1" id="bouton1" value="Ignorer les modifications" /><input type="submit" id="bouton0" name="bouton0" value="Retour" />');


//******************************************
// alerte de gestion du catalogue

//suppression d'un cat�gorie
tab_alerte["catalogue_supprim_categs"]	=	new Array ('Suppression d\'une cat�gorie', 'Confirmez la suppression d\'une cat�gorie d\'articles', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');
//supression d'un cat�gorie IMPOSSIBLE
tab_alerte["catalogue_supprim_categs_impossible"]	=	new Array ('Suppression d\'une cat�gorie abandonn�e', 'Cette cat�gorie ne peut pas �tre supprim�e car elle comporte des articles', '<input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

// suppression d'un grp de caracteristique
tab_alerte["catalogue_categorie_sup_grpcaract"]	=	new Array ('Suppression d\'un groupe de caract�ristiques', 'Confirmez la suppression d\'un groupe de caract�ristiques', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//suppression d'une caract�ristique
tab_alerte["catalogue_categorie_sup_caract"]	=	new Array ('Suppression d\'une caract�ristique', 'Confirmez la suppression d\'une caract�ristique', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');


//suppression d'une caract�ristique variante
tab_alerte["variante_alerte_sup_caract"]	=	new Array ('Suppression d\'une caract�ristique', 'Confirmez la suppression d\'une caract�ristique.<br/>Attention la modification d\'une caract�ristique du type variante en non-variante peut modifier profond�ment votre catalogue.', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//modification d'une caract�ristique variante
tab_alerte["variante_alerte"]	=	new Array ('Modification d\'une caract�ristique', 'Attention la modification d\'une caract�ristique du type variante en non-variante peu modifier profond�ment votre catalogue.', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la modification" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//alerte de suppression d'un catalogue client
tab_alerte["catalogue_client_supprime"]	=	new Array ('Suppression d\'un catalogue client', 'Confirmez la suppression de ce catalogue', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//suppression d'un cat�gorie d'un catalogue client
tab_alerte["catalogues_clients_edition_avance_dir_sup"]	=	new Array ('Suppression d\'une cat�gorie', 'Confirmez la suppression d\'une cat�gorie ', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');


//Tarifs
// suppression d'un tarif
tab_alerte["catalogue_liste_tarifs_sup"]	=	new Array ('Suppression d\'un tarif', 'Confirmez la suppression d\'un tarif', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

// suppression d'une formule tarifaire
tab_alerte["tarif_del_art_formule"]	=	new Array ('Suppression d\'une formule', 'Confirmez la suppression de cette formule', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

// suppression d'un tarif IMPOSSIBLE
tab_alerte["catalogue_liste_tarifs_sup_impossible"]	=	new Array ('Suppression d\'un tarif abandonn�', 'Ce tarif ne peut pas �tre supprim� car il est utilis� par un Magasin', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');
// suppression d'un tarif IMPOSSIBLE dernier tarif pr�sent
tab_alerte["catalogue_liste_tarifs_last_liste_tarif"]	=	new Array ('Suppression d\'un tarif abandonn�', 'Ce tarif ne peut pas �tre supprim�, vous devez avoir au moins un tarif valide', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');


// suppression d'une enseigne
tab_alerte["catalogue_enseignes_sup"]	=	new Array ('Suppression d\'une enseigne', 'Confirmez la suppression d\'une enseigne ', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//Modification d'un magasin

tab_alerte["catalogue_magasins_actives_caisses"]	=	new Array ('D�sactivation impossible', 'Les caisses associ�es � un magasin doivent �tre pr�alablement d�sactiv�es (menu comptabilit� caisses) ', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');
//d�sactivation impossible car dernier magasin
tab_alerte["catalogue_magasins_last_active_magasin"]	=	new Array ('D�sactivation impossible', 'Vous devez avoir au moins un magasin actif', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');

//pas de lieux  de stock actif pour ce magasin
tab_alerte["catalogue_magasins_stock_not_actif"]	=	new Array ('Aucun lieu de stockage actif', 'Vous devez avoir au moins un lieu de stockage actif pour les magasins', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');

//pas de grille de tarif pour ce magasin
tab_alerte["catalogue_magasins_tarif_not_existing"]	=	new Array ('Aucune grille tarifaire correspondante', 'Vous devez avoir au moins grille tarifaire valide pour les magasins', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');


//modification d'un lieu de stockage
//un magasin utilise ce stock
tab_alerte["catalogue_stockage_magasin_using_stock"]	=	new Array ('Lieu de stockage utilis�', 'Ce lieu de stockage est utilis� par un magasin, vous ne pouvez pas le d�sactiver', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');

//des documents non achev�s utilise ce stock
tab_alerte["catalogue_stockage_documents_using_stock"]	=	new Array ('Lieu de stockage utilis�', 'Ce lieu de stockage est utilis� par un ou des documents en attente de validation, vous ne pouvez pas le d�sactiver', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');

//dernier lieu de stockage actif
tab_alerte["catalogue_stockage_last_active_stock"]	=	new Array ('Dernier lieux de stockage actif', 'Vous devez avoir au moins un lieux de stockage actif', '<input type="submit" id="bouton0" name="bouton0" value="Ok" />');


//suppr�ssion d'une taxe
tab_alerte["catalogue_taxes_sup"]	=	new Array ('Suppression d\'une Taxe', 'Confirmez la suppression d\'une taxe', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');


//suppr�ssion d'une categorie de fournisseur
tab_alerte["categories_fournisseur_sup"]	=	new Array ('Suppression d\'une cat�gorie de fournisseur', 'Confirmez la suppression d\'une cat�gorie de fournisseur', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');
//suppr�ssion d'une categorie de commerciaux
tab_alerte["categories_commercial_sup"]	=	new Array ('Suppression d\'une cat�gorie de commerciaux', 'Confirmez la suppression d\'une cat�gorie de commerciaux', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//suppr�ssion d'une categorie de client
tab_alerte["categories_client_sup"]	=	new Array ('Suppression d\'une cat�gorie de client', 'Confirmez la suppression d\'une cat�gorie de client', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//suppr�ssion d'un groupe de collaborateur
tab_alerte["fonction_supprime"]	=	new Array ('Suppression d\'une fonction de collaborateurs', 'Confirmez la suppression d\'une fonction de collaborateurs', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');
//suppr�ssion d'une fonction d'utilisateur
tab_alerte["user_fonction_supprime"]	=	new Array ('Suppression d\'une fonction', 'Confirmez la suppression d\'une fonction', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');



//suppression d'une ligne de quantit� dans une grille de tarif
tab_alerte["tarif_delqte"]	=	new Array ('Supprimer la ligne ?', 'Confirmer la suppression de la ligne', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//suppression d'une formule pour une cat�gorie dans les grilles tarifaires (class articles_categ / delete_formule_tarif
tab_alerte["tarif_del_categ"]	=	new Array ('Supprimer la formule', 'Confirmer la suppression de la formule (retour � la formule par default de la grille de tarif', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');


//Niveaux de relances factures
// suppression d'un niveau
tab_alerte["annuaire_gestion_factures_n_relances_sup"]	=	new Array ('Suppression d\'un niveau', 'Confirmez la suppression d\'un niveau de relance facture', '<input type="submit" name="bouton1" id="bouton1" value="Confirmez la suppression" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//comptabbilit�

//supression d'un compte bancaire
tab_alerte["compta_compte_bancaire_sup"]	=	new Array ('Suppression d\'un compte bancaire', 'Confirmer la suppression de ce compte', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')

//supression d'une caisse
tab_alerte["compta_compte_caisse_sup"]	=	new Array ('Suppression d\'une caisse', 'Confirmer la suppression de cette caisse', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')

//supression d'un terminal de paiement electronique
tab_alerte["compta_compte_tpes_sup"]	=	new Array ('Suppression d\'un terminal de paiement', 'Confirmer la suppression de ce terminal', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')

//supression d'un terminal de paiement virtuels
tab_alerte["compta_compte_tpv_sup"]	=	new Array ('Suppression d\'un terminal de paiement virtuel', 'Confirmer la suppression de ce terminal', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')

//supression d'une carte bancaire
tab_alerte["compta_compte_cbs_sup"]	=	new Array ('Suppression d\'une carte bancaire', 'Confirmer la suppression de cette carte bancaire', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')

//supression serveur_import_supprime
tab_alerte["serveur_import_supprime"]	=	new Array ('Suppression d\'un serveur d\'import', 'Confirmer la suppression de ce serveur d\'import', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')

//suppression d'un exercice comptable
tab_alerte["compta_exercice_sup"]	=	new Array ('Suppression d\'un exercice', 'Confirmez la suppression de cet exercice comptable', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//cloture d'un exercice comptable
tab_alerte["compta_exercice_cloture"]	=	new Array ('Cl�ture  d\'un exercice', 'Confirmez la cl�ture  de cet exercice comptable<br /> ATTENTION!!<br />Cette op�ration est irr�versible.', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');


//Suppression d'un relev� de compte
tab_alerte["compta_releve_compte"]	=	new Array ('Supression d\'un relev� de compte', 'Confirmez la suppression de ce relev� de compte<br /> ATTENTION!!<br />Cette op�ration est irr�versible.', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//Suppression d'un compte d'entreprise des favoris
tab_alerte["compta_plan_entreprise_sup"]	=	new Array ('Supression d\'un compte', 'Confirmez la suppression de la liste des favoris de ce compte d\'entreprise.<br />', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');
//Suppression d'un compte g�n�ral
tab_alerte["compta_plan_general_sup"]	=	new Array ('Supression d\'un compte', 'Confirmez la suppression de ce compte .<br />', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');
//Suppression dun taux de tva
tab_alerte["configuration_tva_sup"]	=	new Array ('Supression d\'un taux de tva', 'Confirmez la suppression de ce taux de TVA .<br />', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');


//supression d'une newsletter
tab_alerte["communication_newsletters_sup"]	=	new Array ('Suppression d\'une newsletter', 'Confirmer la suppression de cette newsletter', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')

//supression d'un template d'email
tab_alerte["communication_mail_template_sup"]	=	new Array ('Suppression d\'un temlate d\'email', 'Confirmer la suppression de ce template d\'email', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')


//supression d'un livraison_mode_sup
tab_alerte["livraison_modes_sup"]	=	new Array ('Suppression d\'un mode de livraison', 'Confirmer la suppression de ce mode de livraison', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')
//supression d'un livraison_modes_zone_sup
tab_alerte["livraison_modes_zone_sup"]	=	new Array ('Suppression d\'une zone de livraison', 'Confirmer la suppression de cette zone de livraison', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />')


tab_alerte["configuration_docs_infos_lines_del"]	=	new Array ('Suppression d\'un mod�le de ligne', 'Confirmez la suppression de ce mod�le de ligne', '<input type="submit" name="bouton1" id="bouton1" value="Supprimer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');

//supression d'un agenda
tab_alerte["agenda_sup"]	=	new Array ('Suppression d\'un agenda', 'Confirmer la suppression de cet agenda', '<input type="submit" name="bouton1" id="bouton1" value="Confirmer" /><input type="submit" id="bouton0" name="bouton0" value="Annuler" />');
