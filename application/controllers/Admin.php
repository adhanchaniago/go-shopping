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
		$this->load->view('admin/produk/data', $data);
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
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required|xss_clean');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|xss_clean');
		$this->form_validation->set_rules('qty', 'Stok', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('upload_gambar', 'Gambar', 'trim|xss_clean');
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
			$config['max_size']      = '1000';
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
					'qty' => $this->input->post('qty'),
					'waktu' => date('Y-m-d h:i:s'),
				);
				
				$insert = $this->Admin_model->Insert('produk', $insert);
				$this->session->set_flashdata('success', 'Menambah Produk <b>'. $this->input->post('nama_produk') .'</b> Berhasil!');
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
			'qty' => $data[0]['qty'],
		);
		$this->load->view('admin/produk/editproduk', $data);
	}

	public function prosesupdateproduk()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('qty', 'Qty', 'trim|required|numeric');
		$this->form_validation->set_message('required', "Maaf! Kolom <b>%s</b> tidak boleh kosong");

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/produk/editproduk');
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
				'qty' => $this->input->post('qty'),
				'waktu' => date('Y-m-d h:i:s'),
			);
			$where = array('id' => $this->input->post('id'));
			$insert = $this->Admin_model->Update('produk', $data, $where);
			
			$this->session->set_flashdata('success', 'Mengubah Produk <b>'.$this->input->post('nama_produk').'</b> Berhasil');
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

	public function kategori()
	{
		$data = $this->Admin_model->get('kategori');
		$data = array('data' => $data);
		$this->load->view('admin/produk/kategori', $data);
	}

	public function prosestambahkategori()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|xss_clean|is_unique[kategori.kategori]');
		$this->form_validation->set_message('required', 'Mohon Maaf! Kolom <b>%s</b> Tidak Boleh Kosong');
		$this->form_validation->set_message('is_unique', 'Mohon Maaf! Nama <b>'. $this->input->post('kategori') .'</b> Sudah Tersedia');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/produk/kategori'));
		}
		else
		{
			$data = array(
				'kategori' => $this->input->post('kategori'),
			);

			$data = $this->Admin_model->Insert('kategori', $data);
			$this->session->set_flashdata('success', 'Berhasil Menambahkan Kategori <b>' . $this->input->post('kategori') . '</b>' );
			redirect(base_url('admin/produk/kategori'));
		}
	}

	public function editkategori($id)
	{
		$where = array('id' => $id);
		$data = $this->Admin_model->GetWhere('kategori', $where);
		$data = array(
			'id' => $data[0]['id'],
			'kategori' => $data[0]['kategori'],
		);
		$this->load->view('admin/produk/editkategori', $data);
	}

	public function prosesupdatekategori()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|xss_clean|is_unique[kategori.kategori]');
		$this->form_validation->set_message('required', 'Mohon Maaf! Kolom <b>%s</b> Tidak Boleh Kosong');
		$this->form_validation->set_message('is_unique', 'Mohon Maaf! Nama <b>' . $this->input->post('kategori') . '</b> Sudah Tersedia');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/produk/editkategori');
		}
		else
		{
			$data = array(
				'kategori' => $this->input->post('kategori'),
			);
			$where = array('id' => $this->input->post('id'));
			$update = $this->Admin_model->Update('kategori', $data, $where);
			$this->session->set_flashdata('success', 'Mengubah Kategori <b>'.$this->input->post('kategori').'</b> Berhasil');
			redirect(base_url('admin/produk/kategori'));
		}
	}

	public function hapuskategori($id)
	{
		$id = array('id' => $id);
		$this->Admin_model->Delete('kategori', $id);
		$this->session->set_flashdata('sukses-hapus', 'Berhasil Menghapus Kategori');
		redirect(base_url('admin/produk/kategori'));
	}

	public function penjualan()
	{
		$data = $this->Admin_model->get('transaksi');
		$data = array('data' => $data);
		$this->load->view('admin/laporan/penjualan', $data);
	}

	public function editpenjualan($id)
	{
		$where = array('id' => $id);
		$data = $this->Admin_model->GetWhere('transaksi', $where);
		$data = array(
			'id' => $data[0]['id'],
			'status' => $data[0]['status'],
		);
		$this->load->view('admin/laporan/editpenjualan', $data);
	}

	public function prosesupdatepenjualan()
	{
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_message('required', 'Mohon Maaf! <b>%s</b> Tidak Boleh Kosong');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/laporan/editpenjualan');
		}
		else
		{
			$where = array('id' => $this->input->post('id'));
			$data = array(
				'status' => $this->input->post('status'),
			);	
			$update = $this->Admin_model->Update('transaksi', $data, $where);
			$this->session->set_flashdata('success', 'Berhasil Mengubah Status Menjadi <b>'.$this->input->post('status').'</b>');
			redirect(base_url('admin/penjualan'));
		}
	}

	public function date()
	{
		$date1=date_create("2013-03-15");
		$date2=date_create("2013-12-12");
		$diff=date_diff($date2,$date1);//OP: +272 days 
		echo $diff->format('%R%a days');
	}

}
