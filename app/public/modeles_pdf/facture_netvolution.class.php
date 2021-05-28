<?PHP 
// *************************************************************************************************************
// CLASSE DE GENERATION D'UN DOCUMENT PDF - MODELE STANDARD
// *************************************************************************************************************
require_once($PDF_MODELES_DIR."doc_standard.class.php");

class pdf_content_facture_netvolution extends pdf_content_doc_standard {
	var $code_pdf_modele = "facture_netvolution";

	var $texte_corps_pieds;



// Créé l'entete du document PDF
protected function create_pdf_entete () {
	global $IMAGES_DIR;

	// ***************************************************
	// LOGO
	$this->pdf->Image($IMAGES_DIR.$this->IMG_LOGO, $this->MARGE_GAUCHE, $this->MARGE_HAUT, 50);

	// ***************************************************
	// TITRE
	$this->pdf->SetXY(100, $this->MARGE_HAUT);
	$this->pdf->SetFont('Arial', 'B', 25);
	$this->pdf->Cell (95, 10, $this->lib_type_printed, 0, 0, 'L');

	// ***************************************************
	// Référence du document
	$this->pdf->SetXY(101, 27);
	$this->pdf->SetFont('Arial', '', 8);
	$ref_doc_lib = "Référence";
	$this->pdf->Cell (13, 3, $ref_doc_lib, 0, 0, 'L');
	$this->pdf->Cell (3, 3, ":", 0, 0, 'L');
	$this->pdf->Cell (40, 3, $this->ref_doc, 0, 0, 'L');

	// ***************************************************
	// Date du document
	$this->pdf->SetXY(101, 31);
	$date_lib = "Date";
	$this->pdf->Cell (13, 3, $date_lib, 0, 0, 'L');
	$this->pdf->Cell (3, 3, ":", 0, 0, 'L');
	$this->pdf->Cell (40, 3, date_Us_to_Fr($this->date_creation), 0, 0, 'L');

	if ($this->document->getId_niveau_relance ()) {
		$liste_niv_relance = $this->document->getNiveaux_relances ();
		foreach ($liste_niv_relance as $niv) {
			if (!$niv->impression || $niv->id_niveau_relance != $this->document->getId_niveau_relance ()) {continue;}
			// ***************************************************
			// niveau de relance
			$this->pdf->SetXY(117, 35);
			$this->pdf->Cell (40, 3, ($niv->lib_niveau_relance), 0, 0, 'L');

		}
	}

	return true;
}


protected function create_pdf_pieds () {
	global $MONNAIE;
	
	// Pieds de page
	$this->pdf->SetXY($this->MARGE_GAUCHE, $this->PIEDS_HAUTEUR_DEPART);

	// Cadre de pieds de page
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, $this->PIEDS_HAUTEUR_MAX, "", '1', 1, 'L');

	// Information société
	$this->pdf->SetXY($this->MARGE_GAUCHE, $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX + 1);
	$this->pdf->SetFont('Arial', 'B', 8);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->RAISON, '0', 2, 'L');

	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->FORME_JURIDIQUE, '0', 2, 'L');

	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, "Siège social ", '0', 2, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->ADRESSE1, '0', 2, 'L');
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->ADRESSE2, '0', 2, 'L');

	// 2è colonne
	$XColMil = 75;
	$this->pdf->SetXY($XColMil, $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX + 4,5);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (4.8, 3.5, "Tél ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->TEL, '0', 2, 'L');

	$this->pdf->SetX($XColMil);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (5.2, 3.5, "Fax ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->FAX, '0', 2, 'L');
	
	$this->pdf->SetX($XColMil);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (7.4, 3.5, "Email ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->EMAIL, '0', 2, 'L');
	
	$this->pdf->SetX($XColMil);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (6.3, 3.5, "Web ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->WEB, '0', 2, 'L');
	
	// 3è colonne
	$XColMil = 135;
	$this->pdf->SetXY($XColMil, $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX + 4,5);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (5.7, 3.5, "RCS ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->RCS, '0', 2, 'L');

	$this->pdf->SetX($XColMil);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (5.6, 3.5, "TVA ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->TVA, '0', 2, 'L');
	
	$this->pdf->SetX($XColMil);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (7.1, 3.5, "IBAN ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->IBAN, '0', 2, 'L');
	
	$this->pdf->SetX($XColMil);
	$this->pdf->SetFont('Arial', 'B', 7);
	$this->pdf->SetTextColor(33, 56, 94);
	$this->pdf->Cell (5.2, 3.5, "BIC ", '0', 0, 'L');
	$this->pdf->SetFont('Arial', '', 7);
	$this->pdf->SetTextColor(0,0,0);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 3.5, $this->BIC, '0', 2, 'L');
	
/*
Couleur bleue logo : #478BB2 / rgb(33, 56, 94)
*/

/*
	foreach ($this->PIEDS_GAUCHE as $texte) {
		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 4.5, $texte, '0', 2, 'L');
	}
*/
/*

	$this->pdf->SetXY(0, $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX + 1);
	foreach ($this->PIEDS_DROIT as $texte) {
		$this->pdf->Cell ($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS, 4.5, $texte, '0', 2, 'R');
	}
*/

	// Bloc Montant Total
	$largeur_bloc_montant = 61;
	$largeur_col1_montant = 30;
	$largeur_col2_montant = 3;
	$largeur_col3_montant = $largeur_bloc_montant - $largeur_col1_montant - $largeur_col2_montant;

	$this->pdf->SetXY($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS - $largeur_bloc_montant, $this->PIEDS_HAUTEUR_DEPART);
	$this->pdf->SetFont('Arial', 'B', 10);
	$this->pdf->Cell ($largeur_bloc_montant, 8, "MONTANT TOTAL EN ".$MONNAIE[2], '1', 2, 'C');

	$this->pdf->Cell ($largeur_col1_montant, 7, "Montant HT", 'L', 0, 'L');
	$this->pdf->Cell ($largeur_col2_montant, 7, ":", '0', 0, 'C');
	$this->pdf->Cell ($largeur_col3_montant, 7, price_format ($this->montant_ht)."  ", '0', 2, 'R');
	$this->pdf->SetX ($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS - $largeur_bloc_montant);

	$this->pdf->Cell ($largeur_col1_montant, 7, "Montant TVA", 'L', 0, 'L');
	$this->pdf->Cell ($largeur_col2_montant, 7, ":", '0', 0, 'C');
	$this->pdf->Cell ($largeur_col3_montant, 7, price_format ($this->montant_tva)."  ", '0', 2, 'R');
	$this->pdf->SetX ($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS - $largeur_bloc_montant);

	$this->pdf->SetFont('Arial', 'B', 13);
	$this->pdf->Cell ($largeur_col1_montant, 10, "Montant TTC", 'LTB', 0, 'L');
	$this->pdf->Cell ($largeur_col2_montant, 10, ":", 'TB', 0, 'C');
	$this->pdf->Cell ($largeur_col3_montant, 10, price_format ($this->montant_ttc)."  ", 'TBR', 2, 'R');
	
	// Bloc TVA
	$largeur_bloc_tva = 40;
	$largeur_col1_tva = 20;
	$largeur_col2_tva = $largeur_bloc_tva - $largeur_col1_tva;

	$this->pdf->SetXY($this->MARGE_GAUCHE, $this->PIEDS_HAUTEUR_DEPART);
	$this->pdf->SetFont('Arial', 'B', 10);
	$this->pdf->Cell ($largeur_col1_tva, 8, "Taux TVA", '1', 0, 'C');
	$this->pdf->Cell ($largeur_col2_tva, 8, "Montant", '1', 2, 'C');
	$this->pdf->SetX($this->MARGE_GAUCHE);
	$this->pdf->SetFont('Arial', '', 9);
	foreach ($this->tvas as $tva => $montant_tva) {
		if (!$montant_tva) { continue; }
		$this->pdf->Cell ($largeur_col1_tva, 6, $tva." %", 'R', 0, 'C');
		$this->pdf->Cell ($largeur_col2_tva, 6, price_format ($montant_tva)."  ", 'R', 2, 'R');
		$this->pdf->SetX($this->MARGE_GAUCHE);
	}
	while ($this->pdf->getY() < $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX) {
		$this->pdf->Cell ($largeur_col1_tva, 1, "", 'R', 0, 'C');
		$this->pdf->Cell ($largeur_col2_tva, 1, "", 'R', 2, 'C');
		$this->pdf->SetX($this->MARGE_GAUCHE);
	}
	
	// Bloc central
	$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva, $this->PIEDS_HAUTEUR_DEPART);
	$this->pdf->SetFont('Arial', 'B', 10);
	$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 8,"Conditions de règlement" , '1', 0, 'C');
	
	// Bloc partie acquitement
	$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva, $this->PIEDS_HAUTEUR_DEPART+8);
	$this->pdf->SetFont('Arial', '', 9);
	
	//chargement des reglements
	$reglements = $this->document->getReglements ();
	
	if (abs($this->document->getMontant_to_pay ()) < 0.01 ) {
		$last_reglement = "0000-00-00";
		foreach($reglements as $reglement) {
			if ( $last_reglement < $reglement->date_reglement ){$last_reglement = $reglement->date_reglement;}
		}
		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 8, "Facture acquittée le ".date_Us_to_Fr($last_reglement), '1', 0, 'L');
	} else {
		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 8, "Echéance le: ".date_Us_to_Fr($this->document->getDate_echeance ())."   Restant dû : ".price_format ($this->document->getMontant_to_pay ()).$MONNAIE[0], '1', 0, 'L');
	}
	
	//reglements
	$decalage = 0;
	foreach($reglements as $reglement) {
		if ($decalage > 3) { continue; }
		if ($decalage == 3) {
			$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva, $this->PIEDS_HAUTEUR_DEPART+16+($decalage*4));
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 4, "... ", '0', 0, 'L');
			$decalage ++;
			continue;
		}
		$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva, $this->PIEDS_HAUTEUR_DEPART+16+($decalage*4));
		$this->pdf->SetFont('Arial', '', 8);
		$date_reglement = "";
		if ($reglement->date_reglement!= 0000-00-00) {
			$date_reglement = date_Us_to_Fr ($reglement->date_reglement);
		}
		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 4, "Reglement le ".$date_reglement."   ", '0', 0, 'L');
		
		$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva+45, $this->PIEDS_HAUTEUR_DEPART+16+($decalage*4));
		$this->pdf->SetFont('Arial', '', 8);
		$this->pdf->Cell (10, 4, price_format ($reglement->montant_reglement).$MONNAIE[0], '0', 0, 'R');
		
		
		$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva+55, $this->PIEDS_HAUTEUR_DEPART+16+($decalage*4));
		$this->pdf->SetFont('Arial', '', 8);
		$lib_reglement_mode = $reglement->lib_reglement_mode;
		if ($this->pdf->GetStringWidth($lib_reglement_mode) >= 20) {
		while ($this->pdf->GetStringWidth($lib_reglement_mode."...") >= 20) {
			$lib_reglement_mode = substr ($lib_reglement_mode, 0, -1);
		}
		$lib_reglement_mode = $lib_reglement_mode."...";
		}
		$this->pdf->Cell (8, 4, $lib_reglement_mode, '0', 0, 'L');
		
		$decalage ++;
	}
}

}

?>
