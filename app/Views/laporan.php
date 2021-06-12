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
            
          </div>

          <!-- END OF ADD & SEARCH -->

          <!-- Menampilkan flash data -->
          <?php if (session()->getFlashdata('pesan')) : ?>
            <div id="alertsuccess" class="alert alert-success" role="alert">
            <i class="fa fa-check-circle " aria-hidden="true"></i>
              <?= session()->getFlashdata('pesan'); ?>
            </div>
          <?php endif; ?>
        <style>
            .selector button{
                z-index: 50;
                /* color: aqua; */
                padding-left: 40px;
                padding-right: 40px;
            }
        </style>
        <!-- coba -->
        <!-- coba -->
        <div id="container">
            <!-- selector -->
            <select id="jenis" class="search-key rad-30 btn btn-add mr-3 mb-3" onclick='searchTable()' >
              <option value="">Jenis</option>
              <option value=pemasukan>pemasukan</option>
              <option value=pengeluaran>pengeluaran</option>
            </select>
            
            <select id="bulan" class="search-key rad-30 btn btn-add mr-3 mb-3" onclick='searchTableBulan()' >
              <option value="">Bulan</option>
              <option value=January>January</option>
              <option value=February>February</option>
              <option value=March>March</option>
              <option value=May>May</option>
              <option value=June>June</option>
              <option value=July>July</option>
              <option value=August>August</option>
              <option value=September>September</option>
              <option value=October>October</option>
              <option value=November>November</option>
              <option value=December>December</option>
            </select>
            <!-- mendapatkan tahun yang digunakan  -->
            <?php 
              $items = array();
              foreach($stokmasuk as $a) {
                $x = date("Y",strtotime($a['created_at']));
                array_push($items,$x);
              }
              foreach($stokkeluar as $a) {
                $x = date("Y",strtotime($a['created_at']));
                array_push($items,$x);
              }
              $items = array_unique($items);
              $items = array_map('intval', $items);          
              array_multisort($items,SORT_ASC,SORT_NUMERIC);
            ?>
            
            <select id="tahun" class="search-key rad-30 btn btn-add mr-3 mb-3" onclick='searchTableTahun()'>
              <option value="">Tahun</option>
              <?php foreach($items as $a) {?>
                <option value=<?= $a; ?>><?= $a; ?></option>
              <?php } ?>
            </select>

            <input type="hidden" id="total" value="">

          <!-- TABLE -->
          <div class="table-round p-5" >
            <table  class="table id_laporan table-hover table-borderless table-striped">
              <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Tanggal</th> 
                    <th>Tahun</th>
                    <th>total</th>
                </tr>
                
              </thead>  
              <tbody id="displaytable">
              <?php $i = 0; foreach($stokmasuk as $a) { ?>
                <tr>
                  <td data-input="jenis">pengeluaran</td>
                  <td data-input="bulan"><?= date("F j, Y, g:i a",strtotime($a['created_at'])); ?></td>
                  <td data-input="tahun"><?= date("Y",strtotime($a['created_at'])); ?></td>
                  <td data-input="total" class="countable" id="total"><?= $a['harga_total']; ?></td>
                </tr>
              <?php } ?>
              
              <?php $i = 0; foreach($stokkeluar as $a) { 
                if ($a['keterangan'] == "penjualan") {
                ?>
                <tr>
                  <td data-input="jenis">pemasukan</td>
                  <td data-input="bulan"><?= date("F j, Y, g:i a",strtotime($a['created_at'])); ?></td>
                  <td data-input="tahun"><?= date("Y",strtotime($a['created_at'])); ?></td>
                  <td data-input="total" class="countable" id="total"><?= $a['harga_total']; ?></td>
                </tr>
              <?php }} ?>
              </tbody>
              
            </table>

          </div>
          <!-- END OF TABLE -->
        </div>
      </div> 
      <!-- END OF CONTAINER -->
      <script>
        $('#alertsuccess').delay(2000).hide(500); 
        

        // filter
        var $filterableRows = $('.id_laporan').find('tr').not(':first'),
            $inputs = $('.search-key');

        $inputs.on('input', function() {
          $filterableRows.hide().filter(function() {
            return $(this).find('td').filter(function() {
              
              var tdText = $(this).text().toLowerCase(),
                  inputValue = $('#' + $(this).data('input')).val().toLowerCase();
            
              return tdText.indexOf(inputValue) != -1;
            
            }).length == $(this).find('td').length;
          }).show();

        });


        
      </script>
      
<?= $this->endSection(); ?>