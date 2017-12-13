<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function afficherIngredients($ingredients) {
	echo '<ul>';
	foreach ($ingredients as $ingredient) {
		echo '<li>' . $ingredient[0];
		afficherIngredients($ingredient[1]);
		echo '</li>';
	}
	echo '</ul>';
}

?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
	<?php echo link_tag('style.css'); ?>
    <title>Rechercher</title>
</head>
<body>
<header>
    <h1>Fiche du produit : <?php echo $product_name; ?></h1>
</header>
<main>
    <fieldset>
        <legend>Caractéristiques</legend>
        <label>Code : <?php echo $id_produit; ?></label>
        <label>Nom : <?php echo $product_name; ?></label>
        <label>Marque : <?php echo $brands ?? 'inconnu'; ?></label>
        <label>Portion : <?php echo $serving_size ?? 'inconnu'; ?></label>
        <label>Pays (<?php echo sizeof($countries); ?>) : <?php echo join(', ', $countries); ?></label>
    </fieldset>
    <fieldset>
        <legend>Composition</legend>
        <label>Ingrédients :</label>
		<?php if (isset($ingredient_text)): ?>
            <pre><?php echo $ingredient_text; ?></pre>
		<?php elseif (isset($ingredients)): ?>
			<?php afficherIngredients($ingredients); ?>
		<?php else: ?>
            <pre>Non renseignés</pre>
		<?php endif; ?>
        <label>Additifs :</label>
		<?php if (isset($additifs)): ?>
            <ul>
				<?php foreach ($additifs as $additif): ?>
                    <li><strong><?php echo $additif['id_additif']; ?></strong> - <?php echo $additif['nom']; ?></li>
				<?php endforeach; ?>
            </ul>
		<?php else: ?>
            <pre>Sans</pre>
		<?php endif; ?>
    </fieldset>
    <fieldset>
        <legend>Informations nutritionnelles</legend>
        <label for="nutriScore">NutriScore : <?php echo $nutrition_grade_fr ?? 'inconnu' ?></label>
        <label for="energie">Énergie : <?php echo $energy_100g ?? 'inconnu' ?></label>
        <label for="matieresGrasses">Matières grasses : <?php echo $fat_100g ?? 'inconnu' ?></label>
        <label for="matieresGrassesSaturees">Matières grasses Saturées
            : <?php echo $satured_fat_100g ?? 'inconnu' ?></label>
        <label for="matieresGrassesTrans">Matières grasses trans : <?php echo $trans_fat_100g ?? 'inconnu' ?></label>
        <label for="chlolesterol">Cholesterol : <?php echo $cholesterol_100g ?? 'inconnu' ?></label>
        <label for="carbohydrates">Carbohydrates : <?php echo $carbohydrates_100g ?? 'inconnu' ?></label>
        <label for="sucres">Sucres : <?php echo $sugars_100g ?? 'inconnu' ?></label>
        <label for="fibresAlimentaires">fibres Alimentaires max : <?php echo $fibers_100g ?? 'inconnu' ?></label>
        <label for="proteines">Protéines max : <?php echo $proteins_100g ?? 'inconnu' ?></label>
        <label for="sel">Sel max : <?php echo $salt_100g ?? 'inconnu' ?></label>
        <label for="sodium">Sodium : <?php echo $sodium_100g ?? 'inconnu' ?></label>
        <label for="vitamineA">Vitamine A : <?php echo $vitamin_a_100g ?? 'inconnu' ?></label>
        <label for="vitamineC">Vitamine C : <?php echo $vitamin_c_100g ?? 'inconnu' ?></label>
        <label for="calcium">Calcium : <?php echo $calcium_100g ?? 'inconnu' ?></label>
        <label for="iron">Fer : <?php echo $iron_100g ?? 'inconnu' ?></label>
        <label for="scorenutritif">Score nutritif : <?php echo $nutrition_score_fr_100g ?? 'inconnu' ?></label>
    </fieldset>
    <fieldset>
        <legend>Informations supplémentaires</legend>
		<?php if (isset($nom_reference)): ?>
            <label>Importé par <a href="<?php echo $url; ?>"><?php echo $nom_reference; ?></a></label>
		<?php endif; ?>
        <label>Date de création : <?php echo $created_t; ?></label>
        <label>Date de dernière modification : <?php echo $last_modified_t; ?></label>
    </fieldset>
</main>
</body>
</html>

