<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?> 

      <div class="container">
          
          <!-- ADD & SEARCH -->
          <div style="z-index: 2;" class="d-flex bd-highlight mb-3 sticky-top sticky-content justify-content-end">
            <div>
              <h1 class="text-center"> <?= $title; ?> | </h1>  
            </div>
            <div class="mr-auto p-2 bd-highlight">
            <button class="btn-add btn">
                <a role="button" href="<?= base_url();?>/pegawai/pegawai_tambah"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Pegawai</a>
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
          
         

          <!-- TABLE -->
          <div class="table-round p-3 pt-5" >
            <table class="table table-hover table-borderless table-striped" id="dataTables">
              <thead>
                <tr class="mid">
                  <th scope="col">#</th>
                  <th scope="col">username</th>
                  <th scope="col">nama</th>
                  <th scope="col">role</th>
                  <th scope="col">alamat</th>
                  <th scope="col">no telepon</th>
                  <th  class="text-center"  style="width: 25%" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody >

              <?php $i = 1; foreach($pegawai as $a) { ?>
                <tr class="mid">
                  <th  scope="row"><?= $i++?></th>
                  <th><?= $a['username']?></th>
                  <td><?= $a['nama'] ?> </td>
                  <td><?php if ($a['role'] == 1){
                    echo "admin";
                  } elseif ($a['role'] == 2) {
                    echo "Pegawai Kasir";
                  } elseif ($a['role'] == 3) {
                    echo "Staff Gudang";
                  }else{
                    echo $a['role'];
                  };?>
                  </td>
                  <td><?= $a['alamat'] ?> </td>
                  <td><?= $a['no_telp'] ?> </td>
                  <td class="text-center">
                    <button type="button" class="btn rad-20 btn-warning btn-sm">
                      <a href="<?= base_url();?>/pegawai/pegawai_ubah/<?= $a['id_pegawai'];?>">
                      <i class="fa fa-edit " aria-hidden="true"></i>
                      ubah</a>
                    </button>
                    <button type="button" class="btn my-1 rad-20 btn-danger btn-sm" data-toggle="modal" data-target="#deleteData<?= $i; ?>">
                      <i class="fa fa-trash-alt " aria-hidden="true"></i> hapus
                    </button>
                  </td>
                </tr>
                    <!-- MODAL Delete DATA -->
                    
                    <div class="modal fade" id="deleteData<?= $i; ?>">
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
                              <h5>Apakah anda yakin ingin menghapus pegawai dengan username "<?= $a['username']; ?>"?</h5>
                            </div>
                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <div class="mx-auto ">
                              
                            <form action="<?= base_url(); ?>/Pegawai/pegawai_delete/<?= $a['id_pegawai']; ?>" method="post" class="d-inline">
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
      <!-- END OF CONTAINER -->

      <!-- MODAL TAMBAH DATA -->
        
        <div class="modal fade" id="tambahData">
          <div class="modal-dialog"  >
            <div class="modal-content rad-30">
            
              <!-- Modal Header -->
              <div class="modal-header modal-header-custom">
                <h5 class="modal-title mx-auto">Tambah Data Pegawai</h5>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              </div>
              
              <!-- Modal body -->
              <div class="container my-3">
              <form class="needs-validation mt-2 mb-2" action="<?= base_url();?>/pegawai/pegawai_save" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                  <label for="username">username</label>
                  <input type="text" class="form-control rad-30" id="username" name="username" placeholder="username" required>
                  <input type="hidden" class="form-control rad-30" id="id_pegawai" name="id_pegawai" placeholder="id_pegawai">
                </div>
                <div class="form-group">
                  <label for="password">password</label>
                  <input type="password" class="form-control rad-30" id="password" name="password" placeholder="password" required >
                </div>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control rad-30" id="nama" name="nama" placeholder="Nama lengkap" required >
                </div>
                <div class="form-group">
                  <label for="role">role</label>
                </div>
                <div class="form-group pl-3">
                  <!-- <label for="nama">Role : </label> -->
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="1" required="">
                    <label class="form-check-label" for="inlineRadio1">admin</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="2" required="">
                    <label class="form-check-label" for="inlineRadio2">Pegawai Kasir</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="inlineRadio3" value="3" required="">
                    <label class="form-check-label" for="inlineRadio3">Staff Gudang</label>
                  </div>
                </div>



                <!-- <div class="form-group">
                  <label for="role">role</label>
                  <input type="text" class="form-control rad-30" id="role" name="role" placeholder="role" required>
                </div> -->
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control rad-30" id="alamat" name="alamat" placeholder="alamat" required>
                </div>
                <div class="form-group">
                  <label for="no_telp">no telepon</label>
                  <input type="text" class="form-control rad-30" id="no_telp" name="no_telp" placeholder="no telepon" required>
                </div>
                
              </div>
              
              <!-- Modal footer -->
              <div class="modal-footer">
                <div class="text-center mx-auto mt-1 mb-1">                  
                    <button type="submit" class="btn rad-20 btn-primary mr-3 btn-modal">Submit</button>
                    <button type="button" class="btn rad-20 btn-danger ml-3 btn-modal" data-dismiss="modal">Batal</button>
                </div>
              </form> 
                <!-- <button type="button" class="btn rad-20 btn-danger" data-dismiss="modal">Close</button> -->
              </div>
              
            </div>
          </div>
        </div>
        <!-- END OF MODAL -->
        <script>
          $('#alertsuccess').delay(2000).fadeOut(500); 
        </script>

<?= $this->endSection(); ?>