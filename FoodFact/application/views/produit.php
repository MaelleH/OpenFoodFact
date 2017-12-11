<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<?php echo link_tag('style.css'); ?>
	<title>Rechercher</title>
</head>
<body>
	<header>
		<h1>Fiche du produit : <?php echo $product_name;?></h1>
	</header>
	<main>
			<fieldset>
				<legend>Caractéristiques</legend>
				<label>Code : <?php echo $id_produit ;?></label>
				<label>Nom : <?php echo $product_name;?></label>
				<label>Marque : <?php echo $brands;?></label>
				<label>Pays : <?php echo $countries_fr ?? 'inconnu';?></label>
			</fieldset>
			<fieldset>
				<legend>Composition</legend>
				<label>Ingrédients : <?php echo $ingredients?? 'inconnus'?></label>
			</fieldset>			
			<fieldset>
				<legend>Informations nutritionnelles</legend>
				<label for="nutriScore">NutriScore : <?php echo $nutrition_grade_fr?? 'inconnu'?></label>
				<label for="energie">Énergie : <?php echo $energie_100g?? 'inconnu'?></label>
				<label for="matieresGrasses">Matières grasses max : <?php echo $fat_100g?? 'inconnu'?></label>
				<label for="matieresGrassesSaturees">Matières grasses Saturées max : <?php echo $satured_fat_100g?? 'inconnu'?></label>
				<label for="gulcides">Glucides max : <?php echo $carbohydrates_100g?? 'inconnu'?></label>
				<label for="fibresAlimentaires">fibres Alimentaires max : <?php echo $fibers_100g?? 'inconnu'?></label>
				<label for="sucres">Sucres max : <?php echo $sugars_100g?? 'inconnu'?></label>
				<label for="proteines">Protéines max : <?php echo $proteins_100g?? 'inconnu'?></label>
				<label for="sel">Sel max : <?php echo $salt_100g?? 'inconnu'?></label>
				<label for="vitamineA">Vitamine A : <?php echo $vitamin_a_100g?? 'inconnu'?></label>
				<label for="vitamineC">Vitamine C : <?php echo $vitamin_c_100g?? 'inconnu'?></label>
				<label for="sodium">Sodium :  <?php echo $sodium_100g?? 'inconnu'?></label>
			</fieldset>				
	</main>
</body>
</html>

