<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/skins/_all-skins.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/custom.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <?php $this->load->view('admin/library/header'); ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php $this->load->view('admin/library/sidebar'); ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb" style="padding: 0;">
        <li></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-2">
            
        </div>

        <div class="col-md-12">
        <div class="box box-danger box-solid">
            <div class="box-header">
                <h3 class="box-title">Tambah Produk</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
              if($this->session->flashdata('success'))
              {
              ?>
                <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success'); ?>
                </div>
              <?php
              }
              ?>

              <?php        
              if($this->session->flashdata('error'))
              {
              ?>
                <div class="alert alert-danger">
                  <?php echo $this->session->flashdata('error'); ?>
                </div>
              <?php
              }
              ?>
              <div class="col-md-8">
                <?php echo form_open("admin/prosestambahproduk", array('enctype'=>'multipart/form-data')); ?>
                  <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="nama_produk" placeholder="Masukkan Nama Produk" value="<?php echo set_value('nama_produk'); ?>">
                    <?php echo form_error('nama_produk', '<p class="text-red">', '</p>'); ?>
                  </div>

                  <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" placeholder="Masukkan Harga" value="<?php echo set_value('harga'); ?>">
                    <?php echo form_error('harga', '<p class="text-red">', '</p>'); ?>
                  </div>

                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="editor1" name="deskripsi" rows="10" cols="80">
                      <?php echo set_value('deskripsi'); ?>
                    </textarea>
                    <?php echo form_error('deskripsi', '<p class="text-red">', '</p>'); ?>
                  </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control select2" name="kategori">
                  <?php $kat = $this->db->get('kategori'); $kat=$kat->result_array(); foreach($kat as $row) { ?>
                    <option value="<?php echo $row['kategori']; ?>"><?php echo $row['kategori']; ?></option>
                  <?php } ?>
                  </select>
                  <?php echo form_error('kategori', '<p class="text-red">', '</p>'); ?>
                </div>

                <div class="form-group">
                  <label>Stok</label>
                  <input type="number" class="form-control" name="stok" placeholder="Masukkan Stok Produk" value="<?php echo set_value('stok'); ?>">
                  <?php echo form_error('stok', '<p class="text-red">', '</p>'); ?>
                </div>

                <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" class="form-control" name="upload_gambar">
                  <p class="help-block">Maksimun Ukuran File 200 KB.</p>
                  <?php echo form_error('upload_gambar', '<p class="text-red">', '</p>'); ?>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-primary')); ?>
              <?php echo form_reset('reset', 'Reset', array('class' => 'btn btn-danger')); ?>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <?php $this->load->view('admin/library/footer'); ?>
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>asset/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>asset/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>asset/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>asset/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>asset/admin/dist/js/adminlte.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>asset/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>asset/admin/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>asset/admin/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url(); ?>asset/admin/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>asset/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

</body>
</html>
