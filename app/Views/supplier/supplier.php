<!-- extend dari template layout -->
<?= $this->extend('layout/template'); ?>

<!-- Content -->
<?= $this->section('content'); ?> 

      <div class="container">
          
          <!-- ADD & SEARCH -->
          <div class="d-flex bd-highlight mb-3 sticky-top sticky-content">
            <div>
              <h1 class="text-center" > <?= $title; ?> | </h1>  
              <input type="hidden" id="pages" value="<?= $title; ?>">
            </div>
            <div class="mr-auto p-2 bd-highlight">
            <!-- btn tambah -->
              <button class="btn-add btn">
                <a role="button" href="<?= base_url();?>/supplier/supplier_tambah">  
                <i class="fa fa-plus-circle " aria-hidden="true"></i> Tambah supplier</a>
              </button>
              
            </div>
          </div>

          <!-- END OF ADD & SEARCH -->

          <!-- Menampilkan flash data -->
          <?php if (session()->getFlashdata('pesan')) : ?>
            <div id="alertsuccess" class="alert alert-success" role="alert">
            <i class="fa fa-check-circle " aria-hidden="true"></i>
              <?= session()->getFlashdata('pesan'); ?>
            </div>
          <?php endif; ?>

        <div id="container">
          
          <!-- TABLE -->
          <div class="table-round p-5" >
            <table class="table table-hover table-borderless table-striped" id="dataTables">
              <!-- table header -->
              <thead>
                <tr class="mid">
                  <th scope="col">#</th>
                  <th scope="col">nama</th>
                  <th scope="col">no telepon</th>
                  <th scope="col">alamat</th>
                  <th scope="col">asal perusahaan</th>
                  <th  class="text-center"  style="width: 25%" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody >

              <!-- looping menampilkan data supplier -->
              <?php $i = 1; foreach($supplier as $a) { ?>
                <tr class="mid">
                  <th  scope="row"><?= $i++?></th>
                  <td><?= $a['nama'] ?> </td>
                  <td><?= $a['no_telp'] ?> </td>
                  <td><?= $a['alamat'] ?> </td>
                  <td>
                    <?php foreach ($perusahaan as $b) {
                      if ($a['id_perusahaan'] == $b['id_perusahaan']){
                        echo $b['nama'];
                      }  
                    }
                    ?> 
                  </td>
                  <td class="text-center">
                    <!-- btn ubah data -->
                    <button type="button" class="btn rad-20 btn-warning btn-sm">
                      <a href="<?= base_url();?>/supplier/supplier_ubah/<?= $a['id_supplier'];?>">
                      <i class="fa fa-edit " aria-hidden="true"></i> ubah</a>
                    </button>
                    <!-- btn hapus data -->
                    <button type="button" class="btn rad-20 btn-danger btn-sm" data-toggle="modal" data-target="#deleteData<?= $a['id_supplier']; ?>">
                    <i class="fa fa-trash-alt " aria-hidden="true"></i> hapus</button>
                  </td>
                </tr>
                    <!-- MODAL hapus DATA -->
                    
                    <div class="modal fade" id="deleteData<?= $a['id_supplier']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content rad-30">
                        
                          <!-- Modal Header -->
                          <div class="modal-header modal-header-custom ">
                            <h4 class="modal-title mx-auto">Hapus</h4>
                          </div>
                          
                          <!-- Modal body -->
                          <div class="container">
                            <div class="row my-5 px-5 text-center">
                              <h5>Apakah anda yakin ingin menghapus supplier dengan nama "<?= $a['nama']; ?>"?</h5>
                            </div>
                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <div class="mx-auto ">
                              
                            <form action="<?= base_url(); ?>/Supplier/supplier_delete/<?= $a['id_supplier']; ?>" method="post" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-modal rad-30 btn-primary mr-3" style="color: white;" 
                              >Ya</button>                      
                            </form>
                            <button type="button" class="btn btn-modal rad-30 btn-outline-primary ml-3 " data-dismiss="modal">Batal</button>
                            </div>
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
      
<?= $this->endSection(); ?>