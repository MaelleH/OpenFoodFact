<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>OpenFoodFacts</title>
	<?php //echo link_tag('assets/style/style.css'); ?>
</head>
<body>
	<header>
		<h1 id="cc" >Bienvenue sur OpenFoodFacts!</h1>
	</header>
	<main>
		<?php echo form_open('home/rechercher')?>
			<input type="submit" name="Rechercher" value="Rechercher">
		</form>
		<?php echo form_open('home/rechercher')?>
			<input type="submit" name="Rechercher" value="Rechercher">
		</form>
	</main>
</body>
</html>
