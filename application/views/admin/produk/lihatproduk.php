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
        <a href="<?php echo base_url('admin/produk'); ?>" class="btn btn-primary">Kembali</a>
      </h1>
      <ol class="breadcrumb" style="padding: 0;">
        <!-- <li><a href="" class="btn btn-primary">Kembali</a></li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-4">
            <div class="box box-danger box-solid">
                <div class="box-header">
                    <h3 class="box-title">Gambar Produk</h3>
                </div>
                <div class="box-body">
                    <?php foreach($data as $row) { ?>
                    <img src="<?php echo base_url('asset/img/produk/').$row['nama_file']; ?>" alt="" class="img-responsive">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-danger box-solid">
            <div class="box-header">
              <h3 class="box-title">Detail Produk</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tr>
                  <th>#</th>
                  <th>Informasi</th>
                </tr>
                <tr>
                  <td>Nama Produk</td>
                  <td><?php echo $row['nama_produk']; ?></td>
                </tr>
                <tr>
                  <td>Harga Produk</td>
                  <td>Rp. <?php $harga = $row['harga']; echo number_format($harga, 2,",","."); ?></td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td><?php echo $row['kategori']; ?></td>
                </tr>
                <tr>
                  <td>Stok Produk</td>
                  <td><?php echo $row['qty']; ?></td>
                </tr>
                <tr>
                  <td>Deskripsi Produk</td>
                  <td><?php echo $row['deskripsi']; ?></td>
                </tr>
             <?php } ?>
              </table>
            </div>
            <!-- /.box-body -->
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
