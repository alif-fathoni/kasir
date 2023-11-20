<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Data Admin | <a href="<?= base_url('admin/tambah') ?>" class="btn btn-primary btn-sm">[+] Tambah Admin</a> </h3>
                <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
            </div>
            <div class="card-block table-border-style">
                <div class="table-responsive px-3">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($data as $key => $value): ?>
                            <tr>
                                <th scope="row"><?= ($key+1) ?></th>
                                <td><?= $value->nama ?></td>
                                <td><?= $value->username ?></td>
                                <td>
                                	<a href="<?= base_url('admin/edit/'.$value->id) ?>" class="btn btn-success">Edit</a>
                                	<a onclick="return confirm('Yakin untuk Hapus?')" href="<?= base_url('admin/hapus/'.$value->id) ?>" class="btn btn-danger">Hapus</a>
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