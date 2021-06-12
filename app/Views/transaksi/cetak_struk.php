
<html>
	<head>
		<style>
			.header{
				text-align: center;
				font-family: 'Times New Roman', Times, serif;
				font-size: 12px;
				font-style: normal;
				font-weight: 400;
				line-height: 5px;
				letter-spacing: 0em;
			}
			.subheader{
				font-size: 8px;
				text-align: center;
				font-family: 'Times New Roman', Times, serif;
				font-style: normal;
				font-weight: 400;
				line-height: 8px;
			}
			.footer{
				font-size: 8px;
				text-align: center;
				font-family: 'Times New Roman', Times, serif;
				font-style: normal;
				font-weight: 400;
				line-height: 8px;
			}
			th{
				font-size: 7px;
			}
			table{
				font-size: 6px;
				font-family: 'Times New Roman', Times, serif;
				font-style: normal;
				line-height: 8px;
			}


		</style>
	</head>
	<body>
		<div class="header">
			Kasir Toko
		</div>
		<div class="subheader">
			Jl. Telekomunikasi Jl. Terusan Buah Batu <br>
			022 999999 <br>
			<?php 
				$timestamp = strtotime($transaksi['created_at']);
				$day = date('D', $timestamp);
			?>
			<?= date('l', $timestamp).", "; ?>
			<?= $transaksi['created_at']; ?> <br>
			
			<strong> _____________________________________</strong> <br>
		</div>
		
		<table >
			<tbody class="">

			<?php $i = 1; foreach($detail_transaksi as $b) { ?>
				<?php if(($transaksi['id_transaksi'])==($b['id_transaksi'])) { ?>
				<tr class="mid text-center">
					<th colspan="2" style="text-align: left;">
						
						<?php foreach ($barang as $c) {
						if ($b['id_barang'] == $c['id_barang']){
							echo $c['nama'];
						}  
						}
						?> 
					</th>
					<td style="text-align: right;"><?php echo number_format($b['harga'],0,".",".") ?> </td>
					<td><?= " x".$b['jumlah_barang'] ?> </td>
					<td  style="text-align: right;"><?php echo number_format($b['total_harga'],0,".",".") ?> </td>
				</tr>
				<?php }; ?>
			<?php }; ?>
				<tr>
						<td style="text-align: right;" colspan="6"><strong>__________</strong></td>
				</tr>
				<tr>
					<th colspan="3">Total Belanja</th>
					<th colspan="2" style="text-align: right;"><?php echo "Rp. ".number_format($transaksi['total_harga'],0,".",".") ?> </th>
				</tr>
				<tr>
					<th colspan="3">Bayar</th>
					<th colspan="2" style="text-align: right;"><?php echo "Rp. ".number_format($transaksi['total_bayar'],0,".",".") ?> </th>
				</tr>
				<tr>
					<th colspan="3">Kembali</th>
					<th colspan="2" style="text-align: right;"><?php echo "Rp. ".number_format($transaksi['total_kembalian'],0,".",".") ?> </th>
				</tr>
			</tbody>
			</table>

			<div class="footer">
				<br><br><br>
				<strong>Terima Kasih</strong><br>
				kasir :  <?= $transaksi['nama_kasir']; ?><br>
				no transaksi : #<?= $transaksi['id_transaksi']; ?> <br>
			</div>
	</body>
</html>