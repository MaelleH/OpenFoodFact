<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('html');

		$this->load->model('productModel');
	}

	public function index($page = 0, $limit = 25) {
		$data['produits'] = $this->productModel->getAll($page, $limit);
	}
}
