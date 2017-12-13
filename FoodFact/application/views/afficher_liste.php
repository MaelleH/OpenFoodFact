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
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-3"><?php echo $title; ?></h1>

        <hr class="my-4">

        <p class="lead">
            <a class="btn btn-primary btn-lg" role="button"
               href="<?php echo site_url('produits/rechercher'); ?>">Rechercher</a>
        </p>
    </div>

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

