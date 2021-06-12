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
                <a role="button" href="<?= base_url();?>/satuan/satuan_tambah"> 
                <i class="fa fa-plus-circle " aria-hidden="true"></i> Tambah satuan</a>
                
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
          

        <div id="container">
            
          <!-- TABLE -->
          <div class="table-round p-3 pt-5 pb-5">
            <table class="table pb-5 table-hover table-borderless table-striped" id="dataTables" >
              <thead>
                <tr class="mid">
                  <th scope="col" style="text-align: center;">#</th>
                  <th scope="col">id satuan</th>
                  <th scope="col">nama satuan</th>
                  <th  class="text-center" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody class="">

              <?php $i = 1; foreach($satuan as $a) { ?>
                <tr class="mid">
                  <th scope="row" style="text-align: center;"><?= $i++?></th>
                  <th><?= "#S00".$a['id_satuan'] ?> </th>
                  <td><?= $a['nama'] ?> </td>
                  <td class="text-center">
                    <button type="button" class="btn rad-20 btn-warning btn-sm">
                      <a href="<?= base_url();?>/satuan/satuan_ubah/<?= $a['id_satuan'];?>">
                      <i class="fa fa-edit " aria-hidden="true"></i> ubah</a>
                    </button>
                    <button type="button" class="btn rad-20 btn-danger btn-sm" data-toggle="modal" data-target="#deleteData<?= $a['id_satuan']; ?>">
                    <i class="fa fa-trash-alt " aria-hidden="true"></i> hapus</button>
                  </td>
                </tr>
                    <!-- MODAL Delete DATA -->
                    
                    <div class="modal fade" id="deleteData<?= $a['id_satuan']; ?>">
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
                              <h5>Apakah anda yakin ingin menghapus satuan dengan nama "<?= $a['nama']; ?>"?</h5>
                              <br>
                              <small style="color: black;"><i class="fas fa-exclamation-triangle " aria-hidden="true"></i> Dengan menghapus ini, maka akan menghapus data barang dengan satuan "<?= $a['nama']; ?>"</small>
                              
                            </div>
                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <div class="mx-auto ">
                              
                            <form action="<?= base_url(); ?>/Satuan/satuan_delete/<?= $a['id_satuan']; ?>" method="post" class="d-inline">
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

      <script>
        $('#alertsuccess').delay(2000).hide(500); 
      </script>
       
<script src="<?= base_url('assets/js/script.js') ?>"></script>




<?= $this->endSection('content'); ?>
