<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        $this->load->model('Pembeli_model');
    }

	public function index()
	{
		$this->load->view('pembeli/index');
	}

	public function post($slug)
	{
		$slug = array('slug_nama_produk' , $slug);
		$data = $this->Pembeli_model->GetWhere('produk', $slug);
		$data = array('data' => $data);
		$this->load->view('pembeli/post', $data);
	}
}
