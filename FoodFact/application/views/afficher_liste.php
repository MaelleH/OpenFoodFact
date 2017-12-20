<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

	<?php echo link_tag('assets/css/froala_blocks.css'); ?>
    <?php echo link_tag('assets/css/main.css'); ?>
</head>
<body>
<section class="fdb-block" style="background-image: url(<?php echo base_url(); ?>/assets/imgs/alt_wide_2.svg)">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 text-left">
				<?php if (strpos(uri_string(), 'result') !== false): ?>
                    <h1>Résultats de la recherche</h1>
                    <p class="text-h3">
                        Sur cette page vous pouvez consulter les résultats de votre recherche.
                    </p>
                    <p class="mt-4">
                        <a class="btn" href="<?php echo site_url('produits/rechercher'); ?>">Rechercher</a>
                        <a class="btn btn-empty" href="<?php echo site_url(''); ?>">Retour</a>
                    </p>
				<?php else: ?>
                    <h1>Bienvenue sur OpenFoodFacts</h1>
                    <p class="text-h3">
                        OpenFoodFacts vous permet de consulter des fiches détaillées pour tous vos produits et ainsi de
                        savoir ce que vous mangez.
                    </p>
                    <p class="mt-4">
                        <a class="btn" href="<?php echo site_url('produits/rechercher'); ?>">Rechercher</a>
                    </p>
				<?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Marque</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
		<?php foreach ($produits as $produit): ?>
            <tr>
                <th scope="row"><?php echo $produit['id_produit']; ?></th>
                <td><?php echo $produit['product_name']; ?></td>
                <td><?php echo $produit['brands']; ?></td>
                <td>
                    <a href="<?php echo site_url('produits/consulter/' . $produit['id_produit']); ?>"
                       class="btn btn-primary btn-sm" role="button">Consulter</a>
                </td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>

    <nav>
		<?php echo $this->pagination->create_links(); ?>
    </nav>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</body>
</html>

