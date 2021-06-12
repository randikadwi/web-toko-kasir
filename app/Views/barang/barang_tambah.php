<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">


    <div class="row mt-5">
        <div class="col-8 mx-auto">
            <form action="<?= base_url() ?>/barang/barang_save" method="post">
                <h3 class="mb-5">Form Tambah barang : </h3>

               <?= csrf_field() ?>
                <!-- id_barang -->
                <input type="hidden" class="form-control rad-30" id="id_barang"  name="id_barang">
                <!-- stok -->
                <input type="hidden" class="form-control rad-30" id="stok" value=0 name="stok">
                

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

                <!-- id_kategori -->
                <div class="form-group row">
                    <label for="id_kategori" class="col-sm-3 col-form-label">kategori</label>
                    <div class="col-sm-9">
                        <!-- selection option untuk jenis kategori -->
                        <select class="form-control rad-30 <?= ($validation->hasError('id_kategori')) ? 'is-invalid' : '' ?>" id="id_kategori" name="id_kategori">

                            <option value=0>--- pilih kategori ---</option>
                            <!-- perulangan untuk menampilkan data kategori yang telah terdaftar -->
                            <?php $i = 1; foreach ($kategori as $b) { ?>
                                <option 
                                <?php if (old('id_kategori')) {
                                    // jika ada old kategori
                                    if ((old('id_kategori')) == $b['id_kategori']){
                                        echo "selected";
                                    }
                                }
                                ?>
                                value="<?= $b['id_kategori'] ?>"><?= $b['nama'] ?></option>
                            <?php  $i++;}?>
                            <input type="text" hidden>
                            <div class="invalid-feedback">
                                <?= ($validation->getError('id_kategori')); ?>
                            </div>
                      
                        </select>
                    </div>
                 </div>
                
                <!-- id_satuan -->
                <div class="form-group row">
                    <label for="id_satuan" class="col-sm-3 col-form-label">satuan</label>
                    <div class="col-sm-9">
                      <!-- selection option untuk memilih jenis satuan -->
                      <select class="form-control rad-30 <?= ($validation->hasError('id_satuan')) ? 'is-invalid' : '' ?>" id="id_satuan" name="id_satuan">

                            <option value=0>--- pilih satuan ---</option>
                            <!-- perulangan untuk menampilkan data kategori yang telah terdaftar -->
                            <?php $i = 1; foreach ($satuan as $b) { ?>
                                <option 
                                <?php if (old('id_satuan')) {
                                    // jika ada old kategori
                                    if ((old('id_satuan')) == $b['id_satuan']){
                                        echo "selected";
                                    }
                                }
                                ?>
                                value="<?= $b['id_satuan'] ?>"><?= $b['nama'] ?></option>
                            <?php  $i++;}?>
                            <input type="text" hidden>
                            <div class="invalid-feedback">
                                <?= ($validation->getError('id_satuan')); ?>
                            </div>
                      
                        </select>
                    </div>
                </div>

                <!-- harga -->
                <div class="form-group row">
                    <label for="harga" class="col-sm-3 col-form-label">harga satuan</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control rad-30 <?= ($validation->hasError('harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga" placeholder="contoh: 30000" value="<?= old('harga');?>" autofocus onblur="calculate('harga', 'jumlah', 'harga_total')" >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('harga')); ?>
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






<?= $this->endSection('content') ?>