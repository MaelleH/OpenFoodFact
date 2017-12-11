<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('html');
	}

	public function index() {
		parent::__construct();
		$this->load->view('home');
	}
	public function rechercher() {
		parent::__construct();
		$this->load->view('rechercher');
	}
	public function valider(){
		parent::__construct();
		$this->load->model('productModel');
		$crit=[];
		echo $_POST['nom'];
		
		if($_POST['code']!=NULL){
			$crit['code']=$_POST['code'];
		}				
		if($_POST['nom']!=NULL){
			$crit['nom']=$_POST['nom'];
		}
		if($_POST['marque']!=NULL){
			$crit['marque']=$_POST['marque'];
		}
		if($_POST['pays']!=NULL){
			$crit['pays']=$_POST['pays'];
		}
		if($_POST['ingredientsAvoir']!=NULL){
			$crit['ingredientsAvoir']=$_POST['ingredientsAvoir'];
		}
		if($_POST['additifsAvoir']!=NULL){
			$crit['additifsAvoir']=$_POST['additifsAvoir'];
		}
		if($_POST['ingrédientsSupprime']!=NULL){
			$crit['ingrédientsSupprime']=$_POST['ingrédientsSupprime'];
		}
		if($_POST['additifsSupprime']!=NULL){
			$crit['additifsSupprime']=$_POST['additifsSupprime'];
		}
		if($_POST['nutriScore']!=NULL){
			$crit['nutriScore']=$_POST['nutriScore'];
		}
		if($_POST['energie']!=NULL){
			$crit['energie']=$_POST['energie'];
		}
		if($_POST['matieresGrasses']!=NULL){
			$crit['matieresGrasses']=$_POST['matieresGrasses'];
		}
		if($_POST['matieresGrassesSaturees']!=NULL){
			$crit['matieresGrassesSaturees']=$_POST['matieresGrassesSaturees'];
		}
		if($_POST['carbo']!=NULL){
			$crit['carbo']=$_POST['carbo'];
		}
		if($_POST['fibresAlimentaires']!=NULL){
			$crit['fibresAlimentaires']=$_POST['fibresAlimentaires'];
		}
		if($_POST['sucres']!=NULL){
			$crit['sucres']=$_POST['sucres'];
		}
		if($_POST['proteines']!=NULL){
			$crit['proteines']=$_POST['proteines'];
		}
		if($_POST['sel']!=NULL){
			$crit['sel']=$_POST['sel'];
		}
		if(isset($_POST['vitamineA'])){
			$crit['vitamineA']=$_POST['vitamineA'];
		}
		if(isset($_POST['vitamineC'])){
			$crit['vitamineC']=$_POST['vitamineC'];
		}
		if(isset($_POST['sodium'])){
			$crit['sodium']=$_POST['sodium'];
		}
				
		$data=$this->productModel->rechercher($crit);
		print_r($data);
		if($data!=0){
			$this->load->view('produit',$data);
		}else{
			$data['pasTrouve']="Le produit recherché n'existe pas dans notre base de données";
			$this->load->view('rechercher',$data);
		}
		
		
	}
}
