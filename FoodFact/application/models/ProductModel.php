<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class productModel extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function rechercher($crit, $offset, $limit) {
		$basereq = "select _produit.id_produit, _produit.product_name, _produit.brands from openfoodfacts._produit left outer join openfoodfacts._ingredienttexte on _produit.id_produit = _ingredienttexte.id_produit where ";
		$req = $basereq;
		$recherche = [];

		if(isset($crit['code'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."_produit.id_produit=? ";
			$recherche[]=$crit['code'];
		}

		if(isset($crit['nom'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."UPPER(product_name) LIKE UPPER('%".$crit['nom']."%') ";
		}
		
		if(isset($crit['marque'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."UPPER(brands) LIKE UPPER('%".$crit['marque']."%') ";
		}
		
		if(isset($crit['pays'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."id_produit in (select _produit.id_produit from openfoodfacts._payscommercialiseproduit where pays= ? )";
			$recherche[]=$crit['pays'];
		}
		
		
		if(isset($crit['ingredients'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."UPPER(_ingredienttexte.ingredient_text) LIKE UPPER('%".$crit['ingredients']."%') ";
		}

		if(isset($crit['additifsAvoir'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			foreach ($crit['additifsAvoir'] as $k => $additif) {
				$req = $req . " ? in ( select id_additif from openfoodfacts._additifcontenus where id_produit = _produit.id_produit ) ";
				$recherche[]=$additif;
				if ($k !== sizeof($crit['additifsAvoir']) - 1) { // si ce n’est pas le dernier additif, on rajoute un and
					$req .= ' and ';
				}
			}

		}
		if(isset($crit['additifsSupprime'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			foreach ($crit['additifsSupprime'] as $k => $additif) {
				$req = $req . " ? not in ( select id_additif from openfoodfacts._additifcontenus where id_produit = _produit.id_produit ) ";
				$recherche[]=$additif;
				if ($k !== sizeof($crit['additifsSupprime']) - 1) { // si ce n’est pas le dernier additif, on rajoute un and
					$req .= ' and ';
				}
			}
		}

		if(isset($crit['nutriScore'])){
			if(!($crit['nutriScore']=='')){
				if(!($req === $basereq)){
				$req = $req."and ";
				}
				$req=$req."nutrition_grade_fr=? ";
				$recherche[]=$crit['nutriScore'];
			}	
		}
		if(isset($crit['energie'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."energy_100g<=? ";
			$recherche[]=$crit['energie'];
		}
		if(isset($crit['matieresGrasses'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."fat_100g<=? ";
			$recherche[]=$crit['matieresGrasses'];
		}
		if(isset($crit['matieresGrassesSaturees'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."satured_fat_100g<=? ";
			$recherche[]=$crit['matieresGrassesSaturees'];
		}
		if(isset($crit['carbo'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."carbohydrates_100g<=? ";
			$recherche[]=$crit['carbo'];
		}
		if(isset($crit['fibresAlimentaires'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."fibers_100g<=? ";
			$recherche[]=$crit['fibresAlimentaires'];
		}
		if(isset($crit['sucres'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."sugars_100g<=? ";
			$recherche[]=$crit['sucres'];
		}
		if(isset($crit['proteines'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."proteins_100g<=? ";
			$recherche[]=$crit['proteines'];
		}
		if(isset($crit['sel'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."salt_100g<=? ";
			$recherche[]=$crit['sel'];
		}
		if(isset($crit['vitamineA'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."vitamin_a_100g>=0 ";
			$recherche[]=$crit['vitamineA'];
		}		
		if(isset($crit['vitamineC'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."vitamin_c_100g>=0 ";
			$recherche[]=$crit['vitamineC'];
		}
		if(isset($crit['sodium'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."sodium_100g>=0 ";
			$recherche[]=$crit['sodium'];
		}

		$nbResults = 0;

		if(!($req === $basereq)){
			$ifex = $this->db->query($req." limit $limit offset $offset",$recherche);
			$nbResults = $this->db->query(str_replace($basereq, "select count(*) from openfoodfacts._produit left outer join openfoodfacts._ingredienttexte on _produit.id_produit = _ingredienttexte.id_produit where ", $req), $recherche)->result_array()[0]['count'];
		}else{
			$ifex = $this->db->query("select id_produit, product_name, brands from openfoodfacts._produit limit $limit offset $offset;");
			$nbResults = $this->countAll();
		}

		return ['nbResults' => $nbResults, 'results' => $ifex->result_array()];
	}

	public function	getAll($offset, $limit) {
		return $this->db->query("select id_produit, product_name, brands from openfoodfacts._produit limit $limit offset $offset;")->result_array();
	}

	public function getOneByID($id_produit) {
		$result = [
			'product' => $this->db->query("select _produit.*, _ingredienttexte.ingredient_text from openfoodfacts._produit left outer join openfoodfacts._ingredienttexte on _produit.id_produit = _ingredienttexte.id_produit where _produit.id_produit = '$id_produit';")->row_array(),
			'countries' => array_column($this->db->query("select pays from openfoodfacts._payscommercialiseproduit where id_produit = '$id_produit';")->result_array(), 'pays'),
			'ingredients' => array_column($this->db->query("select ingredients_text from openfoodfacts._ingredientcontenusproduit where id_produit = '$id_produit'")->result_array(), 'ingredients_text'),
			'additifs' => $this->db->query("select id_additif, nom from openfoodfacts._additif natural join openfoodfacts._additifcontenus where id_produit = '$id_produit';")->result_array(),
			'ref' => $this->db->query("select url, nom as nom_reference from openfoodfacts._reference where id_reference = '$id_produit';")->result_array()
		];

		function getIngredientsOfIngredient($db, $ingredient) {
			return array_column($db->query("select ingredients_contenu from openfoodfacts._ingredientcontenusingredient where ingredients_contenant = '$ingredient';")->result_array(), 'ingredients_contenu');
		}

		function recupererArbreIngredient($db, $ingredient) {
			$result = [$ingredient, []];

			foreach (getIngredientsOfIngredient($db, $ingredient) as $ing) {
				$result[1][] = recupererArbreIngredient($db, $ing);
			}

			return $result;
		}

		$arbre = [];

		$ingredients = $result['ingredients'];

		foreach ($ingredients as $ingredient) {
			$arbre[] = recupererArbreIngredient($this->db, $ingredient);
		}

		$result['ingredients'] = $arbre;

		return $result;
	}

	public function countAll() {
		return $this->db->query("select count(*) from openfoodfacts._produit;")->result_array()[0]['count'];
	}
}
