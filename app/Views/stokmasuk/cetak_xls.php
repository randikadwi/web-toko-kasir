<?php
$name = "Data Stok Masuk ".date("Y/m/d");  
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
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Total Harga</th>
                <th>Supplier</th>
                <th>Updator</th>
                <th>tgl Masuk</th>
            </tr>
            <?php foreach($stokmasuk as $a) {?>
                <tr>
                    <td><?= $a['id_stok_masuk']; ?></td>              
                    <td>
                        <?php foreach ($barang as $b) {
                        if ($a['id_barang'] == $b['id_barang']){
                            echo $b['nama'];
                        }  
                        }
                        ?> 
                    </td>
                    <td>
                        <?php foreach ($kategori as $b) {
                        if ($a['id_kategori'] == $b['id_kategori']){
                            echo $b['nama'];
                        }  
                        }
                        ?> 
                    </td>
                    <td><?= $a['harga']; ?></td>
                    <td><?= $a['jumlah']; ?></td>
                    <td>
                        <?php foreach ($satuan as $b) {
                            if ($a['id_satuan'] == $b['id_satuan']){
                                echo $b['nama'];
                            }  
                        }
                        ?> 
                    </td>
                    <td><?= $a['harga_total']; ?></td>
                    <td>
                        <?php foreach ($supplier as $b) {
                        if ($a['id_supplier'] == $b['id_supplier']){
                            echo $b['nama'];
                        }  
                        }
                        ?> 
                    </td>
                    <td><?= $a['updator']; ?></td>
                    <td><?= $a['created_at']; ?></td>

                </tr>
            <?php } ?>
        </table>
    </body>
</html>
