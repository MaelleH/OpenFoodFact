<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->library('session');
		$this->load->library('form_validation');

		$this->load->helper('url');
		$this->load->helper('html');

		$this->load->model('productModel');
	}

	public function index($page = 1) {
		$limit = 10;

		$data['produits'] = $this->productModel->getAll($page * $limit - $limit, $limit);

		$this->load->library('pagination');

		$config['base_url'] = base_url() . '/index.php/produits/index/';

		$config['uri_segment'] = 3;

		$config['total_rows'] = $this->productModel->countAll();
		$config['per_page'] = $limit;

		$config['first_link'] = 'Début';
		$config['last_link'] = 'Fin';

		$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);

		$data['title'] = 'OpenFoodFacts';

		$this->load->vars($data);
		$this->load->view('afficher_liste');
	}

	public function consulter($id_produit = -1) {
		if ($id_produit == -1) {
			show_404();
		}

		$produit = $this->productModel->getOneByID($id_produit);


		if (empty($produit['product'])) {
			show_404();
		}

		$data = $produit['product'];
		$data['countries'] = $produit['countries'];

		if (!empty($produit['ingredients'])) {
			$data['ingredients'] = $produit['ingredients'];
		}

		if (!empty($produit['additifs'])) {
			$data['additifs'] = $produit['additifs'];
		}

		if (!empty($produit['ref'])) {
			$data['nom_reference'] = $produit['ref'][0]['nom_reference'];
			$data['url'] = $produit['ref'][0]['url'];
		}

		$this->load->vars($data);
		$this->load->view('produit');
	}

	public function rechercher() {
		$this->load->view('rechercher');
	}

	public function ajout() {
		$this->form_validation->set_rules('nom', 'Nom', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['listeAdd'] = $this->productModel->listeAdd();
			$data['listePays'] = $this->productModel->listePays();
			$data['listeIng'] = $this->productModel->listeIng();
			$data['listeMarque'] = $this->productModel->listeMarque();

			$this->load->view('ajouter_produit', $data);
		} else {
			$produit = [
				'nom' => $this->input->post('nom'),
				'marque' => $this->input->post('marque'),
				'portion' => $this->input->post('portion'),
				'nutriGrade' => $this->input->post('nutriGrade'),
				'energie' => $this->input->post('energie'),
				'matieresGrasses' => $this->input->post('matieresGrasses'),
				'matieresGrassesSaturees' => $this->input->post('matieresGrassesSaturees'),
				'matieresGrassesTransformees' => $this->input->post('matieresGrassesTransformees'),
				'cholesterol' => $this->input->post('cholesterol'),
				'carbo' => $this->input->post('carbo'),
				'fibresAlimentaires' => $this->input->post('fibresAlimentaires'),
				'sucres' => $this->input->post('sucres'),
				'proteines' => $this->input->post('proteines'),
				'sel' => $this->input->post('sel'),
				'vitamineA' => $this->input->post('vitamineA'),
				'vitamineC' => $this->input->post('vitamineC'),
				'calcium' => $this->input->post('calcium'),
				'scoreNutritif' => $this->input->post('scoreNutritif'),
				'fer' => $this->input->post('fer'),
				'sodium' => $this->input->post('sodium')
			];

			$pays = (array)$this->input->post('pays');
			$additifsBrut = (array)$this->input->post('additifs');
			$additifs = [];
			foreach ($additifsBrut as $additif) {
				$additif = explode(" - ", $additif);
				$additifs[] = ['id_additif' => $additif[0], 'nom' => $additif[1]];
			}
			$ingredients = (array)$this->input->post('ingredients');

			$id_produit = $this->productModel->ajoutProduit($produit, $pays, $additifs, $ingredients);
			redirect('/produits/consulter/' . $id_produit);
		}
	}

	public function modifier($id_produit = -1) {
		if ($id_produit == -1) {
			show_404();
		}

		$produit = $this->productModel->getOneByID($id_produit);


		if (empty($produit['product'])) {
			show_404();
		}

		$this->form_validation->set_rules('nom', 'Nom', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = $produit['product'];

			$data['listeAdd'] = $this->productModel->listeAdd();
			$data['listePays'] = $this->productModel->listePays();
			$data['listeIng'] = $this->productModel->listeIng();
			$data['listeMarque'] = $this->productModel->listeMarque();

			$data['countries'] = $produit['countries'];

			if (!empty($produit['ingredients'])) {
				$data['ingredients'] = $produit['ingredients'];
			}

			if (!empty($produit['additifs'])) {
				$data['additifs'] = $produit['additifs'];
			}

			if (!empty($produit['ref'])) {
				$data['nom_reference'] = $produit['ref'][0]['nom_reference'];
				$data['url'] = $produit['ref'][0]['url'];
			}

			$this->load->view('modifier_produit', $data);
		} else {
			$produit = [
				'nom' => $this->input->post('nom'),
				'marque' => $this->input->post('marque'),
				'portion' => $this->input->post('portion'),
				'nutriGrade' => $this->input->post('nutriGrade'),
				'energie' => $this->input->post('energie'),
				'matieresGrasses' => $this->input->post('matieresGrasses'),
				'matieresGrassesSaturees' => $this->input->post('matieresGrassesSaturees'),
				'matieresGrassesTransformees' => $this->input->post('matieresGrassesTransformees'),
				'cholesterol' => $this->input->post('cholesterol'),
				'carbo' => $this->input->post('carbo'),
				'fibresAlimentaires' => $this->input->post('fibresAlimentaires'),
				'sucres' => $this->input->post('sucres'),
				'proteines' => $this->input->post('proteines'),
				'sel' => $this->input->post('sel'),
				'vitamineA' => $this->input->post('vitamineA'),
				'vitamineC' => $this->input->post('vitamineC'),
				'calcium' => $this->input->post('calcium'),
				'scoreNutritif' => $this->input->post('scoreNutritif'),
				'fer' => $this->input->post('fer'),
				'sodium' => $this->input->post('sodium')
			];

			$pays = (array)$this->input->post('pays');
			$additifsBrut = (array)$this->input->post('additifs');
			$additifs = [];
			foreach ($additifsBrut as $additif) {
				$additif = explode(" - ", $additif);
				$additifs[] = ['id_additif' => $additif[0], 'nom' => $additif[1]];
			}
			$ingredients = (array)$this->input->post('ingredients');

			$this->productModel->enleverProduit($id_produit);
			$id_produit = $this->productModel->ajoutProduit($produit, $pays, $additifs, $ingredients, $id_produit);
			redirect('/produits/consulter/' . $id_produit);
		}
	}

	public function ajout_ingredients() {
		$this->load->view('ajouter_produit_ingredients');
	}

	public function resultats($page = 1) {
		$limit = 10;

		$crit = [];

		if (isset($_POST['code'])) { // si c’est une nouvelle recherche (formulaire envoyé)
			if ($_POST['code'] != NULL) {
				$crit['code'] = $_POST['code'];
			}
			if ($_POST['nom'] != NULL) {
				$crit['nom'] = $_POST['nom'];
			}
			if ($_POST['marque'] != NULL) {
				$crit['marque'] = $_POST['marque'];
			}
			if ($_POST['pays'] != NULL) {
				$crit['pays'] = $_POST['pays'];
			}
			if (isset($_POST['additifs'])) {
				$arr = array_filter($_POST['additifs']);
				if (!empty($arr)) {
					$crit['additifsAvoir'] = $arr;
				}
			}
			if ($_POST['ingredients'] != NULL) {
				$crit['ingredients'] = $_POST['ingredients'];
			}
			if (isset($_POST['additifsS'])) {
				$arr = array_filter($_POST['additifsS']);
				if (!empty($arr)) {
					$crit['additifsSupprime'] = $arr;
				}
			}
			if ($_POST['nutriScore'] != NULL) {
				$crit['nutriScore'] = $_POST['nutriScore'];
			}
			if ($_POST['energie'] != NULL) {
				$crit['energie'] = $_POST['energie'];
			}
			if ($_POST['matieresGrasses'] != NULL) {
				$crit['matieresGrasses'] = $_POST['matieresGrasses'];
			}
			if ($_POST['matieresGrassesSaturees'] != NULL) {
				$crit['matieresGrassesSaturees'] = $_POST['matieresGrassesSaturees'];
			}
			if ($_POST['carbo'] != NULL) {
				$crit['carbo'] = $_POST['carbo'];
			}
			if ($_POST['fibresAlimentaires'] != NULL) {
				$crit['fibresAlimentaires'] = $_POST['fibresAlimentaires'];
			}
			if ($_POST['sucres'] != NULL) {
				$crit['sucres'] = $_POST['sucres'];
			}
			if ($_POST['proteines'] != NULL) {
				$crit['proteines'] = $_POST['proteines'];
			}
			if ($_POST['sel'] != NULL) {
				$crit['sel'] = $_POST['sel'];
			}
			if (isset($_POST['vitamineA'])) {
				$crit['vitamineA'] = $_POST['vitamineA'];
			}
			if (isset($_POST['vitamineC'])) {
				$crit['vitamineC'] = $_POST['vitamineC'];
			}
			if (isset($_POST['sodium'])) {
				$crit['sodium'] = $_POST['sodium'];
			}

			$_SESSION['crit'] = $crit; // on sauvegarde les critères au cas où l’utilisateur change de page dans la recherche (si trop de résultats)
		} else if (isset($_SESSION['crit'])) {
			$crit = $_SESSION['crit']; // on restore les critères de la recherche actuelle
		}

		$resultats = $this->productModel->rechercher($crit, $page * $limit - $limit, $limit);

		$data['produits'] = $resultats['results'];

		// PAGINATION


		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'index.php/produits/resultats/';

		$config['uri_segment'] = 3;

		$config['total_rows'] = $resultats['nbResults'];
		$config['per_page'] = $limit;

		$config['first_link'] = 'Début';
		$config['last_link'] = 'Fin';

		$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);


		// FIN PAGINATION


		if (!empty($data['produits'])) {
			$data['title'] = 'Résultats de la recherche';
			$this->load->vars($data);
			$this->load->view('afficher_liste');
		} else {
			$data['pasTrouve'] = "Le produit recherché n'existe pas dans notre base de données";
			$this->load->view('rechercher', $data);
		}
	}
}
