<?PHP 
// *************************************************************************************************************
// CLASSE PERMETTANT L'AJOUT D'UN DOCUMENT A UN PDF - MODELE STANDARD
// *************************************************************************************************************
require_once($PDF_MODELES_DIR."doc_standard.class.php");

class pdf_content_doc_dev_standard extends pdf_content_doc_standard{
	var $code_pdf_modele = "doc_dev_standard";

	
	protected function create_pdf_pieds () {
		global $MONNAIE;
		global $IMAGES_DIR;

		$this->pdf->SetLineWidth(0.1);
		$this->pdf->SetDrawColor(100,100,100);
		
		// Pieds de page
		$this->pdf->SetFont('petita', '', 8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetXY($this->MARGE_GAUCHE, $this->PIEDS_HAUTEUR_DEPART);
	
		// Cadre de pieds de page
//		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, $this->PIEDS_HAUTEUR_MAX, "", '1', 1, 'L');
	
		// Information société
		$this->pdf->Image($IMAGES_DIR."netvolution-pieddepage.jpg", 0, $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX, 207);

		$this->pdf->SetXY($this->MARGE_GAUCHE, $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX + 1);
		foreach ($this->PIEDS_GAUCHE as $texte) {
			$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS, 4.5, $texte, '0', 2, 'L');
		}
	
		$this->pdf->SetXY(0, $this->PIEDS_HAUTEUR_DEPART + $this->PIEDS_HAUTEUR_MAX + 1);
		foreach ($this->PIEDS_DROIT as $texte) {
			$this->pdf->Cell ($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS, 4.5, $texte, '0', 2, 'R');
		}
		$this->pdf->SetTextColor(0,0,0);
	
		$largeur_bloc_montant = 0;
		$largeur_bloc_tva = 0;
		if(!isset($this->AFF_PRIX) || $this->AFF_PRIX){
			// Bloc Montant Total
			$largeur_bloc_montant = 61;
			$largeur_col1_montant = 30;
			$largeur_col2_montant = 3;
			$largeur_col3_montant = $largeur_bloc_montant - $largeur_col1_montant - $largeur_col2_montant;
		
			$this->pdf->SetXY($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS - $largeur_bloc_montant, $this->PIEDS_HAUTEUR_DEPART);
			$this->pdf->SetFont('Arial', '', 10);
//			$this->pdf->Cell ($largeur_bloc_montant, 8, "MONTANT TOTAL EN ".$MONNAIE[2], '1', 2, 'C');

			$this->pdf->Cell ($largeur_col1_montant, 5, "Total HT", '0', 0, 'R');
			$this->pdf->Cell ($largeur_col3_montant, 5, price_format ($this->montant_ht)." € ", '0', 2, 'R');
			$this->pdf->SetX ($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS - $largeur_bloc_montant);
		
			$this->pdf->Cell ($largeur_col1_montant, 5, "TVA", '0', 0, 'R');
			$this->pdf->Cell ($largeur_col3_montant, 5, price_format ($this->montant_tva)." € ", '0', 2, 'R');
			$this->pdf->SetX ($this->MARGE_GAUCHE + $this->LARGEUR_TOTALE_CORPS - $largeur_bloc_montant);
		
			$this->pdf->Cell ($largeur_col1_montant, 5, "Total TTC", '0', 0, 'R');
			$this->pdf->Cell ($largeur_col3_montant, 5, price_format ($this->montant_ttc)." € ", '0', 2, 'R');
			
			// Bloc TVA
/*			$largeur_bloc_tva = 40;
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
*/
		}	
		// Bloc central
		// Bloc central
		$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva, $this->PIEDS_HAUTEUR_DEPART);
		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 8,"Conditions de règlement" , '0', 0, 'L');
		$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva, $this->PIEDS_HAUTEUR_DEPART+5);
		$this->pdf->SetFont('Arial', '', 7);
		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 6,"Acompte 30% à la commande - Solde à la livraison" , '0', 0, 'L');
		$this->pdf->SetXY($this->MARGE_GAUCHE + $largeur_bloc_tva, $this->PIEDS_HAUTEUR_DEPART+8);
		$this->pdf->Cell ($this->LARGEUR_TOTALE_CORPS-$largeur_bloc_montant-$largeur_bloc_tva, 6,"Mention manuscrite « Bon pour accord » + Tampon & Signature" , '0', 0, 'L');
		
	}
	
}

?>