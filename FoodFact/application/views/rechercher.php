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
    <h1>Rechercher un Produit</h1>
</header>
<main>
	<?php echo validation_errors(); ?>
	<?php echo form_open('produits/resultats') ?>
    <fieldset>
		<?php echo $pasTrouve ?? ''; ?>
        <legend>Caractéristiques</legend>
        <label for="code">Code :</label> <input type="text" name="code" autofocus/><br/>
        <label for="nom">Nom :</label> <input type="text" name="nom"/><br/>
        <label for="marque">Marque :</label> <input type="text" name="marque"/><br/>
        <label for="pays">Pays :</label> <input type="text" name="pays"/><br/>
    </fieldset>
    <fieldset>
        <legend>Composition</legend>
        <label for="ingredients">Contient le texte : </label> <input type="text" name="ingredients"/><br/>
        <label for="additifs">Contient les additifs suivants : </label>
        <div id="additifs">
        </div>
        <button type="button" onclick="ajouterInputContientAdditif();">Ajouter un champ</button>
        <br/>
        <label for="additifsS">Ne contient pas les additifs suivants : </label>
        <div id="additifsS">
        </div>
        <button type="button" onclick="ajouterInputNeContientPasAdditif();">Ajouter un champ</button>
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
        <label for="energie">Énergie max: </label><input type="text" name="energie"/><br/>
        <label for="matieresGrasses">Matières grasses max : </label><input type="text" name="matieresGrasses"/><br/>
        <label for="matieresGrassesSaturees">Matières grasses Saturées max : </label><input type="text"
                                                                                            name="matieresGrassesSaturees"/><br/>
        <label for="carbo">Carbohydrates max : </label><input type="text" name="carbo"/><br/>
        <label for="fibresAlimentaires">fibres Alimentaires max : </label><input type="text" name="fibresAlimentaires"/><br/>
        <label for="sucres">Sucres max : </label><input type="text" name="sucres"/><br/>
        <label for="proteines">Protéines max : </label><input type="text" name="proteines"/><br/>
        <label for="sel">Sel max : </label><input type="text" name="sel"/><br/>
        <input type="checkbox" name="vitamineA"/><label for="vitamineA">Vitamine A </label>
        <input type="checkbox" name="vitamineC"/><label for="vitamineC">Vitamine C </label>
        <input type="checkbox" name="sodium"/><label for="sodium">Sodium </label>
    </fieldset>
    <input type="submit" name="Submit" value="Valider">
    </form>
	<?php echo form_open('produits') ?>
    <input type="submit" name="Cancel" value="Annuler">
    </form>
</main>
<script>
    function ajouterInputContientAdditif() {
        var c = document.getElementById('additifs');
        if (c.lastElementChild == null || c.lastElementChild.value !== '') {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'additifs[]';
            input.onchange = function () {
                if (this.value === '') {
                    c.removeChild(this);
                }
            };
            c.appendChild(input);
        } else {
            alert('Veuillez remplir le champ actuel avant d’en ajouter un autre !');
        }
    }

    function ajouterInputNeContientPasAdditif() {
        var c = document.getElementById('additifsS');
        if (c.lastElementChild == null || c.lastElementChild.value !== '') {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'additifsS[]';
            input.onchange = function () {
                if (this.value === '') {
                    c.removeChild(this);
                }
            };
            c.appendChild(input);
         } else {
            alert('Veuillez remplir le champ actuel avant d’en ajouter un autre !');
        }
    }
</script>
</body>
</html>
