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
				$recherche[]=strtolower($crit['nutriScore']);
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
			$req=$req."vitamin_a_100g>0 ";
			$recherche[]=$crit['vitamineA'];
		}
		if(isset($crit['vitamineC'])){
			if(!($req === $basereq)){
				$req = $req."and ";
			}
			$req=$req."vitamin_c_100g>0 ";
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
			'ingredients' => array_column($this->db->query("select id_ingredient from openfoodfacts._ingredientcontenusproduit where id_produit = '$id_produit'")->result_array(), 'id_ingredient'),
			'additifs' => $this->db->query("select id_additif, nom from openfoodfacts._additif natural join openfoodfacts._additifcontenus where id_produit = '$id_produit';")->result_array(),
			'ref' => $this->db->query("select url, nom as nom_reference from openfoodfacts._reference where id_reference = '$id_produit';")->result_array()
		];

		function getIngredientByID($db, $ingredientID) {
			return $db->query("select ingredients_text from openfoodfacts._ingredient where id_ingredient = '$ingredientID';")->row_array()['ingredients_text'];
		}

		function getIngredientsOfIngredient($db, $ingredientID) {
			return array_column($db->query("select id_ingredient_contenu from openfoodfacts._ingredientcontenusingredient where id_ingredient_contenant = '$ingredientID';")->result_array(), 'id_ingredient_contenu');
		}

		function recupererArbreIngredient($db, $ingredientID) {
			$result = [getIngredientByID($db, $ingredientID), []];

			foreach (getIngredientsOfIngredient($db, $ingredientID) as $ing) {
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

	public function ajoutProduit($crit,$pays,$addi,$ingr){
		$basereq = "insert into openfoodfacts._produit(created_t,last_modified_t,product_name,brands,serving_size,nutrition_grade_fr,energy_100g,fat_100g,satured_fat_100g,trans_fat_100g,cholesterol_100g,carbohydrates_100g,sugars_100g,fibers_100g,proteins_100g,salt_100g,sodium_100g,vitamin_a_100g,vitamin_c_100g,calcium_100g,iron_100g,nutrition_score_fr_100g) values(now(),now(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$recherche = [];
		//$recherche[]='now()'; // Le created_t
		//$recherche[]='now()'; // Le last_modified_t
		$recherche[]=$crit['nom'];
		$recherche[]=$crit['marque'];
		$recherche[]=$crit['portion'];
		$recherche[]=$crit['nutriGrade'];
		$recherche[]=$crit['energie'];
		$recherche[]=$crit['matieresGrasses'];
		$recherche[]=$crit['matieresGrassesSaturees'];
		$recherche[]=$crit['matieresGrassesTransformees'];
		$recherche[]=$crit['cholesterol'];
		$recherche[]=$crit['carbo'];
		$recherche[]=$crit['sucres'];
		$recherche[]=$crit['fibresAlimentaires'];
		$recherche[]=$crit['proteines'];
		$recherche[]=$crit['sel'];
		$recherche[]=$crit['sodium'];
		$recherche[]=$crit['vitamineA'];
		$recherche[]=$crit['vitamineC'];
		$recherche[]=$crit['calcium'];
		$recherche[]=$crit['fer'];
		$recherche[]=$crit['scoreNutritif'];

		//On vérifie que la marque existe, sinon on la créer
		if($this->db->query("select * from openfoodfacts._marque where nom=?",$crit['marque'])==NULL){
			$insertM = $this->db->query("insert into openfoodfacts._marque values(?)",$crit['marque']);
		}
		//On insert le produit

		$insertI = $this->db->query($basereq,$recherche);
		$id_produit= $this->db->query("select max(id_produit) as max from openfoodfacts._produit")->result_array;


		//On créer les nouveaux pays
		foreach ($pays as $nom) {
			if($this->db->query("select * from openfoodfacts._pays where nom=?",$nom)==NULL){
				$this->db->query("insert into openfoodfacts._pays values(?)",$nom);
			}

		//On insert les produits et le pays dans la table
			$insertP = $this->db->query("insert into openfoodfacts._payscommercialiseproduit values(?,?)",array($id_produit['max'],$nom));
		}


		//On insert les additifs dans la table
		foreach($addi as $nom){
			if($this->db->query("select * from openfoodfacts._additif where id_additif=?",$nom['id_additif'])==NULL){
				$this->db->query("insert into openfoodfacts._additif values(?,?)",array($nom));
			}
		//On insert les additifs et le produit
			$insertA = $this->db->query("insert into openfoodfacts._additif(nom) values(?)",array($nom['id_additif'],$id_produit['max']));
		}



		return $insertI && $insertP && $insertM && $insertA ;
	}
	public function listeAdd(){
		return $this->db->query("select nom from openfoodfacts._additif;")->result_array();
	}
	public function listeIng(){
		return $this->db->query("select ingredients_text from openfoodfacts._ingredient;")->result_array();
	}
	public function listePays(){
		return $this->db->query("select nom from openfoodfacts._pays;")->result_array();
	}
	public function listeMarque(){
		return $this->db->query("select nom from openfoodfacts._marque;")->result_array();
	}
}
