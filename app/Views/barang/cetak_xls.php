<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Barang.xls");
?>

<html>
    <style>
        td, th {
            border: 1px solid black;
            vertical-align: 'mid';
        }
    </style>
    <body>
        <table>
            <tr>
                <th>NO</th>
                <th>Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>tgl dibuat</th>
                <th>tgl terakhir diupdate</th>
            </tr>
            <?php foreach($barang as $a) {?>
                <tr>
                    <td><?= $a['id_barang']; ?></td>
                    <td><?= $a['nama']; ?></td>
                    <td>
                        <?php foreach ($kategori as $b) {
                        if ($a['id_kategori'] == $b['id_kategori']){
                            echo $b['nama'];
                        }  
                        }
                        ?> 
                    </td>
                    <td><?= $a['harga']; ?></td>
                    <td><?= $a['stok']; ?></td>
                    <td>
                        <?php foreach ($satuan as $b) {
                        if ($a['id_satuan'] == $b['id_satuan']){
                            echo $b['nama'];
                        }  
                        }
                        ?> 
                    </td>
                    <td><?= $a['created_at']; ?></td>
                    <td><?= $a['updated_at']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>