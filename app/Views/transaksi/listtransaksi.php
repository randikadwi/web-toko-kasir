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
                <a role="button" href="<?= base_url();?>/transaksi"> 
                <i class="fa fa-plus-circle " aria-hidden="true"></i> Tambah transaksi baru</a>
              </button>
              <button class="btn-success btn rad-30">
                <a role="button"  target="_blank" href="<?= base_url();?>/transaksi/cetak_xls">
                <i class="fa fa-file-excel " aria-hidden="true"></i> export excel </a>
              </button>
              
            </div>
            <!-- <div class="p-2 bd-highlight">
              <form action="" method="get">
                <div class="input-group">
                  <input type="search" name="keyword" id="keyword" class="form-control search-field" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
                </div>
              </form>
            </div> -->
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
                  <th scope="col">total harga</th>
                  <th scope="col">total bayar</th>
                  <th scope="col">total kembalian</th>
                  <th scope="col">nama kasir</th>
                  <th scope="col">tanggal</th>
                  <th  class="text-center" scope="col" style="width: 220px;">Aksi</th>
                </tr>
              </thead>
              <tbody class="">

              <?php $i = 1; foreach($transaksi as $a) { ?>
                <tr class="mid text-center">
                  <th scope="row"><?= $i++?></th>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($a['total_harga'],0,".",".") ?> </td>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($a['total_bayar'],0,".",".") ?> </td>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($a['total_kembalian'],0,".",".") ?> </td>
                  <td><?= $a['nama_kasir'] ?> </td>
                  <td><?= $a['created_at'] ?> </td>
                  <td class="text-center">
                    <button type="button" class="btn rad-20 my-1 btn-info btn-sm" data-toggle="modal" data-target="#detailData<?= $a['id_transaksi']; ?>">
                    <i class="fa fa-info-circle " aria-hidden="true"></i> detail</button>
                    
                    <button type="button" class="btn rad-20 my-1 btn-danger btn-sm" data-toggle="modal" data-target="#deleteData<?= $a['id_transaksi']; ?>">
                    <i class="fa fa-trash-alt " aria-hidden="true"></i> hapus</button>
                  </td>
                </tr>
                    <!-- MODAL Delete DATA -->
                    
                    <div class="modal fade" id="deleteData<?= $a['id_transaksi']; ?>">
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
                              <h5>Apakah anda yakin ingin menghapus transaksi dengan id "<?= $a['id_transaksi']; ?>"?</h5>
                              
                            </div>
                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <div class="mx-auto ">
                              
                            <form action="<?= base_url(); ?>/transaksi/transaksi_delete/<?= $a['id_transaksi']; ?>" method="post" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-modal rad-20 btn-primary mr-3" style="color: white;" 
                              >Ya</button>                      
                            </form>
                            <button type="button" class="btn btn-modal rad-20 btn-danger ml-3 " data-dismiss="modal">Batal</button>
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

            
            <?php $i = 1; foreach($transaksi as $a) { ?>
            <!-- MODAL Detail DATA -->
                        
            <div class="modal fade" id="detailData<?= $a['id_transaksi']; ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content rad-30">
                
                  <!-- Modal Header -->
                  <div class="modal-header modal-header-custom ">
                    <h4 class="modal-title mx-auto">Detail Transaksi</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  </div>
                  
                  <!-- Modal body -->
                  <div class="container my-3">
                    <div class="row">
                      <div class="mx-auto">
                        <!-- TABLE -->
                        <div class="table-round-3">
                          <table class="table pb-5 table-hover table-borderless table-striped" id="dataTables" >
                            <thead>
                              <tr class="mid">
                                <th scope="col">#</th>
                                <th scope="col">nama barang</th>
                                <th scope="col">harga</th>
                                <th scope="col">jumlah barang</th>
                                <th scope="col">total</th>
                              </tr>
                            </thead>
                            <tbody class="">

                            <?php $i = 1; foreach($detail_transaksi as $b) { ?>
                              <?php if(($a['id_transaksi'])==($b['id_transaksi'])) { ?>
                              <tr class="mid text-center">
                                <th scope="row"><?= $i++?></th>
                                <td style="text-align: left;">
                                  <?php foreach ($barang as $c) {
                                    if ($b['id_barang'] == $c['id_barang']){
                                      echo $c['nama'];
                                    }  
                                  }
                                  ?> 
                                </td>
                                <td style="text-align: right;"><?php echo "Rp. ".number_format($b['harga'],0,".",".") ?> </td>
                                <td><?= $b['jumlah_barang'] ?> </td>
                                <td style="text-align: right;"><?php echo "Rp. ".number_format($b['total_harga'],0,".",".") ?> </td>
                              </tr>
                              <?php }; ?>
                            <?php }; ?>
                              <tr>
                                <th colspan="4">Total</th>
                                <th style="text-align: right;"><?php echo "Rp. ".number_format($a['total_harga'],0,".",".") ?> </th>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <div class="mx-auto ">
                    <button type="button" class="btn btn-modal rad-20 btn-success">
                    <a role="button" target="_blank" href="<?= base_url();?>/transaksi/cetak_struk/<?= $a['id_transaksi']; ?>">
                    <i class="fa fa-print " aria-hidden="true"></i> cetak </a></button>

                    <button type="button" class="btn btn-modal rad-20 btn-danger ml-3 " data-dismiss="modal">
                    <i class="fa fa-times " aria-hidden="true"></i> tutup</button>
                    </div>
                    <!-- <button type="button" class="btn btn-sm btn-outline-warning" data-dismiss="modal">Close</button> -->
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- END OF MODAL -->
            <?php }; ?>
          
        </div>
      </div> 
      <!-- END OF CONTAINER -->

      <script>
          $('#alertsuccess').delay(2000).hide(500); 
      </script>


<?= $this->endSection('content'); ?>
