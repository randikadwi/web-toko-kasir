<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?> 

      <div class="container">
          
        <style>
          .d-flexbox{
            display: flex;
            flex-direction: column;
            /* justify-content: center;
            align-items: center; */
            height: 510px;
            width: 300px;
            border: 1px solid black;
            border-radius: 20px;
            padding: 20px;
          }

          .d-flexbox > .items{
            padding: 5px;
            margin: 5px;
          }
          
          p > span{
            font-weight: 600;
            color: black;
          }

          .d-flexbox-table{
            display: flex;
            flex-direction: column;
            /* height: 300px; */
            height: 300px;
            width: 600px;
            border: 1px solid black;
            border-radius: 20px;
            padding: 20px;
          }
          
          .tbody{
            display:block;
            overflow:auto;
            height:220px;
            width:100%;
          }

          .d-flexbox-table .thead tr{
            display:block;
          }

          .d-flexbox-table th{
            text-align: center;
            width: 115px;
          
          }
          .d-flexbox-table td{
            text-align: center;
            width: 108px;
          }

          .d-flexbox-table .angka{
            text-align: right;
            margin-right: 15px;
          }

          .d-flexbox-total{
            display: flex;
            flex-direction: row;
            align-items: center;
            height: 185px;
            width: 600px;
            border-radius: 20px;
          }

          .d-flexbox-total > .items{
            width: 688px;
          }
        </style>
        <!-- FLASH DATA -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div id="alertsuccess" class="alert alert-success" role="alert">
            <i class="fa fa-check-circle " aria-hidden="true"></i>
              <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('danger')) : ?>
            <div id="alertsuccess" class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle " aria-hidden="true"></i>
              <?= session()->getFlashdata('danger'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-4">
            <div class="d-flexbox mt-2">
            <div class="items">
              <div class="row">
              <h1 id="pesan"></h1>
                <div  class="col-8">id transaksi</div>
                <div class="col-4"><p> <span> #<?= $last_id; ?> </span> </p></div>
              </div>
            </div>
            <div class="items">
              <form action="<?= base_url() ?>/transaksi/tambahbarang" method="post">
                <?= csrf_field() ?>
                <input type="hidden" class="form-control rad-30" id="id_transaksi" name="id_transaksi" value="<?= $last_id; ?>">
                <div class="form-group">
                  <label for="id_barang">Nama Barang</label>
                  <!-- select option untuk jenis barang -->
                  <select class="form-control rad-30 calculate <?= ($validation->hasError('id_barang')) ? 'is-invalid' : '' ?>" id="id_barang" name="id_barang" load="calculate('harga', 'jumlah_barang', 'total_harga')" load="calculate('harga', 'jumlah_barang', 'total_harga')"  >
                    <option data-price='0' value=0>--- pilih barang ---</option>
                    <!-- perulangan untuk menampilkan data barang yang telah terdaftar -->
                    <?php $harga_barang = 0; ?>
                    <?php $i = 1; foreach ($barang as $b) { ?>
                        <option 
                        <?php 
                          
                            echo "data-price='".$b['harga']."'";
                        ?>
                        <?php if (old('id_barang')) {
                            // jika ada old barang
                            if ((old('id_barang')) == $b['id_barang']){
                                echo "selected";
                                // $harga_barang = $b['harga'];
                            }
                        }
                        ?>
                        value="<?= $b['id_barang'] ?>"><?= $b['nama'] ?><span style="color: red;"><?= " (stok ".$b['stok'].")"; ?></span></option>
                    <?php  $i++;}?>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="number" readonly class="form-control rad-30 <?= ($validation->hasError('harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga');?>" oninput="calculate('harga', 'jumlah_barang', 'total_harga')" change="calculate('harga', 'jumlah_barang', 'total_harga')">
              
                </div>
                <div class="form-group">
                  <label for="jumlah_barang">jumlah Pcs</label>
                  <input type="number" class="form-control rad-30 <?= ($validation->hasError('jumlah_barang')) ? 'is-invalid' : '' ?>" id="jumlah_barang" name="jumlah_barang" placeholder="0" value="<?= old('jumlah_barang');?>" oninput="calculate('harga', 'jumlah_barang', 'total_harga')" change="calculate('harga', 'jumlah_barang', 'total_harga')">
                  
                </div>
                <div class="form-group">
                  <label for="total_harga">Total</label>
                  <input type="number" readonly class="form-control rad-30" id="total_harga" name="total_harga" placeholder="0">
                </div>
                <div class="form-group row mt-4">
                  <div class="col-sm-12">
                      <button type="submit" id="btn-tambah" class="btn rad-30 btn-add col ">Tambahkan Barang</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- <div class="items">3</div> -->
          </div>
          </div>
          <!-- col 2 -->
          <div class="col">
            <!-- TABLE -->
            <div class="d-flexbox-table mt-2" >
              <div class="items">
                <table class="table table-sm">
                  <thead class="thead">
                    <tr>
                      <th scope="col">Nama</th>
                      <th scope="col">Harga</th>
                      <th scope="col">jumlah</th>
                      <th scope="col">total</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody class="tbody" id="target">
                      <?php foreach($temp as $a){ ?>
                        <tr>
                          <td style="text-align: left;"><small>
                          <?php foreach ($barang as $b) {
                            if ($a['id_barang'] == $b['id_barang']){
                              echo $b['nama'];
                            }  
                          }
                          ?> 
                          </small></td>
                          <td class="angka"><?= "Rp. ".$a['harga']; ?></td>
                          <td><?= $a['jumlah_barang']; ?></td>
                          <td class="angka"><?= "Rp. ".$a['total_harga']; ?></td>
                          <td>
                            <button type="button" class="btn rad-20 btn-danger btn-sm">
                              <a href="<?= base_url();?>/transaksi/hapusbarang/<?= $a['id_temp'];?>/<?= $a['id_barang'];?>">
                                <i class="fa fa-trash-alt " aria-hidden="true">
                                </i>
                              </a>
                            </button>
                          </td>
                        </tr>
                      <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <!-- END OF TABLE -->

            <!-- TOTAL -->
            <div class="d-flexbox-total mt-4">
              <div class="items row">
                <div class="col-4 my-auto">
                  <label>Total Belanja :</label>
                  <h5><?php echo "Rp.  ".number_format($total_belanja,2,',','.');?></h5>
                </div>
                <div class="col" style="border-left: 1px solid grey;">
                  <form action="<?= base_url() ?>/transaksi/bayar" method="post">
                    <input type="hidden"   class="form-control rad-30" id="total_belanja" name="total_belanja" value="<?= $total_belanja; ?>" oninput="calculateKembalian('total_belanja', 'total_bayar', 'total_kembalian')">
                    <div class="form-group row">
                      <label for="total_bayar" class="col-sm-4 col-form-label">pembayaran</label>
                      <div class="col-sm-8">
                        <input type="number"  class="form-control rad-30 <?= ($validationbayar->hasError('total_bayar')) ? 'is-invalid' : '' ?>" id="total_bayar" name="total_bayar" placeholder="0" value="<?= old('total_bayar'); ?>" oninput="calculateKembalian('total_belanja', 'total_bayar', 'total_kembalian')">
                        <div class="invalid-feedback">
                          <?= ($validation->getError('total_bayar')); ?>
                      </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="total_kembalian" class="col-sm-4 col-form-label">kembalian</label>
                      <div class="col-sm-8">
                        <input type="number" readonly class="form-control rad-30" id="total_kembalian" name="total_kembalian" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4"></div>
                      <div class="col-sm-8">
                          <button type="submit"  class="btn rad-30 btn-add ">Bayar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- END OF TOTAL -->
          </div>
        </div>
      </div> 
      
      <!-- END OF CONTAINER -->
      
<script>
  $('#alertsuccess').delay(2000).hide(500); 
</script>


<?= $this->endSection('content'); ?>
