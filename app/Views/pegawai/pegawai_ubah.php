<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    
<div class="container col-10 d-flex  py-3 my-5" style=" border: 1px solid lightblue; border-radius: 5px;">
	<div class="nav flex-column nav-pills px-3 pb-4" style="border-right: 1px solid lightblue;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	  <a class="nav-link <?= $validation->hasError('konfirmasipassword') ? '' : 'active' ?>"  id="v-pills-data-tab" data-toggle="pill" href="#v-pills-data" role="tab" aria-controls="v-pills-data" aria-selected="true">Ubah Data</a>
	  <a class="nav-link <?= $validation->hasError('konfirmasipassword') ? 'active' : '' ?>" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Ubah Password</a>
	 </div>
	<div class="tab-content" id="v-pills-tabContent">
	  
      <div class="tab-pane fade <?= $validation->hasError('konfirmasipassword') ? '' : 'show active' ?> " aria-selected="false" id="v-pills-data" role="tabpanel" aria-labelledby="v-pills-data-tab">
	  	<div class="p-5">
	  		<!-- isi -->
	  		<div class="row">
                <div class="col mx-auto">
                    <form action="<?= base_url() ?>/pegawai/pegawai_update/<?= $pegawai['id_pegawai'] ?>" method="post">
                        
                        <h3 class="mb-5">Form Ubah Pegawai : </h3>

                        <?= csrf_field() ?>
                        <!-- id pegawai auto generate -->
                        <input type="hidden" class="form-control rad-30" id="id_pegawai" name="id_pegawai" value="<?= $pegawai['id_pegawai'] ?>">
                        <!-- username -->
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label">username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control rad-30 <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="username"  value="<?= old('username') ?  old('username') : $pegawai['username'] ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username') ?>
                                </div>
                            </div>
                        </div>

                        <!-- role -->
                        <div class="form-group row ">
                        <label for="nama" class=" col-sm-4 col-form-label">role</label>
                        <div class="col-sm-8 pl-3 pt-1">
                            <div class="col-sm-8 form-check form-check-inline">
                                <?php 
                                    if (old('role')) {
                                        $role = old('role');
                                    } else {
                                        $role = $pegawai['role'];
                                    }
                                ?>
                                <input class="form-check-input" <?= ($role) == 1  ? 'checked' : '' ?> type="radio" name="role" id="inlineRadio1" value="1" required="">
                                <label class="form-check-label" for="inlineRadio1">admin</label>
                            </div>
                            <div class="col-sm-8 form-check form-check-inline">
                                <input class="form-check-input" <?= ($role) == 2  ? 'checked' : '' ?> type="radio" name="role" id="inlineRadio2" value="2" required="">
                                <label class="form-check-label" for="inlineRadio2">Pegawai Kasir</label>
                            </div>
                            <div class="col-sm-8 form-check form-check-inline">
                                <input class="form-check-input" <?= ($role) == 3 ? 'checked' : '' ?> type="radio" name="role" id="inlineRadio3" value="3" required="">
                                <label class="form-check-label" for="inlineRadio3">Staff Gudang</label>
                            </div>
                        </div>
                        </div>
                        <!-- nama -->
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">nama</label>
                            <div class="col-sm-8">
                                <input type="nama" class="form-control rad-30 <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="nama" value="<?= old('nama') ?  old('nama') : $pegawai['nama'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama') ?>
                                </div>
                            </div>
                        </div>
                        <!-- alamat -->
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-4 col-form-label">alamat</label>
                            <div class="col-sm-8">
                                <input type="alamat" class="form-control rad-30 <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="alamat" value="<?= old('alamat') ?  old('alamat') : $pegawai['alamat'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('alamat') ?>
                                </div>
                            </div>
                        </div>

                        <!-- no_telp -->
                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-4 col-form-label">no telp</label>
                            <div class="col-sm-8">
                                <input type="no_telp" class="form-control rad-30 <?= $validation->hasError('no_telp') ? 'is-invalid' : '' ?>" id="no_telp" name="no_telp" placeholder="no telp" value="<?= old('no_telp') ?  old('no_telp') : $pegawai['no_telp'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('no_telp') ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- button -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn rad-20 btn-primary btn-modal">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- <div class="col-6">
                    
                    </div> -->

            </div>
	  	</div>
	  </div>
      <!-- Ubah Password Form -->
	  <div class="tab-pane fade <?= $validation->hasError('konfirmasipassword') ? 'show active' : '' ?> " aria-selected="true" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
	  	<div class="p-5" >
	  		<!-- isi -->
	  		<div class="row">
                <div class="col mx-auto">
                    <form  action="<?= base_url() ?>/pegawai/pegawai_update_password/<?= $pegawai['id_pegawai'] ?>" method="post">
                        <h3 class="mb-5">Form Ubah Password Pegawai : </h3>

                        <?= csrf_field() ?>
                         <!-- id pegawai auto generate -->
                         <input type="hidden" class="form-control rad-30" id="id_pegawai" name="id_pegawai" value="<?= $pegawai['id_pegawai'] ?>">
                        
                        <!-- username -->
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label">username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control rad-30" id="username" name="username" placeholder="username"  value="<?= $pegawai['username'] ?>" disabled>
                            </div>
                        </div>
                        <!-- password -->
                        <div class="form-group row">
                            <label class="col-sm-4">Password baru</label>
                            <div class=" col" id="show_hide_password">
                                <input class="form-control rad-30 <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" type="password" id="password" name="password" placeholder="password" value="<?= old('password') ?>">
                                <div class="invalid-feedback rad-30">
                                    <?= $validation->getError('password') ?>
                                </div>
                                
                            </div>

                        </div>

                        <!-- konfirmasi password -->
                        <div class="form-group row">
                            <label class="col-sm-4">konfirmasi passowrd</label>
                            <div class=" col" id="show_hide_konfirmasipassword">
                                <input class="form-control rad-30 <?= $validation->hasError('konfirmasipassword') ? 'is-invalid' : '' ?>" type="password" id="konfirmasipassword" name="konfirmasipassword" placeholder="konfirmasi password" value="<?= old('konfirmasipassword') ?>">
                                
                                
                                <div class="invalid-feedback rad-30">
                                    <?= $validation->getError('konfirmasipassword') ?>
                                </div>
                                
                            </div>
                            
                        </div>

                        
                        
                        <!-- button -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn rad-20 btn-primary btn-modal">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>

                
                <!-- <div class="col-6">
                    
                    </div> -->

            </div> 
            <!-- end of form -->
	 
	</div>	
</div>


<!-- end container -->






<?= $this->endSection('content') ?>