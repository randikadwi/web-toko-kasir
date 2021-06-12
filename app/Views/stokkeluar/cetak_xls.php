<?php
$name = "Data Stok Keluar ".date("Y/m/d");  
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
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Keterangan</th>
                <th>Updator</th>
                <th>tgl Keluar</th>
            </tr>
            <?php foreach($stokkeluar as $a) {?>
                <tr>
                    <td><?= $a['id_stok_keluar']; ?></td>              
                    <td>
                        <?php foreach ($barang as $b) {
                        if ($a['id_barang'] == $b['id_barang']){
                            echo $b['nama'];
                        }  
                        }
                        ?> 
                    </td>
                    <td><?= $a['harga']; ?></td>
                    <td><?= $a['jumlah']; ?></td>
                    <td><?= $a['harga_total']; ?></td>
                    <td><?= $a['keterangan']; ?></td>
                    <td><?= $a['updator']; ?></td>
                    <td><?= $a['created_at']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
