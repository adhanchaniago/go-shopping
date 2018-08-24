<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('admin/index');
	}

	public function produk()
	{
		$data = $this->Admin_model->get('produk');
		$data = array('data' => $data);
		$this->load->view('admin/produk/index', $data);
	}

	public function lihat($slug)
	{
		$where = array('slug_nama_produk' => $slug);
		$data = $this->Admin_model->GetWhere('produk', $where);
		$data = array('data' => $data);
		$this->load->view('admin/produk/lihatproduk', $data);
	}

	public function tambah()
	{
		$this->load->view('admin/produk/tambahproduk');
	}

	public function prosestambahproduk()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required|numeric');
		$this->form_validation->set_rules('upload_gambar', 'Gambar', 'trim');
		$this->form_validation->set_message('required', "Maaf! Kolom <b>%s</b> tidak boleh kosong");

		if($this->form_validation->run() == FALSE)
		{
			//$this->session->set_flashdata('error', validation_errors());
			$this->load->view('admin/produk/tambahproduk');
		}
		else
		{
			$config['upload_path']   = './asset/img/produk';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']      = '200';
			$config['remove_space']  = TRUE;

			$this->load->library('upload',$config);
			if($this->upload->do_upload("upload_gambar"))
			{
				date_default_timezone_set("Asia/Jakarta");
				$data = array('upload_data' => $this->upload->data());
				$slug = url_title($this->input->post('nama_produk'), 'dash', TRUE);

				$insert = array(
					'nama_file' => $data['upload_data']['file_name'],
					'tipe_file' => $data['upload_data']['file_type'],
					'ukuran_file' => $data['upload_data']['file_size'],
					'nama_produk' => $this->input->post('nama_produk'),
					'slug_nama_produk' => $slug,
					'harga' => $this->input->post('harga'),
					'kategori' => $this->input->post('kategori'),
					'deskripsi' => $this->input->post('deskripsi'),
					'stok' => $this->input->post('stok'),
					'waktu' => date('Y-m-d h:i:s'),
				);
				
				$insert = $this->Admin_model->Insert('produk', $insert);
				$this->session->set_flashdata('success', 'Tambah Produk Berhasil');
				redirect(base_url('admin/produk/tambahproduk'));
			}
			else
			{
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(base_url('admin/produk/tambahproduk'));
			}
		}        
	}

	public function edit($slug)
	{
		$where = array('slug_nama_produk' => $slug);
		$data = $this->Admin_model->GetWhere('produk', $where);
		$data = array(
			'id' => $data[0]['id'],
			'nama_file' => $data[0]['nama_file'],
			'nama_produk' => $data[0]['nama_produk'],
			'harga' => $data[0]['harga'],
			'kategori' => $data[0]['kategori'],
			'deskripsi' => $data[0]['deskripsi'],
			'stok' => $data[0]['stok'],
		);
		$this->load->view('admin/produk/editproduk', $data);
	}

	public function prosesupdateproduk()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required|numeric');
		$this->form_validation->set_message('required', "Maaf! Kolom <b>%s</b> tidak boleh kosong");

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/produk/tambah');
		}
		else
		{
			date_default_timezone_set("Asia/Jakarta");
			$slug = url_title($this->input->post('nama_produk'), 'dash', TRUE);

			$data = array(
				'nama_produk' => $this->input->post('nama_produk'),
				'slug_nama_produk' => $slug,
				'harga' => $this->input->post('harga'),
				'kategori' => $this->input->post('kategori'),
				'deskripsi' => $this->input->post('deskripsi'),
				'stok' => $this->input->post('stok'),
				'waktu' => date('Y-m-d h:i:s'),
			);
			$where = array('id' => $this->input->post('id'));
			$insert = $this->Admin_model->Update('produk', $data, $where);
			
			$this->session->set_flashdata('success', 'Edt Produk "'.$this->input->post('nama_produk').'" Berhasil');
			redirect(base_url('admin/produk/'));
		}
	}

	public function hapus($slug)
	{
		$slug = array('slug_nama_produk' => $slug);
		$this->Admin_model->Delete('produk', $slug);
		$this->session->set_flashdata('success', 'Berhasil Menghapus Produk');
		redirect(base_url('admin/produk'));
	}

	public function date()
	{
		$date1=date_create("2013-03-15");
		$date2=date_create("2013-12-12");
		$diff=date_diff($date2,$date1);//OP: +272 days 
		echo $diff->format('%R%a days');
	}

}
