<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nota Beli - <?= $data->nota ?></title>

	<style type="text/css">
		.table1 {
		    font-family: sans-serif;
		    color: #232323;
		    border-collapse: collapse;
		}
		 
		.table1, .table1 th, .table1 td {
		    border: 1px solid #999;
		    padding: 8px 20px;
		}
	</style>
</head>
<body>
	<table style="margin-top:10px">
		<tr>
			<td>NOTA</td>
			<td>: <?= $data->nota ?></td>
		</tr>
		<tr>
			<td>TANGGAL</td>
			<td>: <?= getTanggal($data->tanggal) ?></td>
		</tr>
		<tr>
			<td>DESKRIPSI</td>
			<td>: <?= $data->deskripsi ?></td>
		</tr>
	</table>


	<table class="table1" style="margin-top:10px">
		<tr>
			<th>Kode Produk</th>
			<th>Nama Produk</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Harga</th>
			<th>Subtotal</th>
		</tr>
		<?php  
		$total = 0;
		?>
		<?php foreach ($data_detail as $key => $value): ?>
		<tr>
			<td><?= $value->code_produk ?></td>
			<td><?= $value->nama_produk ?></td>
			<td><?= $value->jumlah ?></td>
			<td><?= $value->nama_satuan ?></td>
			<td><?= rupiah($value->harga) ?></td>
			<td><?= rupiah($value->jumlah*$value->harga) ?></td>
		</tr>
		<?php 
		$total += $value->jumlah*$value->harga;
		endforeach; ?>
		<tr>
			<td colspan="5"></td>
			<td><?= rupiah($total) ?></td>
		</tr>
	</table>

	<script type="text/javascript">

		setTimeout(function() {
          window.print();
		}, 2000);
        window.onafterprint = back;

        function back() {
            window.close()
        }
    </script>

</body>
</html>