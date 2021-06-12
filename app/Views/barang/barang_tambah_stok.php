<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">


    <div class="row mt-5">
        <div class="col-8 mx-auto">
            <form action="<?= base_url() ?>/barang/barang_stok_save/<?= $barang['id_barang'] ?>" method="post">
                <h3 class="mb-5">Form Tambah stok : </h3>

               <?= csrf_field() ?>
                <!-- id_barang -->
                <input type="hidden" class="form-control rad-30" id="id_barang" name="id_barang" value="<?= $barang['id_barang'] ?>"  >
                <!-- id_katehgori -->
                <input type="hidden" class="form-control rad-30" id="id_kategori" name="id_kategori" value="<?= $barang['id_kategori'] ?>"  >
                <!-- nama_barang -->
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-3 col-form-label">nama barang</label>
                    <div class="col-sm">
                      <input type="text" disabled class="form-control rad-30"  placeholder="<?= $barang['nama'];?>"  >
                      <input type="hidden" class="form-control rad-30" id="nama_barang" name="nama_barang"  value="<?= $barang['nama'];?>"  >
                    </div>

                </div>

                <div class="form-group row">
                    <!-- stok -->
                    <label for="stok" class="col-sm-3 col-form-label">stok</label>
                    <div class="col-sm-3">
                      <input type="number" class="form-control rad-30 <?= ($validation->hasError('stok')) ? 'is-invalid' : '' ?>" id="stok" name="stok" placeholder="stok"  value="<?= old('stok') ? old('stok')  : '' ?>" autofocus oninput="calculate('harga', 'stok', 'harga_total')" >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('stok')); ?>
                      </div>
                    </div>
                    <!-- id_satuan -->
                    <label for="id_satuan" class="col-sm-2 col-form-label">satuan</label>
                    <div class="col-sm-4">
                      <input type="text" disabled class="form-control rad-30"  
                      value="<?php foreach ($satuan as $b) {
                        if ($barang['id_satuan'] == $b['id_satuan']){
                          $id_satuan = $b['id_satuan'];
                          echo $b['nama'];
                        }  
                      }
                      ?>" 
                      autofocus >
                      <input type="hidden" id="id_satuan" name="id_satuan" value="<?= $id_satuan;?>">
                      
                    </div>

                </div>
                <!-- harga jual-->
                <div class="form-group row">
                    <label for="harga" class="col-sm-3 col-form-label">harga jual </label>
                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control rad-30 <?= ($validation->hasError('harga')) ? 'is-invalid' : '' ?>" value="<?= $barang['harga'];?>" >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('harga')); ?>
                      </div>
                    </div>

                </div>
                <!-- harga beli-->
                <div class="form-group row">
                    <label for="harga" class="col-sm-3 col-form-label">harga beli </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga"   placeholder="contoh: 15000" oninput="calculate('harga', 'stok', 'harga_total')" >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('harga')); ?>
                      </div>
                    </div>

                </div>

                <!-- harga_total -->
                <div class="form-group row">
                    <label for="harga_total" class="col-sm-3 col-form-label">harga total </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control rad-30 <?= ($validation->hasError('harga_total')) ? 'is-invalid' : '' ?>" id="harga_total" name="harga_total" placeholder="0"  >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('harga_total')); ?>
                      </div>
                    </div>

                </div>

                <!-- id_supplier -->
                <div class="form-group row">
                        <label for="id_supplier" class="col-sm-3 col-form-label">supplier</label>
                        <div class="col-sm-9">
                          <!-- selection option untuk memilih jenis supplier -->
                          <select class="form-control rad-30 <?= ($validation->hasError('id_supplier')) ? 'is-invalid' : '' ?>" id="id_supplier" name="id_supplier">
                          <option value=0>--- pilih supplier ---</option>
                          <!-- perulangan untuk menampilkan data supplier yang telah terdaftar -->
                          <?php $i = 1; foreach ($supplier as $b) { ?>
                              <option 
                              <?php if (old('id_supplier')) {
                                  // jika ada old kategori
                                  if ((old('id_supplier')) == $b['id_supplier']){
                                      echo "selected";
                                  }
                              }
                              ?>
                              value="<?= $b['id_supplier'] ?>"><?= $b['nama'] ?>
                              <?php foreach($perusahaan as $c) {
                                if ($b['id_perusahaan'] == $c['id_perusahaan']){
                                  echo " (".$c['nama'].")";
                                }
                              } ?>
                              </option>
                          <?php  $i++;}?>
                          <input type="text" hidden>
                          <div class="invalid-feedback">
                              <?= ($validation->getError('id_supplier')); ?>
                          </div>

                          </select>
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






<?= $this->endSection('content') ?>