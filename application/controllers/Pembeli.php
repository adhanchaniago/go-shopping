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

	public function profil()
	{
		$this->load->view('pembeli/profil');
	}

	public function editprofil()
	{
		$this->load->view('pembeli/editprofil');
	}

	public function ubahprofil()
	{
		$this->form_validation->set_rules('passwordlama', 'Password Lama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwordbaru', 'Password Baru', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_message('required', 'Kolom <b>%s</b> Tidak Boleh Kosong');
		$this->form_validation->set_message('min_length', '<b>%s</b> Minimal 5 Karakter');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('pembeli/editprofil');
		}
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
			$session = $this->session->userdata('username');
			$nama = $this->input->post('nama_produk');
			$qty = $this->input->post('qty');
			
			$cek = $this->db->get_where('keranjang', array('nama_produk' => $nama, 'user' => $session));
			$cek = $cek->row_array();
			$cek2 = $this->db->get_where('produk', array('nama_produk' => $nama));
			$cek2 = $cek2->row_array();
			$data = array(
				'nama_produk' => $this->input->post('nama_produk'),
				'harga' => $this->input->post('harga'),
				'qty' => $this->input->post('qty'),
				'total_harga' => $this->input->post('harga') * $this->input->post('qty'),
				'user' => $this->session->userdata('username'),
			);
			if($data['nama_produk'] != $cek['nama_produk'] )
			{
				if($data['qty'] > $cek2['qty'])
				{
					$this->session->set_flashdata('gagal', 'Gagal Menambahkan <b>'. $this->input->post('nama_produk') .'</b> Karena Stok Tidak Mencukupi.'  );
					redirect(base_url('keranjang'));
				}
				else
				{
					$data = $this->Pembeli_model->Insert('keranjang', $data);
					$this->session->set_flashdata('tambah', 'Berhasil Menambahkan <b>'. $this->input->post('nama_produk') .'</b> ke dalam Keranjang.'  );
					redirect(base_url('keranjang'));
				}
			}
			else
			{
				$z = $cek['qty'];
				if($cek['user'] == NULL)
				{
					$data = $this->Pembeli_model->Insert('keranjang', $data);
					$this->session->set_flashdata('tambah', 'Berhasil Menambahkan <b>'. $this->input->post('nama_produk') .'</b> ke dalam Keranjang.'  );
					redirect(base_url('keranjang'));
				}
				else
				{
					if($z >= $cek2['qty'])
					{
						$this->session->set_flashdata('gagal', 'Gagal Update <b>'. $this->input->post('nama_produk') .'</b> ke dalam Keranjang.'  );
						redirect(base_url('keranjang'));
					}
					else
					{
						$hasil = $z+$qty; print_r($hasil);
						if($hasil > $cek2['qty'])
						{
							$this->session->set_flashdata('gagal', 'Gagal Update <b>'. $this->input->post('nama_produk') .'</b> ke dalam Keranjang.'  );
							redirect(base_url('keranjang'));
						}
						else
						{
							$query = $this->db->query("UPDATE keranjang SET qty = $z+$qty WHERE nama_produk = '$nama' AND user = '$session' ");
							$this->session->set_flashdata('update', 'Berhasil Update <b>'. $this->input->post('nama_produk') .'</b> ke dalam Keranjang.'  );
							redirect(base_url('keranjang'));
						}
					}
				}
			}
		}
	}

	public function keranjang()
	{
		$session = array('user' => $this->session->userdata('username'));
		$data = $this->Pembeli_model->GetWhere('keranjang', $session);
		$data = array('data' => $data);
		$this->load->view('pembeli/keranjang', $data);
	}

	public function hapuskeranjang($id)
	{
		$id = array('id' => $id);
		$this->Pembeli_model->Delete('keranjang', $id);
		$this->session->set_flashdata('sukses', 'Berhasil Menghapus');
		redirect(base_url('keranjang'));
	}

	public function pembayaran()
	{
		$this->load->view('pembeli/pembayaran');
	}

	public function prosespembayaran()
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kodepos', 'Kode Pos', 'trim|required|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('catatan', 'Catatan', 'trim|required|xss_clean');
		$this->form_validation->set_message('required', 'Mohon Maaf! Kolom <b>%s</b> Masih Kosong');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('pembeli/pembayaran');
		}
		else
		{
			$user = $this->input->post('user');
			$result = array();
			$total = 0;
			foreach($user as $key => $val)
			{
				$result[] = array(
					'nama_produk' => $napro = $this->input->post('nama_produk')[$key],
					'qty' => $beli = $this->input->post('qty')[$key],
					'total_harga' => $this->input->post('total_harga')[$key],
					'nama_pembeli' => $this->input->post('nama_lengkap'),
					'provinsi' => $this->input->post('provinsi'),
					'kota_kabupaten' => $this->input->post('kota-kabupaten'),
					'kecamatan' => $this->input->post('kecamatan'),
					'kodepos' => $this->input->post('kodepos'),
					'alamat' => $this->input->post('alamat'),
					'email' => $this->input->post('email'),
					'catatan' => $this->input->post('catatan'),
					'tanggal' => date('Y-m-d'),
					'user' => $this->input->post('user')[$key],
					'status' => 'Dalam Pemesanan',
				);
			}

			$data = $this->input->post();
			
			$this->db->from('produk');
			$this->db->set('nama_produk', $data['nama_produk']);
			$this->db->where_in('nama_produk', $data['nama_produk']);
			$p = $this->db->get();
			$p = $p->result();
			foreach($p as $a)
			{
				$n = $a->nama_produk;
				$s[] = $a->qty;
			}

			for($i = 0; $i < count($data['nama_produk']); $i++)
			{
				$update[] = array(
					'nama_produk' => $data['nama_produk'][$i],
					'qty' => $s[$i]-$data['qty'][$i],
				);
			}
			$this->db->where_in('nama_produk', $data['nama_produk']);
			$this->db->update_batch('produk', $update, 'nama_produk');

			$data = $this->db->insert_batch('transaksi', $result);
			$this->db->Delete('keranjang', array('user' => $this->session->userdata('username')));

			if($data)
			{
				$this->session->set_flashdata('sukses', 'Terima kasih sudah melakukan pembayaran.');
				redirect(base_url('profil'));
			}
			else
			{
				$this->session->set_flashdata('sukses', 'Terima kasih sudah melakukan pembayaran.');
				redirect(base_url('pembayaran'));
			}
		}
	}

	public function riwayat()
	{
		$data = $this->Pembeli_model->GetWhere('transaksi', array('user' => $this->session->userdata('username')));
		$data = array('data' => $data);
		$this->load->view('pembeli/riwayat', $data);
	}

	public function listkota()
	{
		// Ambil data ID Provinsi yang dikirim via ajax post
		$province_id = $this->input->post('province_id');
    
		$kota = $this->Pembeli_model->viewByProvinsi($province_id);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--- Pilih Kota/Kabupaten---</option>";
		
		foreach($kota as $data){
		  $lists .= "<option value='".$data['id']."'>".$data['name']."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}

	public function listkecamatan()
	{
		// Ambil data ID Provinsi yang dikirim via ajax post
		$regency_id = $this->input->post('regency_id');
    
		$kota = $this->Pembeli_model->viewByKota($regency_id);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>--- Pilih Kecamatan ---</option>";
		
		foreach($kota as $data){
		  $lists .= "<option value='".$data['id']."'>".$data['name']."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_kecamatan'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
}
