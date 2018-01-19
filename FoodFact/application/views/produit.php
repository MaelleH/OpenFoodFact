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

function afficherAdditifs($additifs) {
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col">Code</th>';
	echo '<th scope="col">Nom</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	foreach ($additifs as $additif):
		?>
        <tr>
            <th scope="row"><?php echo $additif['id_additif']; ?></th>
            <td><?php echo $additif['nom']; ?></td>
        </tr>
	<?php
	endforeach;
	echo '</tbody>';
	echo '</table>';
}

function afficherTr($nom, $valeur) {
if (isset($valeur)) {
?>
<tr>
    <th scope="row"><?php echo $nom; ?></th>
    <td><?php echo $valeur; ?></td>
</tr>
<?php
}
}

?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>OpenFoodFacts - Fiche du produit <?php echo $product_name; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

	<?php echo link_tag('assets/css/froala_blocks.css'); ?>
	<?php echo link_tag('assets/css/main.css'); ?>
</head>
<body>
<section class="fdb-block pb-0 mb-4" style="background-image: url(<?php echo base_url(); ?>/assets/imgs/bg_1.jpg)">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-8 col-lg-6 text-center">
                <div class="fdb-box br-0">
                    <h1><?php echo $product_name; ?></h1>
                    <p class="text-h3">
                        Sur cette page vous pouvez lire la fiche détaillée du produit <?php echo $product_name; ?>.
                    </p>
                    <p class="mt-4">
                        <a class="btn" href="<?php echo site_url(''); ?>">Revenir à l’accueil</a>
                    	<a href="<?php echo site_url('produits/modifier/' . $id_produit); ?>"
                       class="btn btn-primary btn-sm" role="button">Modifier</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Caractéristiques</h1>
            <table class="table table-striped">
                <tbody>
				<?php afficherTr('Code', $id_produit); ?>
				<?php afficherTr('Nom', $product_name); ?>
				<?php afficherTr('Marque', $brands); ?>
				<?php afficherTr('Portion', $serving_size); ?>
				<?php if (sizeof($countries) > 0): ?>
					<?php afficherTr('Pays (' . sizeof($countries) . ')', join(', ', $countries)); ?>
				<?php endif; ?>
                </tbody>
            </table>

            <h1>Composition</h1>
            <h2>Ingrédients</h2>
			<?php if (isset($ingredient_text)): ?>
                <p><?php echo $ingredient_text; ?></p>
			<?php elseif (isset($ingredients)): ?>
				<?php afficherIngredients($ingredients); ?>
			<?php else: ?>
                <p>Non renseignés</p>
			<?php endif; ?>

            <h2>Additifs</h2>
			<?php if (isset($additifs)): ?>
				<?php afficherAdditifs($additifs); ?>
			<?php else: ?>
                <p>Pas d’additifs</p>
			<?php endif; ?>

            <h1>Informations supplémentaires</h1>
            <table class="table table-striped">
				<?php if (isset($nom_reference)): ?>
					<?php afficherTr('Importé de', '<a href="' . $url . '">' . $nom_reference . '</a>'); ?>
				<?php endif; ?>
				<?php afficherTr('Date de création', $created_t); ?>
				<?php afficherTr('Date de dernière modification', $last_modified_t); ?>
            </table>
        </div>
        <div class="col">
            <h1>Informations nutritionnelles</h1>

            <table class="table table-striped">
				<?php if (isset($nutrition_grade_fr)): ?>
					<?php afficherTr('NutriScore', '<img src="https://static.openfoodfacts.org/images/misc/nutriscore-' .strtolower($nutrition_grade_fr) . '.svg" class="img-fluid">'); ?>
				<?php endif; ?>
				<?php afficherTr('Énergie', $energy_100g); ?>
				<?php afficherTr('Graisse', $fat_100g); ?>
				<?php afficherTr('Graisse saturées', $satured_fat_100g); ?>
				<?php afficherTr('Graisse transformées', $trans_fat_100g); ?>
				<?php affichertr('Choléstérol', $cholesterol_100g); ?>
				<?php afficherTr('Carbohydrates', $carbohydrates_100g); ?>
				<?php afficherTr('Sucres', $sugars_100g); ?>
				<?php afficherTr('Fibres', $fibers_100g); ?>
				<?php afficherTr('Protéines', $proteins_100g); ?>
				<?php afficherTr('Sel', $salt_100g); ?>
				<?php afficherTr('Sodium', $sodium_100g); ?>
				<?php afficherTr('Vitamine A', $vitamin_a_100g); ?>
				<?php afficherTr('Vitamine C', $vitamin_c_100g); ?>
				<?php afficherTr('Calcium', $calcium_100g); ?>
				<?php afficherTr('Fer', $iron_100g); ?>
				<?php afficherTr('Score nutritif', $nutrition_score_fr_100g); ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

