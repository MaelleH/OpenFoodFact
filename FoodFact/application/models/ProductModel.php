<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class productModel extends CI_Model {
	public function rechercher($crit) {
		$this->load->database();
		$req = "select * from openfoodfacts._produit where ";
		$recherche = [];
		
		if(isset($crit['code'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."id_produit=? ";
			$recherche[]=$crit['code'];
		}		
			
		if(isset($crit['nom'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."product_name=? ";
			$recherche[]=$crit['nom'];
		}
		
		if(isset($crit['marque'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."brands=? ";
			$recherche[]=$crit['marque'];
		}
		
		if(isset($crit['pays'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."countries_fr=? ";
			$recherche[]=$crit['pays'];
		}
		
		
		/*if(isset($crit['ingredientsAvoir'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."=? ";
			$recherche[]=$crit['ingredientsAvoir'];
		}*/
		/*if(isset($crit['additifsAvoir'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."=? ";
			$recherche[]=$crit['additifsAvoir'];
		}*/		
		/*if(isset($crit['ingredientsSupprime'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."=? ";
			$recherche[]=$crit['ingredientsSupprime'];
		}*/
		/*if(isset($crit['additifsSupprime'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."=? ";
			$recherche[]=$crit['additifsSupprime'];
		}*/
		
		
		
		if(isset($crit['nutriScore'])){
			if(!($crit['nutriScore']=='')){
				if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
				}
				$req=$req."nutrition_grade_fr=? ";
				$recherche[]=$crit['nutriScore'];
			}	
		}
		if(isset($crit['energie'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."energy_100g<=? ";
			$recherche[]=$crit['energie'];
		}
		if(isset($crit['matieresGrasses'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."fat_100g<=? ";
			$recherche[]=$crit['matieresGrasses'];
		}
		if(isset($crit['matieresGrassesSaturees'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."satured_fat_100g<=? ";
			$recherche[]=$crit['matieresGrassesSaturees'];
		}
		if(isset($crit['carbo'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."carbohydrates_100g<=? ";
			$recherche[]=$crit['carbo'];
		}
		if(isset($crit['fibresAlimentaires'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."fibers_100g<=? ";
			$recherche[]=$crit['fibresAlimentaires'];
		}
		if(isset($crit['sucres'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."sugars_100g<=? ";
			$recherche[]=$crit['sucres'];
		}
		if(isset($crit['proteines'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."proteins_100g<=? ";
			$recherche[]=$crit['proteines'];
		}
		if(isset($crit['sel'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."salt_100g<=? ";
			$recherche[]=$crit['sel'];
		}
		if(isset($crit['vitamineA'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."vitamin_a_100g>=0 ";
			$recherche[]=$crit['vitamineA'];
		}		
		if(isset($crit['vitamineC'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."vitamin_c_100g>=0 ";
			$recherche[]=$crit['vitamineC'];
		}
		if(isset($crit['sodium'])){
			if(!($req === "select * from openfoodfacts._produit where ")){
				$req = $req."and ";
			}
			$req=$req."sodium_100g>=0 ";
			$recherche[]=$crit['sodium'];
		}
		if(!($req === "select * from openfoodfacts._produit where ")){
			$ifex = $this->db->query($req."limit 1",$recherche);
		}else{
			$ifex = $this->db->query("select * from openfoodfacts._produit");
		}
		
		return $ifex->row_array();
	}
	
}
