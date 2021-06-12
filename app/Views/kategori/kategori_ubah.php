<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?> 

      <div class="container">
        
          
        <div class="row mt-5">
            <div class="col-8 mx-auto">
                <form action="<?= base_url();?>/kategori/kategori_update/<?= $kategori['id_kategori'] ?>" method="post">
                  <h3 class="mb-5">Form Ubah kategori : </h3>

                  <?= csrf_field(); ?>
                  <!-- id_kategori -->
                  <div class="form-group row">
                    <label for="id_kategori" class="col-sm-3 col-form-label">id kategori</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30" value="<?php echo("#K00"); echo ($kategori['id_kategori']);?>" placeholder="id kategori" readonly>
                      <input type="hidden" class="form-control rad-30" id="id_kategori" name="id_kategori" value="<?= ($kategori['id_kategori']);?>"placeholder="id kategori" readonly>

                    </div>
                  </div>
                  <!-- nama -->
                  <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="nama" value="<?= (old('nama')) ? old('nama') : $kategori['nama'] ?>" autofocus >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('nama')); ?>
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






<?= $this->endSection('content'); ?>