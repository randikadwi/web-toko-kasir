<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?> 

      <div class="container">
          
          <!-- ADD & SEARCH -->
          <div class="d-flex bd-highlight mb-3 sticky-top sticky-content">
            <div>
              <h1 class="text-center" > <?= $title; ?> | </h1>  
              <input type="hidden" id="pages" value="<?= $title; ?>">
            </div>
            <div class="mr-auto p-2 bd-highlight">
            <button class="btn-add btn">
                <a role="button" href="<?= base_url();?>/barang"> 
                <i class="fa fa-plus-circle " aria-hidden="true"></i> Tambah</a>
              </button>
              <button class="btn-success btn rad-30">
                <a role="button"  target="_blank" href="<?= base_url();?>/stokmasuk/cetak_xls">
                <i class="fa fa-file-excel " aria-hidden="true"></i> export excel </a>
              </button>
              
            </div>
          </div>

          <!-- END OF ADD & SEARCH -->

          <!-- FLASH DATA -->
          <?php if (session()->getFlashdata('pesan')) : ?>
            <div id="alertsuccess" class="alert alert-success" role="alert">
              <i class="fa fa-check-circle " aria-hidden="true"></i>
              <?= session()->getFlashdata('pesan'); ?>
            </div>
          <?php endif; ?>
          
          

        <div id="container" style="font-size: 14px;">
            
          <!-- TABLE -->
          <div class="table-round table-sm  p-3 pt-5 pb-5">
            <table class="table pb-5 table-hover table-borderless table-striped" id="dataTables" >
              <thead>
                <tr class="mid">
                  <th scope="col">#</th>
                  <th scope="col">barang</th>
                  <th scope="col">kategori</th>
                  <th scope="col">harga</th>
                  <th scope="col">jumlah</th>
                  <th scope="col">satuan</th>
                  <th scope="col">harga total</th>
                  <th scope="col">Supplier</th>
                  <th scope="col">updator</th>
                  <th scope="col">tanggal masuk</th>
                  <th  class="text-center" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody class="">

              <?php $i = 1; foreach($stokmasuk as $a) { ?>
                <tr class="mid text-center">
                  <th scope="row"><?= $i++?></th>
                  <th style="text-align: left;"><?= $a['nama_barang'] ?></th>
                  <td>
                    <?php foreach ($kategori as $b) {
                      if ($a['id_kategori'] == $b['id_kategori']){
                        echo $b['nama'];
                      }  
                    }
                    ?> 
                  </td>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($a['harga'],0,".",".") ?> </td>
                  <td><?= $a['jumlah'] ?> </td>
                  <td>
                    <?php foreach ($satuan as $b) {
                      if ($a['id_satuan'] == $b['id_satuan']){
                        echo $b['nama'];
                      }  
                    }
                    ?> 
                  </td>
                  <td style="text-align: right;"><?php  echo "Rp. ".number_format($a['harga_total'],0,".",".") ?> </td>
                  <td>
                    <?php foreach ($supplier as $b) {
                      if ($a['id_supplier'] == $b['id_supplier']){
                        echo $b['nama'];
                      }  
                    }
                    ?> 
                  </td>
                  <td><?= $a['updator'] ?> </td>
                  <td><?= $a['created_at'] ?> </td>
                  <td class="text-center">
                    <button type="button" class="btn my-1 rad-20 btn-danger btn-sm" data-toggle="modal" data-target="#deleteData<?= $a['id_stok_masuk']; ?>">
                    <i class="fa fa-trash-alt" aria-hidden="true"></i> hapus</button>
                  </td>
                </tr>
                    <!-- MODAL Delete DATA -->
                    
                    <div class="modal fade" id="deleteData<?= $a['id_stok_masuk']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content rad-30">
                        
                          <!-- Modal Header -->
                          <div class="modal-header modal-header-custom ">
                            <h4 class="modal-title mx-auto">Hapus</h4>
                          </div>
                          
                          <!-- Modal body -->
                          <div class="container my-5 px-5">
                            <div class="row text-center">
                              <h5>Apakah anda yakin ingin menghapus stokmasuk dengan id <?= $a['id_stok_masuk']; ?>?</h5>
                            </div>
                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <div class="mx-auto ">
                              
                            <form action="<?= base_url(); ?>/stokmasuk/stokmasuk_delete/<?= $a['id_stok_masuk']; ?>" method="post" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-modal rad-20 btn-primary mr-3" style="color: white;" 
                              >Ya</button>                      
                            </form>
                            <button type="button" class="btn btn-modal rad-30 btn-outline-primary ml-3 " data-dismiss="modal">Batal</button>
                            </div>
                            <!-- <button type="button" class="btn btn-sm btn-outline-warning" data-dismiss="modal">Close</button> -->
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <!-- END OF MODAL -->
                    
                  
              <?php }; ?>

              </tbody>
            </table>
            
          </div>
          <!-- END OF TABLE -->
          
        </div>
      </div> 
      <!-- END OF CONTAINER -->




<?= $this->endSection('content'); ?>
