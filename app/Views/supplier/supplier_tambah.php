<!-- mengextend template layout -->
<?= $this->extend('layout/template'); ?>

<!-- section content -->
<?= $this->section('content'); ?> 

      <div class="container">
        <div class="row mt-5">
            <div class="col-8 mx-auto">
            <!-- form menambahkan data supplier -->
            <!-- digunakan untuk mengubah data nama, alamat, no_telp, id_perusahaan -->
                <form action="<?= base_url();?>/supplier/supplier_save" method="post">
                  <h3 class="mb-5">Form Tambah Supplier : </h3>

                  <?= csrf_field(); ?>
                  <!-- id_supplier -->
                  <div class="form-group row">
                    <label for="id_supplier" class="col-sm-3 col-form-label">id supplier</label>
                    <div class="col-sm">
                      <!-- id_supplier akan digenerate otomatis -->
                      <input type="text" class="form-control rad-30" value="<?php echo("#SUP00"); echo ($last_id);?>" placeholder="id supplier" readonly>
                      <input type="hidden" class="form-control rad-30" id="id_supplier" name="id_supplier" placeholder="id supplier" readonly>

                    </div>
                  </div>
                  <!-- nama -->
                  <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm">
                      <!-- field inputan nama -->
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="nama" value="<?= old('nama');?>" autofocus >
                      <!-- validasi field nama -->
                      <div class="invalid-feedback">
                        <?= ($validation->getError('nama')); ?>
                      </div>
                    </div>
                  </div>                  
                  <!-- alamat -->
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">alamat</label>
                    <div class="col-sm">
                      <!-- field inputan alamat -->
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="alamat" value="<?= old('alamat');?>" autofocus >
                      <!-- validasi field alamat -->
                      <div class="invalid-feedback">
                        <?= ($validation->getError('alamat')); ?>
                      </div>
                    </div>
                  </div>
                  <!-- no_telp -->
                  <div class="form-group row">
                    <label for="no_telp" class="col-sm-3 col-form-label">no telepon</label>
                    <div class="col-sm">
                      <!-- field inputan no_telp -->
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('no_telp')) ? 'is-invalid' : '' ?>" id="no_telp" name="no_telp" placeholder="no telp" value="<?= old('no_telp');?>" autofocus >
                      <!-- validasi field no_telp -->
                      <div class="invalid-feedback">
                        <?= ($validation->getError('no_telp')); ?>
                      </div>
                    </div>
                  </div> 

                  <!-- id_perusahaan -->
                  <div class="form-group row">
                    <label for="id_perusahaan" class="col-sm-3 col-form-label">asal perusahaan</label>
                    <div class="col-sm">
                      <!-- selection option untuk jenis perusahaan -->
                        <select class="form-control rad-30 <?= ($validation->hasError('id_perusahaan')) ? 'is-invalid' : '' ?>" id="id_perusahaan" name="id_perusahaan">
                          <option value=0>--- pilih perusahaan ---</option>
                          <!-- perulangan untuk menampilkan data perusahaan yang telah terdaftar -->
                          <?php $i = 1; foreach ($perusahaan as $b) { ?>
                              <option 
                              <?php if (old('id_perusahaan')) {
                                  // jika ada old perusahaan
                                  if ((old('id_perusahaan')) == $b['id_perusahaan']){
                                      echo "selected";
                                  }
                              }
                              ?>
                              value="<?= $b['id_perusahaan'] ?>"><?= $b['nama'] ?></option>
                          <?php  $i++;}?>
                          <input type="text" hidden>
                          <div class="invalid-feedback">
                              <?= ($validation->getError('id_perusahaan')); ?>
                          </div>
                        </select>
                    </div>
                  </div>
                  <!-- button -->
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm">
                      <button type="submit" class="btn rad-20 btn-primary btn-modal">Submit</button>
                    </div>
                  </div>

                </form>
                <!-- end of form -->
            </div>
            
        </div>
        
            
      </div> 
      <!-- end container -->






<?= $this->endSection('content'); ?>
<!-- end of content -->