<?php
$name = "Data Transaksi ".date("Y/m/d");  
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$name.xls");
?>

<html>
    <style>
        td, th {
            border: 1px solid black;
            vertical-align: 'mid';
        }
    </style>
    <body>
        <table style="border: 1px solid black;">
            <tr>
                <th>NO</th>
                <th>Barang</th>
                <th>harga</th>
                <th>jml barang</th>
                <th>Total</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
                <th>Total Kembalian</th>
                <th>Nama Kasir</th>
                <th>tgl Transaksi</th>
            </tr>
            <?php foreach($transaksi as $a) {?>
                <tr>
                <?php $jmlbarang = 0; foreach($detail_transaksi as $b) { 
                    if ($a['id_transaksi'] == $b['id_transaksi']){
                        $jmlbarang = $jmlbarang + 1;
                    }
                }?>
                    
                    <td rowspan="<?= $jmlbarang; ?>"><?= $a['id_transaksi']; ?></td>
                    <?php $n = 1; foreach($detail_transaksi as $b) { 
                        if (($a['id_transaksi'] == $b['id_transaksi']) && ($n == 1)){ ?>
                            <td>
                                  <?php foreach ($barang as $c) {
                                    if ($b['id_barang'] == $c['id_barang']){
                                      echo $c['nama'];
                                    }  
                                  }
                                  ?> 
                            </td>
                            <td><?= $b['harga']; ?></td>
                            <td><?= $b['jumlah_barang']; ?></td>
                            <td><?= $b['total_harga']; ?></td>
                        <?php $n = 0; }; ?>
                    <?php } ?>
                    <td rowspan="<?= $jmlbarang; ?>"><?= $a['total_harga']; ?></td>
                    <td rowspan="<?= $jmlbarang; ?>"><?= $a['total_bayar']; ?></td>
                    <td rowspan="<?= $jmlbarang; ?>"><?= $a['total_kembalian']; ?></td>
                    <td rowspan="<?= $jmlbarang; ?>"><?= $a['nama_kasir']; ?></td>
                    <td rowspan="<?= $jmlbarang; ?>"><?= $a['created_at']; ?></td>
                </tr>
                <?php $n = 1; foreach($detail_transaksi as $b) { 
                        if (($a['id_transaksi'] == $b['id_transaksi']) && ($n == 1) && ($jmlbarang >= 2)){ 
                            $n = $n + 1;
                        } elseif (($a['id_transaksi'] == $b['id_transaksi']) && ($n >= 2) && ($jmlbarang >= 2)){ ?>
                            <tr>
                                <td>
                                    <?php foreach ($barang as $c) {
                                        if ($b['id_barang'] == $c['id_barang']){
                                        echo $c['nama'];
                                        }  
                                    }
                                    ?> 
                                </td>
                                <td><?= $b['harga']; ?></td>
                                <td><?= $b['jumlah_barang']; ?></td>
                                <td><?= $b['total_harga']; ?></td>
                            </tr>
                        <?php  }; ?>
                    <?php } ?>
            <?php } ?>
        </table>
    </body>
</html>