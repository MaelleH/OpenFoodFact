<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>OpenFoodFacts - Ajout d’un produit</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<?php echo link_tag('assets/css/main.css'); ?>
	<?php echo link_tag('assets/css/nutri.css'); ?>
</head>
<body>
<div class="container">
	<?php echo validation_errors(); ?>
	<?php echo form_open('produits/ajout'); ?>
		<div class="row">
			<div class="col">
				<h1>Caractéristiques</h1>
				<table class="table table-striped">
					<tbody>
						<tr>
							<th scope="row">Nom</th>
							<td><input class="form-control" type="text" name="nom" value="<?php echo set_value('nom'); ?>"/></td>
						</tr>
						<tr>
							<th scope="row">Marque</th>
							<td><input class="form-control" type="text" name="marque" list="liste_marque" value="<?php echo set_value('marque'); ?>"/></td>
						</tr>
						<tr>
							<th scope="row">Pays</th>
							<td>
								<button type="button" class="btn btn-success mb-2" onclick="ajouterInputPays()">Ajouter un pays</button>
								<div id="pays">
								</div></td>
						</tr>
						<tr>
							<th scope="row">Portion</th>
							<td><input class="form-control" type="text" name="portion" value="<?php echo set_value('portion'); ?>"/></td>
						</tr>
					</tbody>
				</table>

				<h1>Composition</h1>
				<h2>Additifs</h2>
				<button type="button" class="btn btn-success mb-2" onclick="ajouterInputAdditif()">Ajouter un additif</button>
				<div id="additifs">
				</div>
				<h2>Ingrédients</h2>
				<button type="button" class="btn btn-success mb-2" onclick="ajouterIngredient('')">Ajouter un ingrédient</button>
				<ul id="liste" class="list-without-dots"></ul>
			</div>
			<div class="col">
				<h1>Informations nutritionnelles</h1>

				<table class="table table-striped">
					<tbody>
						<tr>
							<th scope="row">NutriScore</th>
							<td>
								<select id="nutriGrade" name="nutriGrade" class="custom-select">
									<option selected="selected">Pas de NutriScore</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
									<option value="E">E</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row">Énergie</th>
							<td><input class="form-control" type="number" name="energie" value="<?php echo set_value('energie'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Graisse</th>
							<td><input class="form-control" type="number" name="matieresGrasses" value="<?php echo set_value('matieresGrasses'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Graisse saturées</th>
							<td><input class="form-control" type="number" name="matieresGrassesSaturees" value="<?php echo set_value('matieresGrassesSaturees'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Graisse transformées</th>
							<td><input class="form-control" type="number" name="matieresGrassesTransformees" value="<?php echo set_value('matieresGrassesTransformees'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Choléstérol</th>
							<td><input class="form-control" type="number" name="cholesterol" value="<?php echo set_value('cholesterol'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Carbohydrates</th>
							<td><input class="form-control" type="number" name="carbo" value="<?php echo set_value('carbo'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Sucres</th>
							<td><input class="form-control" type="number" name="sucres" value="<?php echo set_value('sucres'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Fibres</th>
							<td><input class="form-control" type="number" name="fibresAlimentaires" value="<?php echo set_value('fibresAlimentaires'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Protéines</th>
							<td><input class="form-control" type="number" name="proteines" value="<?php echo set_value('proteines'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Sel</th>
							<td><input class="form-control" type="number" name="sel" value="<?php echo set_value('sel'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Sodium</th>
							<td><input class="form-control" type="number" name="sodium" value="<?php echo set_value('sodium'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Vitamine A</th>
							<td><input class="form-control" type="number" name="vitamineA" value="<?php echo set_value('vitamineA'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Vitamine C</th>
							<td><input class="form-control" type="number" name="vitamineC" value="<?php echo set_value('vitamineC'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Calcium</th>
							<td><input class="form-control" type="number" name="calcium" value="<?php echo set_value('calcium'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Fer</th>
							<td><input class="form-control" type="number" name="fer" value="<?php echo set_value('fer'); ?>"></input></td>
						</tr>
						<tr>
							<th scope="row">Score nutritif</th>
							<td><input class="form-control" type="number" name="scoreNutritif" value="<?php echo set_value('scoreNutritif'); ?>"></input></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<input class="btn btn-success" type="submit" id="Submit" value="Valider">
	</form>
	<?php echo form_open('produits') ?>
		<input class="btn btn-danger" type="submit" id="Cancel" value="Annuler">
	</form>
</div>

<datalist id="liste_marque">
	<?php foreach($listeMarque as $marque) : ?>
		<option><?php echo $marque['nom'] ?></option>
	<?php endforeach;?>        
</datalist>  

<datalist id="liste_pays">
	<?php foreach($listePays as $pays) : ?>
		<option><?php echo $pays['nom'] ?></option>
	<?php endforeach;?>        
</datalist>

<datalist id="ingredients">
	<option value="Blackberry">Blackberry</option>
	<option value="Blackcurrant">Blackcurrant</option>
	<option value="Blueberry">Blueberry</option>
</datalist>

<script>
	function ajouterIngredient(idActuel) {
		var liste = document.getElementById('liste' + idActuel);
		var id = liste.childNodes.length + '';
		if (idActuel !== '') {
			id = idActuel + '_' + id;
		}
		var ingredient = document.createElement('li');
		ingredient.id = 'ingredient' + id;
		ingredient.innerHTML = '<div class="row"><div class="col-5"><input class="form-control" type="text" id="ingredient" list="ingredients" name="ingredients[' + id.replace(/_/g, '][') + ']"></div><div class="col-7"><button type="button" class="btn btn-danger" onclick="enleverIngredient(\'' + id + '\')">−</button><button type="button" class="btn btn-success ml-2" onclick="ajouterIngredient(\'' + id + '\')">+</button></div></div><ul class="list-without-dots" id="liste' + id +'"</ul>';
		document.getElementById('liste' + idActuel).appendChild(ingredient);
	}

	function enleverIngredient(id) {
		document.getElementById('ingredient' + id).remove();
	}

	function ajouterInputAdditif() {
		var c = document.getElementById('additifs');
		if (c.lastElementChild == null || c.lastElementChild.firstChild == null || c.lastElementChild.firstChild.value !== '') {
			var div = document.createElement('div');
			div.className = "form-group";
			var input = document.createElement('input');
			input.type = 'text';
			input.name = 'additifs[]';
			input.className = 'form-control';
			input.onchange = function () {
				if (this.value === '') {
					this.parentElement.remove();
				}
			};
			div.appendChild(input);
			c.appendChild(div);
		} else {
			alert('Veuillez remplir le champ actuel avant d’en ajouter un autre !');
		}
	}

	function ajouterInputPays() {
		var c = document.getElementById('pays');
		if (c.lastElementChild == null || c.lastElementChild.firstChild == null || c.lastElementChild.firstChild.value !== '') {
			var div = document.createElement('div');
			div.className = "form-group";
			var input = document.createElement('input');
			input.type = 'text';
			input.name = 'pays[]';
			input.list = "liste_pays";
			input.className = 'form-control';
			input.onchange = function () {
				if (this.value === '') {
					this.parentElement.remove();
				}
			};
			div.appendChild(input);
			c.appendChild(div);
		} else {
			alert('Veuillez remplir le champ actuel avant d’en ajouter un autre !');
		}
	}
</script>
</body>
</html>
