<section class="sidebar">
      <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Alexander Pierce</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?php if ( $this->uri->uri_string() == 'admin' ){ echo 'active'; } ?>">
      <a href="<?php echo base_url('admin'); ?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>

    <li class="treeview <?php if ( $this->uri->uri_string() == 'admin/produk' ) { echo 'active'; } if ( $this->uri->uri_string() == 'admin/produk/tambah' ){ echo 'active'; }  if ( $this->uri->uri_string() == 'admin/produk/kategori' ){ echo 'active'; } ?>">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Produk</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if ( $this->uri->uri_string() == 'admin/produk' ){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/produk'); ?>"><i class="fa fa-circle-o"></i> Data</a></li>
        <li class="<?php if ( $this->uri->uri_string() == 'admin/produk/kategori' ){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/produk/kategori'); ?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
      </ul>
    </li>

    <li class="treeview <?php if ( $this->uri->uri_string() == 'admin/penjualan' ) { echo 'active'; } ?>">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Laporan</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if ( $this->uri->uri_string() == 'admin/penjualan' ){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/penjualan'); ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
      </ul>
    </li>
    
    <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
  </ul>
  
</section>