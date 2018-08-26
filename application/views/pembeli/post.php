<!DOCTYPE html>
<html lang="en">
<head>
    <title>Go Shopping</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/pembeli/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/pembeli/css/style.css">
</head>
<body>

<section class="section section-header">
    <?php $this->load->view('pembeli/library/header'); ?>
</section>

<section class="section section-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="https://www.padang.me/asset/foto_slide/hijab1.jpg" alt="Banner" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="section section-produk-terbaru">
    <div class="container">
        <h4>Produk Terbaru</h4>
        <div class="row">
            <?php 
            $this->db->from('produk');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(6);
            $produk = $this->db->get();
            $data_produk = $produk->result_array();
            foreach($data_produk as $row) {
            ?>
                <div class="col-lg-2">
                    <a href="<?php echo base_url('post/').$row['slug_nama_produk']; ?>">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="<?php echo base_url('asset/img/produk/').$row['nama_file']; ?>" alt="<?php echo $row['slug_nama_produk']; ?>">
                            <div class="card-body">
                                <h5><?php echo $row['nama_produk']; ?></h5>
                                <small><?php echo $row['harga']; ?></small>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo base_url('post/').$row['slug_nama_produk']; ?>" class="btn btn-primary btn-sm">Lihat Produk</a>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="section section-support">
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-lg-4">
					<h5>Berkualitas</h5>
                </div>

                <div class="col-lg-4">
					<h5>Berkualitas</h5>
                </div>

                <div class="col-lg-4">
					<h5>Berkualitas</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4>Go Shopping</h4>
                <ul>
                    <li><a href="">Tentang Kami</a></li>
                    <li><a href="">Tentang Kami</a></li>
                    <li><a href="">Tentang Kami</a></li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h4>Social Media</h4>
                <ul>
                    <li><a href="">Tentang Kami</a></li>
                    <li><a href="">Tentang Kami</a></li>
                    <li><a href="">Tentang Kami</a></li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h4>Newsletter</h4>
                <input type="email" name="email" class="form-control">
            </div>
        </div>
    </div>
</section>

<div class="footer">
    <div class="container text-center">
        2018 GO SHOPPING
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>asset/pembeli/js/bootstrap.min.js"></script>
</body>
</html>