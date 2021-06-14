<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Kasir Toko | <?= $title ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
    
    <!-- Our Custom CSS -->
    <link rel=" stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome JS -->
    <script defer src="<?= base_url() ?>/assets/js/solid.js"></script>
    <script defer src="<?= base_url() ?>/assets/js/fontawesome.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-3.6.0.min.js"></script>

    <!-- <script src="http"></script> -->
    <script href="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/dataTables/datatables.min.css"/>
    
</head>

<body>

    <div class=" wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header" >
                <!-- <div class="d-flex justify-content-center"> -->
                <div class="row">
                    <div class="col-4">
                        <!-- menampilakan ava berdasar role -->
                        <?php if($role == "Admin") { ?>
                            <img width='70px' src='<?= base_url() ?>/assets/img/ava/ava-admin.png'>
                        <?php } elseif($role == "Staff Gudang") { ?>
                            <img width='70px' src='<?= base_url() ?>/assets/img/ava/ava-staffgudang.png'>
                        <?php } elseif($role == "Pegawai Kasir") { ?>
                            <img width='70px' src='<?= base_url() ?>/assets/img/ava/ava-pegawaikasir.png'>
                        <?php } ?>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <h5 id="btn-cari"><?= $nama ?></h5>
                        </div>
                        <div class="row" style="margin-top : -10px; color: #3C378F; font-style: italic">
                            <?= $role ?>
                        </div>
                    </div>

                </div>
            </div>
        <div class="menu-height">
            <ul class="list-unstyled components menuset" >
                
                <!-- Transaksi -->
                <?php if($role=="Admin" || $role=="Pegawai Kasir") { ?>
                    <li class="<?php if (
                        $title == 'Transaksi' ||
                        $title == 'List Transaksi'
                        ) {
                            echo 'active';
                        } ?>">
                        <a href="#transaksiSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <img src="<?= base_url() ?>/assets/img/icons/Handshake.png">
                            Transaksi</a>
                        <ul class="collapse list-unstyled" id="transaksiSubmenu">
                            <li class="<?php if ($title == 'Transaksi') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/transaksi"> 
                                <i class="fa fa-dollar-sign " aria-hidden="true"></i> Transaksi</a>
                            </li>
                            <li class="<?php if ($title == 'List Transaksi') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/transaksi/listtransaksi">
                                <i class="fa fa-list " aria-hidden="true"></i> List Transaksi</a>
                            </li>
                        </ul>
                    </li>
                <?php }; ?> 
                <!-- Barang -->
                <?php if($role=="Admin" || $role=="Staff Gudang") { ?>
                    <li class="<?php if (
                        $title == 'Barang' ||
                        $title == 'Kategori' ||
                        $title == 'Satuan' ||
                        $title == 'Stok Masuk' ||
                        $title == 'Stok Keluar' 

                        ) {
                            echo 'active';
                        } ?>">
                        <a href="#barangSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <img src="<?= base_url() ?>/assets/img/icons/Package.png">
                            Barang</a>
                        <ul class="collapse list-unstyled" id="barangSubmenu">
                            <li class="<?php if ($title == 'Barang') {
                                echo 'active';
                            } ?> ">
                            
                                <a href="<?= base_url() ?>/barang">
                                <i class="fa fa-list " aria-hidden="true"></i> List Barang</a>
                            </li>
                            <li class="<?php if ($title == 'Kategori') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/kategori">
                                <i class="fa fa-chess " aria-hidden="true"></i> Kategori</a>
                            </li>
                            <li class="<?php if ($title == 'Satuan') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/satuan">
                                <i class="fa fa-cube " aria-hidden="true"></i> Satuan</a>
                            </li>
                            <li class="<?php if ($title == 'Stok Masuk') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/stokmasuk">
                                <i class="fa fa-download " aria-hidden="true"></i> Stok Masuk</a>
                            </li>
                            <li class="<?php if ($title == 'Stok Keluar') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/stokkeluar">
                                <i class="fa fa-upload" aria-hidden="true"></i> Stok Keluar</a>
                            </li>
                        </ul>
                    </li>
                <?php }; ?> 
                <!-- Pemasok -->
                <?php if($role=="Admin" || $role=="Staff Gudang") { ?>
                    <li class="<?php if (
                        $title == 'Supplier' ||
                        $title == 'Perusahaan'
                        ) {
                            echo 'active';
                        } ?>">
                        <a href="#pemasokSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <img src="<?= base_url() ?>/assets/img/icons/Truck.png">
                            Pemasok</a>
                        <ul class="collapse list-unstyled" id="pemasokSubmenu">
                            <li class="<?php if ($title == 'Supplier') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/supplier">
                                <i class="fa fa-people-carry " aria-hidden="true"></i> Data Supplier</a>
                            </li>
                            <li class="<?php if ($title == 'Perusahaan') {
                                echo 'active';
                            } ?> ">
                                <a href="<?= base_url() ?>/perusahaan">
                                <i class="fa fa-building" aria-hidden="true"></i> Data Perusahaan</a>
                            </li>
                        </ul>
                    </li>
                <?php }; ?> 
                <?php if($role=="Admin") { ?>
                
                    <li class="<?php if ($title == 'Pegawai') {
                        echo 'active';
                    } ?> ">
                        <a href="<?= base_url() ?>/pegawai">
                            <img src="<?= base_url() ?>/assets/img/icons/Users.png">
                            Pegawai</a>
                    </li>
                <?php }; ?>    
                <?php if($role=="Admin" || $role=="Pegawai Kasir" ) { ?>

                    <li class="<?php if ($title == 'Laporan') {
                    echo 'active';
                    } ?> ">
                        <a href="<?= base_url() ?>/laporan">
                            <img src="<?= base_url() ?>/assets/img/icons/Note.png">
                            Laporan</a>
                    </li>
                <?php }; ?>    
            </ul>
        </div>
            <ul class="list-unstyled components menuset">
                <li>
                    <button onclick="window.location.href='<?= base_url() ?>/login/logout'"
                        class="btn ml-4 btn-sm btn-logout">
                        <img src="<?= base_url() ?>/assets/img/icons/SignOut.png">
                        logout</button>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <!-- <nav class="navbar navbar-lg "> -->
            <div class="d-flex justify-content-start align-items-center">
                <div class="container ml-3">
                    <div class="row mb-4">

                        <button type="button" id="sidebarCollapse" class="btn">
                            <i class="fas fa-align-left"></i>
                            Toggle Sidebar
                        </button>
                        <div class="directory">
                            <a href="<?= base_url() ?>/dashboard/">Home > </a>
                            <a style="<?php if (isset($subtitle)) {
                            } else {
                              echo 'color : #6C63FF';
                            } ?>" href="<?= base_url() ?>/<?= $title ?>"> <?= $title ?>
                                <?php if (isset($subtitle)) {
                                  echo '> ';
                                } ?>
                            </a>
                            <a href="" style="color: #6C63FF;"> <?php if (
                              isset($subtitle)
                            ) {
                              echo $subtitle;
                            } ?> </a>

                        </div>
                    </div>
                </div>
            </div>




            <?= $this->renderSection('content') ?>

            <!-- FOOTER -->
        </div>
    </div>
    </div>
    </div>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.slim.min.js"> </script>
    <!-- Popper.JS -->
    <script src="<?= base_url() ?>/assets/js//popper.min.js"> </script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"> </script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="<?= base_url() ?>/assets/js/jquery.mCustomScrollbar.concat.min.js"> </script>
    <!-- Data Tables -->    
    <script type="text/javascript" src="<?= base_url() ?>/assets/dataTables/datatables.min.js"></script>

    <script type="text/javascript">
    
// dataTables
$(document).ready( function () {
	$('#dataTables').DataTable();
} );


$(document).ready(function() {
	$("#sidebar").mCustomScrollbar({
		theme: "minimal"
	});

	$('#sidebarCollapse').on('click', function() {
		$('#sidebar, #content').toggleClass('active');
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
	});
});


// pindah tab pane
$(document).ready(function(){
    activaTab('v-pills-password');
});

function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

// show/hide password
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#showPassword a").on('click', function(event) {
        event.preventDefault();
        if($('#showPassword input').attr("type") == "text"){
            $('#showPassword input').attr('type', 'password');
            $('#showPassword i').addClass( "fa-eye-slash" );
            $('#showPassword i').removeClass( "fa-eye" );
        }else if($('#showPassword input').attr("type") == "password"){
            $('#showPassword input').attr('type', 'text');
            $('#showPassword i').removeClass( "fa-eye-slash" );
            $('#showPassword i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#show_hide_konfirmasipassword a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_konfirmasipassword input').attr("type") == "text"){
            $('#show_hide_konfirmasipassword input').attr('type', 'password');
            $('#show_hide_konfirmasipassword i').addClass( "fa-eye-slash" );
            $('#show_hide_konfirmasipassword i').removeClass( "fa-eye" );
        }else if($('#show_hide_konfirmasipassword input').attr("type") == "password"){
            $('#show_hide_konfirmasipassword input').attr('type', 'text');
            $('#show_hide_konfirmasipassword i').removeClass( "fa-eye-slash" );
            $('#show_hide_konfirmasipassword i').addClass( "fa-eye" );
        }
    });
});


// menentukan field harga dari pilihan barang
var basePrice = 0;

$(".calculate").change(function() {
    newPrice = basePrice;
    $(".calculate option:selected").each(function() {
        newPrice += $(this).data('price')
    });
    $("#harga").val(newPrice.toFixed(2));
    $("#jumlah_barang").val(0);
    $("#jumlah").val(0);
    $("#total_harga").val(0);
    $("#harga_total").val(0);
});


// total harga
calculate = function (a, p, t) {
        var amount = document.getElementById(a).value;
        var price = document.getElementById(p).value;
        document.getElementById(t).value = parseInt(amount)*parseInt(price);}

// total harga
calculateKembalian = function (a, p, t) {
        var total = document.getElementById(a).value;
        var bayar = document.getElementById(p).value;
        document.getElementById(t).value = parseInt(bayar)-parseInt(total);}


</script>





</body>

</html>