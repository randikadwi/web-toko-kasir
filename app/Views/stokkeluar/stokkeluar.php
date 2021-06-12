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
                <a role="button" href="<?= base_url();?>/stokkeluar/stokkeluar_tambah"> 
                <i class="fa fa-plus-circle " aria-hidden="true"></i> Tambah stok keluar</a>
              </button>
              <button class="btn-success btn rad-30">
                <a role="button"  target="_blank" href="<?= base_url();?>/stokkeluar/cetak_xls">
                <i class="fa fa-file-excel " aria-hidden="true"></i> export excel </a>
              </button>  

            </div>
          </div>

          <!-- END OF ADD & SEARCH -->

          <!-- FLASH DATA -->
          <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
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
                  <th scope="col">nama barang</th>
                  <th scope="col">harga</th>
                  <th scope="col">jumlah</th>
                  <th scope="col">harga total</th>
                  <th scope="col">keterangan</th>
                  <th scope="col">updator</th>
                  <th scope="col">tanggal keluar</th>
                  <th  class="text-center" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody class="">

              <?php $i = 1; foreach($stokkeluar as $a) { ?>
                <tr class="mid text-center">
                  <th scope="row"><?= $i++?></th>
                  <th style="text-align: left;">
                    <?php foreach ($barang as $b) {
                      if ($a['id_barang'] == $b['id_barang']){
                        echo $b['nama'];
                      }  
                    }
                    ?> 
                  </th>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($a['harga'],0,".",".") ?> </td>
                  <td><?= $a['jumlah'] ?> </td>
                  <td style="text-align: right;"><?php  echo "Rp. ".number_format($a['harga_total'],0,".",".") ?> </td>
                  <td><?= $a['keterangan'] ?> </td>
                  <td><?= $a['updator'] ?> </td>
                  <td><?= $a['created_at'] ?> </td>
                  <td class="text-center">
                    <button type="button" class="btn rad-20 btn-danger my-1  btn-sm" data-toggle="modal" data-target="#deleteData<?= $a['id_stok_keluar']; ?>">
                    <i class="fa fa-trash-alt " aria-hidden="true"></i> hapus</button>
                  </td>
                </tr>
                    <!-- MODAL Delete DATA -->
                    
                    <div class="modal fade" id="deleteData<?= $a['id_stok_keluar']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content rad-30">
                        
                          <!-- Modal Header -->
                          <div class="modal-header modal-header-custom ">
                            <h4 class="modal-title mx-auto">Hapus</h4>
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                          </div>
                          
                          <!-- Modal body -->
                          <div class="container my-5 px-5">
                            <div class="row text-center">
                              <h5>Apakah anda yakin ingin menghapus stok keluar dengan id <?= $a['id_stok_keluar']; ?>?</h5>
                            </div>
                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <div class="mx-auto ">
                              
                            <form action="<?= base_url(); ?>/StokKeluar/stokkeluar_delete/<?= $a['id_stok_keluar']; ?>" method="post" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-modal rad-30 btn-primary mr-3" style="color: white;" 
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
