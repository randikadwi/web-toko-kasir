<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">


    <div class="row mt-5">
        <div class="col-8 mx-auto">
            <form action="<?= base_url() ?>/stokkeluar/stokkeluar_save" method="post">
                <h3 class="mb-5">Form Tambah barang : </h3>

               <?= csrf_field() ?>
                <!-- id_barang -->
                <div class="form-group row">
                    <label for="id_barang" class="col-sm-3 col-form-label">barang</label>
                    <div class="col-sm-9">
                        <!-- selection option untuk jenis barang -->
                        <select class="form-control rad-30 calculate <?= ($validation->hasError('id_barang')) ? 'is-invalid' : '' ?>" id="id_barang" name="id_barang" oninput="calculate('harga', 'jumlah', 'harga_total')" >

                            <option data-price="0" value=0>--- pilih barang ---</option>
                            <!-- perulangan untuk menampilkan data barang yang telah terdaftar -->
                            <?php $i = 1; foreach ($barang as $b) { ?>
                                <option 
                                <?php 
                                  
                                    echo "data-price='".$b['harga']."'";
                                ?>
                                <?php if (old('id_barang')) {
                                    // jika ada old barang
                                    if ((old('id_barang')) == $b['id_barang']){
                                        echo "selected";
                                    }
                                }
                                ?>
                                value="<?= $b['id_barang'] ?>"><?= $b['nama'] ?></option>
                            <?php  $i++;}?>
                            <input type="text" hidden>
                            <div class="invalid-feedback">
                                <?= ($validation->getError('id_barang')); ?>
                            </div>
                      
                        </select>
                    </div>
                 </div>

                <!-- harga -->
                <div class="form-group row">
                    <label for="harga" class="col-sm-3 col-form-label">harga satuan</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control rad-30 <?= ($validation->hasError('harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga" placeholder="contoh: 30000" value="<?= old('harga');?>"  oninput="calculate('harga', 'jumlah', 'harga_total')" >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('harga')); ?>
                      </div>
                    </div>

                </div>
                
                <!-- jumlah -->
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-3 col-form-label">jumlah</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control rad-30 <?= ($validation->hasError('jumlah')) ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" placeholder="" value="<?= old('jumlah');?>" oninput="calculate('harga', 'jumlah', 'harga_total')" >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('jumlah')); ?>
                      </div>
                    </div>

                </div>
                
                <!-- harga_total -->
                <div class="form-group row">
                    <label for="harga_total" class="col-sm-3 col-form-label">harga total</label>
                    <div class="col-sm-9">
                      <input type="number" readonly class="form-control rad-30 <?= ($validation->hasError('harga_total')) ? 'is-invalid' : '' ?>" id="harga_total" name="harga_total" placeholder="0" >
                    </div>

                </div>

                <!-- keterangan -->
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label">keterangan</label>
                    <div class="col-sm-9">
                      <input type="text"  class="form-control rad-30 <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>" id="keterangan" name="keterangan" placeholder="ketrangan stok keluar" value="<?= old('keterangan');?>" >
                      <div class="invalid-feedback">
                        <?= ($validation->getError('keterangan')); ?>
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