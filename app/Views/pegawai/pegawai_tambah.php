<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">


    <div class="row mt-5">
        <div class="col-8 mx-auto">
            <form action="<?= base_url() ?>/pegawai/pegawai_save" method="post">
                <h3 class="mb-5">Form Tambah Pegawai : </h3>

                <?= csrf_field() ?>
                <!-- id pegawai auto generate -->
                <input type="hidden" class="form-control rad-30" id="id_pegawai" name="id_pegawai">
                <!-- username -->
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control rad-30 <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="username"  value="<?= old('username') ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('username') ?>
                        </div>
                    </div>
                </div>
                <!-- password -->
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">password</label>
                    <div class="col" id="show_hide_password">
                        <input type="password" class="form-control rad-30 <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="password" value="<?= old('password') ?>">
                        <div class="invalid-feedback rad-30">
                            <?= $validation->getError('password') ?>
                        </div>
                        <small id="passwordHelpInline" class="text-muted">
                            <a href=""><i class="fa fa-eye " aria-hidden="true"></i> show/hide</a>
                        </small>
                        
                    </div>
                    
                </div>
                <!-- role -->
                <div class="form-group row ">
                <label for="nama" class=" col-sm-2 col-form-label">role</label>
                  <div class="pl-3 pt-1">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" <?= (old('role') == 1 ) ? 'checked' : '' ?> type="radio" name="role" id="inlineRadio1" value="1" required="">
                        <label class="form-check-label" for="inlineRadio1">admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" <?= (old('role') == 2 ) ? 'checked' : '' ?> type="radio" name="role" id="inlineRadio2" value="2" required="">
                        <label class="form-check-label" for="inlineRadio2">Pegawai Kasir</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" <?= (old('role') == 3 ) ? 'checked' : '' ?> type="radio" name="role" id="inlineRadio3" value="3" required="">
                        <label class="form-check-label" for="inlineRadio3">Staff Gudang</label>
                    </div>
                  </div>
                </div>
                <!-- nama -->
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">nama</label>
                    <div class="col-sm-10">
                        <input type="nama" class="form-control rad-30 <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="nama" value="<?= old('nama') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama') ?>
                        </div>
                    </div>
                </div>
                <!-- alamat -->
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                    <div class="col-sm-10">
                        <input type="alamat" class="form-control rad-30 <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="alamat" value="<?= old('alamat') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat') ?>
                        </div>
                    </div>
                </div>

                <!-- no_telp -->
                <div class="form-group row">
                    <label for="no_telp" class="col-sm-2 col-form-label">no telp</label>
                    <div class="col-sm-10">
                        <input type="no_telp" class="form-control rad-30 <?= $validation->hasError('no_telp') ? 'is-invalid' : '' ?>" id="no_telp" name="no_telp" placeholder="no telp" value="<?= old('no_telp') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp') ?>
                        </div>
                    </div>
                </div>
                
                <!-- button -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn rad-20 btn-primary btn-modal">Submit</button>
                    </div>
                </div>

            </form>
        </div>

    </div>


</div>
<!-- end container -->






<?= $this->endSection('content') ?>