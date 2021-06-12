<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">


    <div class="row mt-5">
        <div class="col-8 mx-auto">
            <form action="<?= base_url() ?>/satuan/satuan_update/<?= $satuan['id_satuan'] ?>" method="post">
                <h3 class="mb-5">Form Ubah Satuan : </h3>

                <?= csrf_field() ?>
                <!-- id_satuan -->
                <div class="form-group row">
                    <label for="id_satuan" class="col-sm-3 col-form-label">id satuan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control rad-30" value="<?php
                        echo '#S00';
                        echo $satuan['id_satuan'];
                        ?>" placeholder="id satuan" readonly>
                        <input type="hidden" class="form-control rad-30" id="id_satuan" name="id_satuan" value="<?= $satuan['id_satuan'
                        ] ?>" placeholder="id satuan" readonly>

                    </div>
                </div>
                <!-- nama -->
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control rad-30 <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="nama" value="<?= old('nama') ? old('nama')  : $satuan['nama'] ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama') ?>
                        </div>
                    </div>

                </div>
                <!-- button -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn rad-20 btn-primary btn-modal">Ubah</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- <div class="col-6">
              
            </div> -->

    </div>


</div>
<!-- end container -->






<?= $this->endSection('content') ?>