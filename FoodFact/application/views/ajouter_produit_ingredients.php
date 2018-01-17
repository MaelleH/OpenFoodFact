<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>OpenFoodFacts - Fiche du produit <?php echo $product_name; ?></title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<?php echo link_tag('assets/css/main.css'); ?>
</head>
<body>
	<?php echo form_open('produits/ajout') ?>
		<?php echo validation_errors(); ?>
    <fieldset>
		<?php echo $pasTrouve ?? ''; ?>
        <legend>Caractéristiques</legend>
        <label for="nom">Nom du produit </label> <input type="text" id="nom"/><br/>
        
		<label for="marque">Marque </label><input type="text" id="marque" list="liste_marque" /><br/>
		<datalist id="liste_marque"></datalist>   
		
        <label for="pays">Pays </label> <input type="text" id="pays" list="liste_pays"/><br/>
        <datalist id="liste_pays"></datalist>
        
    </fieldset>
    <fieldset>
        <legend>Composition</legend>
        <label for="additifs">Contient les additifs suivants : </label>
        <div id="additifs">
        </div>
        <button type="button" onclick="ajouterInputContientAdditif();">Ajouter un champ</button>
        <br/>
	</fieldset>
    <fieldset>
        <legend>Informations nutritionnelles</legend>
		<label for="portion">Portion par personne </label><input type="text" id="portion"/><br/>
		<label for="nutriScore">NutriScore </label><select id="nutriScore">
            <option selected="selected">
            <option>A</option>
            <option>B</option>
            <option>C</option>
            <option>D</option>
            <option>E</option>
        </select><br/>
        <label for="nutriGrade">NutriGrade(de 1 à 16)</label><input type="text" id="nutriGrade"/><br/>
        <label for="energie">Énergie (en kj) </label><input type="text" id="energie"/><br/>
        <label for="matieresGrasses">Matières grasses </label><input type="text" id="matieresGrasses"/><br/>
        <label for="matieresGrassesSaturees">Matières grasses Saturées </label><input type="text" id="matieresGrassesSaturees"/><br/>                                   
        <label for="matieresGrassesTransformees">Matières grasses transformées</label><input type="text" id="matieresGrassesTransformees"/><br/>
        <label for="cholesterol">Choléstérol </label><input type="text" id="cholesterol"/><br/> 
        <label for="carbo">Carbohydrates </label><input type="text" id="carbo"/><br/>
        <label for="fibresAlimentaires">fibres Alimentaires </label><input type="text" id="fibresAlimentaires"/><br/>
        <label for="sucres">Sucres </label><input type="text" id="sucres"/><br/>
        <label for="proteines">Protéines </label><input type="text" id="proteines"/><br/>
        <label for="sel">Sel </label><input type="text" id="sel"/><br/>
        <label for="vitamineA">Vitamine A </label><input type="text" id="vitamineA"/><br/>
        <label for="vitamineC">Vitamine C </label><input type="text" id="vitamineA"/><br/>
        <label for="calcium">Calcium </label><input type="text" id="calcium"/><br/>
        <label for="scoreNutritif">Score nutritif </label><input type="text" id="scoreNutritif"/><br/>
        <label for="sodium">Sodium </label><input type="text" id="sodium"/><br/>
    </fieldset>
	<h2>Ingrédients</h2>
	<button type="button" class="btn btn-success" onclick="ajouterIngredient('')">Ajouter un ingrédient</button>
	<ul id="liste" class="list-without-dots"></ul>
	<datalist id="ingredients">
		<option value="Blackberry">Blackberry</option>
		<option value="Blackcurrant">Blackcurrant</option>
		<option value="Blueberry">Blueberry</option>
	</datalist>
    <fieldset>
        <legend>Informations supplémentaires</legend>
		<label for="lien">Lien vers la page du produit sur le site du fabriquant </label><input type="text" id="lien"/><br/>
	</fieldset>
    	<input type="submit" id="Submit" value="Valider">
    </form>
    
	<script>
		function ajouterIngredient(idActuel) {
			var liste = document.getElementById('liste' + idActuel);
			var id = liste.childNodes.length + '';
			if (idActuel !== '') {
				id = idActuel + '_' + id;
			}
			var ingredient = document.createElement('li');
			ingredient.id = 'ingredient' + id;
			ingredient.innerHTML = '<div class="row"><div class="col-5"><input class="form-control" type="text" id="ingredient" list="ingredients" name="ingredients[' + id.replace(/_/g, '][') + ']"></div><div class="col-7"><button type="button" class="btn btn-danger" onclick="enleverIngredient(\'' + id + '\')">Supprimer cet ingrédient</button><button type="button" class="btn btn-success ml-2" onclick="ajouterIngredient(\'' + id + '\')">Ajouter un sous-ingrédient</button></div></div><ul class="list-without-dots" id="liste' + id +'"</ul>';
			document.getElementById('liste' + idActuel).appendChild(ingredient);
		}

		function enleverIngredient(id) {
			document.getElementById('ingredient' + id).remove();
		}
	</script>
</body>
</html>
