<div class="top-header">
    
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(''); ?>">Go-Shopping</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url(''); ?>">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('produk'); ?>">Produk</a>
                </li>
            </ul>

            <ul class="navbar-nav mx-auto">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-dark my-2 my-sm-0 text-white" type="submit">Search</button>
                </form>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href='<?php echo base_url('keranjang'); ?>'>Keranjang <i class='fa fa-shopping-cart'></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=''><i class='fa fa-user'></i></a>
                </li>
            </ul>
        </div>
    </div>  
</nav>