<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Data Penjualan | <a href="<?= base_url('jual/tambah') ?>" class="btn btn-primary btn-sm">[+] Tambah Jual</a> </h3>
                <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
            </div>
            <div class="card-block table-border-style">
                <div class="table-responsive px-3">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nota</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($data as $key => $value): ?>
                            <tr>
                                <th scope="row"><?= ($key+1) ?></th>
                                <td><?= $value->nota ?></td>
                                <td><?= $value->tanggal ?></td>
                                <td><?= $value->deskripsi ?></td>
                                <td><?= rupiah($value->total) ?></td>
                                <td>
                                	<a target="_blank" href="<?= base_url('jual/nota/'.$value->id) ?>" class="btn btn-warning">Nota</a>
                                	<a onclick="return confirm('Yakin untuk Hapus?')" href="<?= base_url('jual/hapus/'.$value->id) ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        	<?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>
<?= $this->endSection() ?>