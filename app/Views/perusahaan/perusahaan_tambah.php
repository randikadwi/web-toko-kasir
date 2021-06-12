<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?> 

      <div class="container">
        
          
        <div class="row mt-5">
            <div class="col-8 mx-auto">
                <form action="<?= base_url();?>/perusahaan/perusahaan_save" method="post">
                  <h3 class="mb-5">Form Tambah Perusahaan : </h3>

                  <?= csrf_field(); ?>
                  <!-- id_perusahaan -->
                  <div class="form-group row">
                    <label for="id_perusahaan" class="col-sm-3 col-form-label">id perusahaan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30" value="<?php echo("#P00"); echo ($last_id);?>" placeholder="id perusahaan" readonly>
                      <input type="hidden" class="form-control rad-30" id="id_perusahaan" name="id_perusahaan" placeholder="id perusahaan" readonly>

                    </div>
                  </div>
                  <!-- nama -->
                  <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="nama" value="<?= old('nama');?>" autofocus >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('nama')); ?>
                      </div>
                    </div>
                  </div>                  
                  <!-- alamat -->
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">alamat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="alamat" value="<?= old('alamat');?>" autofocus >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('alamat')); ?>
                      </div>
                    </div>
                  </div>
                  <!-- email -->
                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">email</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="email" value="<?= old('email');?>" autofocus >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('email')); ?>
                      </div>
                    </div>
                  </div>
                  <!-- no_telp -->
                  <div class="form-group row">
                    <label for="no_telp" class="col-sm-3 col-form-label">no telepon</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('no_telp')) ? 'is-invalid' : '' ?>" id="no_telp" name="no_telp" placeholder="no telp" value="<?= old('no_telp');?>" autofocus >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('no_telp')); ?>
                      </div>
                    </div>
                  </div>
                  <!-- button -->
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                      <button type="submit" class="btn rad-20 btn-primary btn-modal">Submit</button>
                    </div>
                  </div>

                </form>
            </div>
            <!-- <div class="col-6">
              
            </div> -->
            
        </div>
        
            
      </div> 
      <!-- end container -->






<?= $this->endSection('content'); ?>