<?PHP 
// *************************************************************************************************************
// CLASSE DE GENERATION COMPTE RENDU DE TRANSFERT DE CAISSE PDF - 
// *************************************************************************************************************


class pdf_transfert_caisse extends PDF_etendu {
	var $code_pdf_modele = "transfert_caisse";

	var $compte_caisse;					// infos compte
	var $transfert;		
	var $lib_type_printed;
	var $text_contenu_transfert;
	var $explode_contenu_transfert;
	
	var $nb_pages;
	var $contenu_actuel;
	var $contenu_end_page;
	var $page_actuelle;
	var $content_printed;


	var $HAUTEUR_LINE_ARTICLE;
	var $LARGEUR_TOTALE_CORPS;

	var $ENTETE_COD_BNQ;
	var $ENTETE_COD_GUI;
	var $ENTETE_COD_NUM;
	var $ENTETE_CLE_RIB;
	var $ENTETE_IBAN;
	var $ENTETE_SWIFT;

	var $MARGE_GAUCHE;
	var $MARGE_HAUT;

public function create_pdf ($compte_caisse, $id_compte_caisse_transfert) {
	global $PDF_MODELES_DIR;
	global $TRSF_CAIS;
	global $MONNAIE;
	
	$this->compte_caisse	= $compte_caisse;
	$this->transfert = $this->compte_caisse->charger_transfert_caisse ($id_compte_caisse_transfert);
	$this->lib_type_printed 	= "Transfert entre caisses";
	
	
	include_once ($PDF_MODELES_DIR."config/".$this->code_pdf_modele.".config.php");

	// ***************************************************
	// Initialisation de l'objet PDF
	parent::__construct();

	// ***************************************************
	// Initialisation des variables
	$this->nb_pages					= 1;


	// ***************************************************
	// Valeurs par d?faut
	foreach ($TRSF_CAIS as $var => $valeur) {
		$this->{$var} = $valeur;
	}

	// Cr?ation de la premi?re page
	$this->create_pdf_page ();


	return $this;
}


// Cr?? une nouvelle page du document PDF
protected function create_pdf_page () {
	// Comptage du nombre de page
	$this->page_actuelle++;
	$this->SetAutoPageBreak(true,2*$this->MARGE_GAUCHE);;
	// Cr?ation d'une nouvelle page
	$this->AddPage();
	$this->Header() ;
	$this->create_pdf_corps ();

}


// Cr?? l'entete du document PDF
public function Header() {
	global $MONNAIE;
	global $TARIFS_NB_DECIMALES;

	$this->SetFont('Arial', 'B', 8);
	
	$this->SetXY($this->MARGE_GAUCHE, $this->MARGE_HAUT);
	$this->Cell (36, 3, "page : ".$this->PageNo(), 0, 0, 'L');
	$this->SetXY($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS - 36 , $this->MARGE_HAUT);
	$this->Cell (36, 3, date_Us_to_Fr($this->transfert->date_transfert)." ".getTime_from_date($this->transfert->date_transfert), 0, 0, 'L');
	// ***************************************************
	// TITRE
	$this->SetXY($this->MARGE_GAUCHE, $this->MARGE_HAUT);
	$this->SetFont('Times', 'B', 22);
	$this->Cell ($this->LARGEUR_TOTALE_CORPS, 10, $this->lib_type_printed, 0, 0, 'C');

	//de caisse vers caisse
	$this->SetFont('Arial', 'B', 10);
	$this->SetXY($this->MARGE_GAUCHE , $this->MARGE_HAUT+15);
	$this->Cell (70, 3, ($this->transfert->lib_caisse_source)." vers ".($this->transfert->lib_caisse_dest), 0, 0, 'L');
	// ***************************************************
	// tableau
	$this->SetFont('Arial', 'B', 8);
	
	$this->SetXY($this->MARGE_GAUCHE, 40);
	$this->Cell (45, 15, "", 1, 0, 'L');
	$this->SetXY($this->MARGE_GAUCHE+45, 40);
	$this->Cell (45, 15, $this->ENTETE_ESP, 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE+90, 40);
	$this->Cell (45, 15, $this->ENTETE_CHQ, 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE+135, 40);
	$this->Cell (45, 15, $this->ENTETE_TT, 1, 0, 'C');
	
	
	$this->SetXY($this->MARGE_GAUCHE, 55);
	$this->Cell (45, 15, $this->ENTETE_TT_THE, 1, 0, 'L');
	$this->SetXY($this->MARGE_GAUCHE+45, 55);
	$this->Cell (45, 15, number_format($this->transfert->ESP->montant_theorique, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE+90, 55);
	$this->Cell (45, 15, number_format($this->transfert->CHQ->montant_theorique, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE+135, 55);
	$this->Cell (45, 15, number_format($this->transfert->ESP->montant_theorique+$this->transfert->CHQ->montant_theorique, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE, 70);
	$this->Cell (45, 15, $this->ENTETE_TT_CNT, 1, 0, 'L');
	$this->SetXY($this->MARGE_GAUCHE+45, 70);
	$this->Cell (45, 15, number_format($this->transfert->ESP->montant_transfert, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE+90, 70);
	$this->Cell (45, 15, number_format($this->transfert->CHQ->montant_transfert, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE+135, 70);
	$this->Cell (45, 15, number_format($this->transfert->ESP->montant_transfert+$this->transfert->CHQ->montant_transfert, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetXY($this->MARGE_GAUCHE, 85);
	$this->Cell (45, 15, $this->ENTETE_TT_DIF, 1, 0, 'L');
	$this->SetTextColor(0,0,0);
	if ($this->transfert->ESP->montant_theorique - $this->transfert->ESP->montant_transfert < 0) {$this->SetTextColor(254,0,0);}
	$this->SetXY($this->MARGE_GAUCHE+45, 85);
	$this->Cell (45, 15, number_format($this->transfert->ESP->montant_theorique - $this->transfert->ESP->montant_transfert, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetTextColor(0,0,0);
	if ($this->transfert->CHQ->montant_theorique - $this->transfert->CHQ->montant_transfert < 0) {$this->SetTextColor(254,0,0);}
	$this->SetXY($this->MARGE_GAUCHE+90, 85);
	$this->Cell (45, 15, number_format($this->transfert->CHQ->montant_theorique - $this->transfert->CHQ->montant_transfert, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	$this->SetTextColor(0,0,0);
	if (($this->transfert->ESP->montant_theorique+$this->transfert->CHQ->montant_theorique)-($this->transfert->ESP->montant_transfert+$this->transfert->CHQ->montant_transfert) < 0) {$this->SetTextColor(254,0,0);}
	$this->SetXY($this->MARGE_GAUCHE+135, 85);
	$this->Cell (45, 15, number_format(($this->transfert->ESP->montant_theorique+$this->transfert->CHQ->montant_theorique)-($this->transfert->ESP->montant_transfert+$this->transfert->CHQ->montant_transfert), $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0], 1, 0, 'C');
	
	
	$this->SetTextColor(0,0,0);
	
	$this->SetXY($this->MARGE_GAUCHE, 100);
	$this->MultiCell ($this->LARGEUR_TOTALE_CORPS, 15, $this->ENTETE_COM." ".$this->transfert->commentaire, 0, 'L');
	
	$this->y = $this->y+5;
	$this->SetXY($this->MARGE_GAUCHE, $this->y);
	$this->Cell ($this->LARGEUR_TOTALE_CORPS, 5 , "", 'T', 0, 'C');
	$this->y = $this->y+5;
	
	return true;
}


// Cr?? le corps du PDF
protected function create_pdf_corps () {
	global $MONNAIE;
	global $TARIFS_NB_DECIMALES;



	$this->SetFont('Arial', '', 8);

	//d?finition du contenu
	
	//liste des esp?ces
	$esp_liste = explode("\n",$this->transfert->ESP->infos_transfert);
	
	$this->text_contenu_transfert = $this->ENTETE_ESP." : ". number_format($this->transfert->ESP->montant_transfert, $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0]."\n";

	
	foreach ($esp_liste as $esp_cont) {
		$tmp = explode(";", $esp_cont);
		if (isset($tmp[1])) {$this->text_contenu_transfert .= " ".$tmp[1]."x".$tmp[0]." ".$MONNAIE[0]."; ";}
	}
	
	$this->SetXY($this->MARGE_GAUCHE, $this->y);
	$this->MultiCell ($this->LARGEUR_TOTALE_CORPS, 4, $this->text_contenu_transfert, 0, 'L');
	
	//liste des ch?ques
	$this->text_contenu_transfert = "\n";
	
	$chq_liste = explode("\n",$this->transfert->CHQ->infos_transfert);
	for ($i = 0 ; $i < count($chq_liste); $i++) {
		if (isset($chq_liste[$i]) && (empty($chq_liste[$i]) || $chq_liste[$i] == "" || $chq_liste[$i] ==" ")) {unset($chq_liste[$i]);}
	}
	$this->text_contenu_transfert .= $this->ENTETE_CHQ." : ";
		$this->text_contenu_transfert .= " (".count($chq_liste);
		$this->text_contenu_transfert .= " op?rations )";
		foreach ($chq_liste as $chq_cont) {
			$tmp = explode(";", $chq_cont);
			if (isset($tmp[0]) && $tmp[0] && isset($tmp[1])  && (empty($tmp[1]) || $tmp[1] == "" || $tmp[1] ==" ") ) {$this->text_contenu_transfert .= " ".number_format($tmp[0], $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0]." * ; "; continue;}
			if (isset($tmp[0]) && $tmp[0] && isset($tmp[1]) && $tmp[1]) {$this->text_contenu_transfert .= " ".number_format($tmp[0], $TARIFS_NB_DECIMALES, ".", ""	)." ".$MONNAIE[0]."; "; continue;}
			
		}
	
	
	
	
	$this->SetXY($this->MARGE_GAUCHE, $this->y);
	$this->MultiCell ($this->LARGEUR_TOTALE_CORPS, 4, $this->text_contenu_transfert, 0, 'L');
	
	
	
	

	return true;
}


}

?>