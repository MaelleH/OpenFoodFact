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



</head>
<body>
	<?php echo form_open('produits/ajout') ?>
		<?php echo validation_errors(); ?>
    <fieldset>
		<?php echo $pasTrouve ?? ''; ?>
        <legend>Caractéristiques</legend>
        <label for="nom">Nom du produit:</label> <input type="text" name="nom"/><br/>
        <label for="marque">Marque :</label> <INPut type="text" name="marque"/><br/>
        <label for="pays">Pays :</label> <input type="text" name="pays"/><br/>
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
        <label for="nutriScore">NutriScore : </label><select name="nutriScore">
            <option selected="selected">
            <option>A</option>
            <option>B</option>
            <option>C</option>
            <option>D</option>
            <option>E</option>
        </select><br/>
        <label for="energie">Énergie (en kj): </label><input type="text" name="energie"/><br/>
        <label for="matieresGrasses">Matières grasses : </label><input type="text" name="matieresGrasses"/><br/>
        <label for="matieresGrassesSaturees">Matières grasses Saturées : </label><input type="text" name="matieresGrassesSaturees"/><br/>                                   
        <label for="matieresGrassesTransformees">Matières grasses transformées</label><input type="text" name="matieresGrassesTransformees"/><br/>
        <label for="cholesterol">Choléstérol : </label><input type="text" name="cholesterol"/><br/> 
        <label for="carbo">Carbohydrates : </label><input type="text" name="carbo"/><br/>
        <label for="fibresAlimentaires">fibres Alimentaires : </label><input type="text" name="fibresAlimentaires"/><br/>
        <label for="sucres">Sucres : </label><input type="text" name="sucres"/><br/>
        <label for="proteines">Protéines : </label><input type="text" name="proteines"/><br/>
        <label for="sel">Sel max : </label><input type="text" name="sel"/><br/>
        <label for="vitamineA">Vitamine A </label><input type="text" name="vitamineA"/><br/>
        <label for="vitamineC">Vitamine C </label><input type="text" name="vitamineA"/><br/>
        <label for="calcium">Calcium : </label><input type="text" name="calcium"/><br/>
        <label for="scoreNutritif">Score nutritif : </label><input type="text" name="scoreNutritif"/><br/>

        <label for="sodium">Sodium </label><input type="text" name="sodium"/><br/>
    </fieldset>
    <fieldset>
        <legend>Informations supplémentaires</legend>
		<label for="lien">Lien vers la page du produit sur le site du fabriquant </label><input type="text" name="lien"/><br/>

	</fieldset>    
    <input type="submit" name="Submit" value="Valider">
    </form>
	<?php echo form_open('produits') ?>
    <input type="submit" name="Cancel" value="Annuler">
	<ul id="ingredients">
		<li><div class="input-group"><input type="text" class="form-control" placeholder="Ingrédient"><div class="input-group-append"><button class="btn btn-outline-primary" type="button">+</button><button class="btn btn-outline-danger" type="button">-</button></li>
  </div>
</div></li>
	</ul> 
    </form>
</main>
	
	</form>
</body>
</html>
