<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row d-flex justify-content-center" >
        <div class="mt-5 center mx-auto">
        <h1 class="pb-5 d-flex justify-content-center"> <?= "",$role; ?> </h1>
            <?php if($role == "Admin") { ?>
                <img width="70%" class="offset-2 " src="<?= base_url() ?>/assets/img/bg-admin.png">
            <?php } elseif($role == "Pegawai Kasir") { ?>
                <img width="65%" class="offset-2" src="<?= base_url() ?>/assets/img/bg-kasir.svg">
            <?php } elseif($role == "Staff Gudang") {  ?>
                <img  width="70%" class="offset-2" src="<?= base_url() ?>/assets/img/bg-gudang.svg">
            <?php  } ?>
            
        <img width="100%" style="position: absolute; bottom:0px; right: 0px; z-index: -30;"
            src="<?= base_url() ?>/assets/img/shadow1.svg">
    </div>

</div>



<?= $this->endSection() ?>