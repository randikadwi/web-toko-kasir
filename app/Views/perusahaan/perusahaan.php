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
                <a role="button" href="<?= base_url();?>/perusahaan/perusahaan_tambah"> <i class="fa fa-plus-circle " aria-hidden="true"></i> Tambah Perusahaan</a>
                
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

        <div id="container">
          
          <!-- TABLE -->
          <div class="table-round p-3 pt-5 pb-5" >
            <table class="table table-sm pb-5 table-hover table-borderless table-striped" id="dataTables" >
              <thead>
                <tr class="mid">
                  <th scope="col">#</th>
                  <th scope="col">nama</th>
                  <th scope="col">alamat</th>
                  <th scope="col">email</th>
                  <th scope="col">no telepon</th>
                  <th  class="text-center"  style="width: 25%" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody >

              <?php $i = 1; foreach($perusahaan as $a) { ?>
                <tr class="mid">
                  <th  scope="row"><?= $i++?></th>
                  <td><?= $a['nama'] ?> </td>
                  <td><?= $a['alamat'] ?> </td>
                  <td><?= $a['email'] ?> </td>
                  <td><?= $a['no_telp'] ?> </td>
                  <td class="text-center">
                    <button type="button" class="btn my-1 rad-20 btn-warning btn-sm">
                      <a href="<?= base_url();?>/perusahaan/perusahaan_ubah/<?= $a['id_perusahaan'];?>">
                      <i class="fa fa-edit " aria-hidden="true"></i> ubah</a>
                    </button>
                    <button type="button" class="btn my-1 rad-20 btn-danger btn-sm" data-toggle="modal" data-target="#deleteData<?= $a['id_perusahaan']; ?>">
                    <i class="fa fa-trash-alt" aria-hidden="true"></i> hapus</button>
                  </td>
                </tr>
                    <!-- MODAL Delete DATA -->
                    
                    <div class="modal fade" id="deleteData<?= $a['id_perusahaan']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content rad-30">
                        
                          <!-- Modal Header -->
                          <div class="modal-header modal-header-custom ">
                            <h4 class="modal-title mx-auto">Hapus</h4>
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                          </div>
                          
                          <!-- Modal body -->
                          <div class="container">
                            <div class="row my-5 px-5 text-center">
                              <h5>Apakah anda yakin ingin menghapus perusahaan dengan nama <?= $a['nama']; ?>?</h5>
                            </div>
                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <div class="mx-auto ">
                              
                            <form action="<?= base_url(); ?>/Perusahaan/perusahaan_delete/<?= $a['id_perusahaan']; ?>" method="post" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-modal rad-30 btn-primary mr-3" style="color: white;" 
                              >Ya</button>                      
                            </form>
                            <button type="button" class="btn btn-modal rad-30  btn-outline-primary ml-3 " data-dismiss="modal"><div>Batal</div></button>
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