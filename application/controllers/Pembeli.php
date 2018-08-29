<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->model('Pembeli_model');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('pembeli/index');
	}

	public function post($slug)
	{
		$where = array('slug_nama_produk' => $slug);
		$data = $this->Pembeli_model->GetWhere('produk', $where);
		$data = array('data' => $data);
		$this->load->view('pembeli/post', $data);
	}

	public function tambahkeranjang()
	{
		$this->form_validation->set_rules('qty', 'Jumlah Pesanan', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_message('required', 'Mohon Maaf! <b>%s</b> Masih Kosong');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('pembeli/post'));
		}
		else
		{
			$data = array(
				'nama_produk' => $this->input->post('nama_produk'),
				'harga' => $this->input->post('harga'),
				'qty' => $this->input->post('qty'),
				'total_harga' => $this->input->post('harga') * $this->input->post('qty'),
				'user' => $this->session->userdata('username'),
			);
			$data = $this->Pembeli_model->Insert('keranjang', $data);
		}
	}
}
