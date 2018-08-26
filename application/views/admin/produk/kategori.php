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
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bower_components/morris.js/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
      </h1>
      <ol class="breadcrumb" style="padding: 0;">
        <li></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kategori</span>
              <span class="info-box-number"><?php $produk = $this->db->get('kategori'); echo $produk->num_rows(); ?> <small> </small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-6">
          <div class="box box-danger box-solid">
            <div class="box-header">
              <h3 class="box-title">Tambah Kategori</h3>
            </div>

            <div class="box-body">
              <?php
              if($this->session->flashdata('success'))
              {
                echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
              }

              if($this->session->flashdata('error'))
              {
                echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
              }
              ?>
              <?php echo form_open('admin/prosestambahkategori'); ?>
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <?php $kat = array('type' => 'text', 'class' => 'form-control', 'name' => 'kategori', 'placeholder' => 'Masukkan Kategori', 'value' => set_value('kategori')); echo form_input($kat); ?>
                  </div>
                </div>

                <div class="box-footer">
                  <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-primary')); ?>
                  <?php echo form_reset('reset', 'Reset', array('class' => 'btn btn-danger')); ?>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>

        <div class="col-md-6">
        <div class="box box-danger box-solid">
            <div class="box-header">
                <h3 class="box-title">Daftar Produk</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <?php
                if($this->session->flashdata('sukses-hapus'))
                {
                  echo '<p class="alert alert-success">' . $this->session->flashdata('sukses-hapus') . '</p>';
                }
              ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th width="2">#</th>
                          <th>Kategori</th>
                          <th width="75"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($data as $row) { ?>
                        <tr>
                          <td> <?php echo $no++; ?> </td>
                          <td> <?php echo $row['kategori']; ?> </td>
                          <td> 
                            <a href="<?php echo base_url('admin/produk/editkategori/').$row['id']; ?>" class="label label-success"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="<?php echo base_url('admin/hapuskategori/').$row['id']; ?>" class="label label-danger"><i class="fa fa-fw fa-close"></i></a>
                          </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th width="2">#</th>
                          <th>Kategori</th>
                          <th width="75"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
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
<!-- DataTables -->
<script src="<?php echo base_url(); ?>asset/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
