<!DOCTYPE html>
<html>
<head>
  <title><?php echo SITE_NAME .": ". ucfirst($this->uri->segment(1)) ." - ". ucfirst($this->uri->segment(2)) ?></title>
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
        <a href="<?php echo base_url('admin/user/tambah'); ?>" class="btn btn-primary">Tambah User</a>
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
                <h3 class="box-title">Daftar User</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <?php
              if($this->session->flashdata('success')):
                echo '<p class="alert alert-success">' . $this->session->flashdata('success') . '</p>';
              endif;
              ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th width="2">#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Level</th>
                          <th width="75"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $row): ?>
                        <tr>
                          <td> <?php echo $row['id']; ?> </td>
                          <td> <?php echo $row['username']; ?> </td>
                          <td> <?php echo $row['email']; ?> </td>
                          <td> <?php echo $row['password']; ?> </td>
                          <td> 
                            <?php
                            if($row['level'] == 'Admin'):
                                echo '<span class="label label-info">'.$row['level'].'</span>';
                            endif;
                            if($row['level'] == 'Pembeli'):
                                echo '<span class="label label-primary">'.$row['level'].'</span>';
                            endif;
                            ?>
                          </td>
                          <td> 
                            <a href="<?php echo base_url('admin/user/edituser/').$row['id']; ?>" class="label label-success"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="<?php echo base_url('admin/user/hapususer/').$row['id']; ?>" class="label label-danger"><i class="fa fa-fw fa-close"></i></a>
                          </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th width="2">#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Level</th>
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
<?php $this->load->view('admin/library/js'); ?>
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
