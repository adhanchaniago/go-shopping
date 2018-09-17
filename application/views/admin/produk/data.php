<!DOCTYPE html>
<html>
<head>
  <title>AdminLTE 2 | Dashboard</title>
  <?php $this->load->view('admin/library/head'); ?>
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
        <a href="<?php echo base_url('admin/produk/tambah'); ?>" class="btn btn-primary">Tambah Produk</a>
      </h1>
      <ol class="breadcrumb" style="padding: 0;">
        <li></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Produk</span>
              <span class="info-box-number"><?php $produk = $this->db->get('produk'); echo $produk->num_rows(); ?> <small> Pcs</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tersedia</span>
              <span class="info-box-number">-
                <?php
                
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tidak Tersedia</span>
              <span class="info-box-number">-</span>
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
        <div class="col-md-2">
            
        </div>

        <div class="col-md-12">
        <div class="box box-danger box-solid">
            <div class="box-header">
                <h3 class="box-title">Daftar Produk</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <?php
                if($this->session->flashdata('success'))
                {
                  echo '<p class="alert alert-success">' . $this->session->flashdata('success') . '</p>';
                }
              ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th width="2">#</th>
                          <th width="2">Gambar</th>
                          <th>Nama Produk</th>
                          <th>Harga</th>
                          <th>Kategori</th>
                          <th>Qty</th>
                          <th width="75"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($data as $row) { ?>
                        <tr>
                          <td> <?php echo $no++; ?> </td>
                          <td> <img src="<?php echo base_url('asset/img/produk/').$row['nama_file']; ?>" alt="<?php echo $row['slug_nama_produk']; ?>" width="100" height="100"> </td>
                          <td> <?php echo $row['nama_produk']; ?> </td>
                          <td> Rp. <?php $harga = $row['harga']; echo number_format($harga, 2,",","."); ?> </td>
                          <td> <?php echo $row['kategori']; ?> </td>
                          <td> <?php echo $row['qty']; ?> </td>
                          <td> 
                            <a href="<?php echo base_url('admin/produk/lihat/').$row['slug_nama_produk']; ?>" class="label label-primary"><i class="fa fa-fw fa-eye"></i></a>
                            <a href="<?php echo base_url('admin/produk/edit/').$row['slug_nama_produk']; ?>" class="label label-success"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="<?php echo base_url('admin/produk/hapus/').$row['slug_nama_produk']; ?>" class="label label-danger"><i class="fa fa-fw fa-close"></i></a>
                          </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th width="2">#</th>
                          <th width="2">Gambar</th>
                          <th>Nama Produk</th>
                          <th>Harga</th>
                          <th>Kategori</th>
                          <th>Qty</th>
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
