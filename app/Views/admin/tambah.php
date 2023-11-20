<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Admin</h5>
            </div>
            <div class="card-body">
               <form action="<?= base_url('admin/tambah') ?>" method="post">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <a href="<?= base_url('admin') ?>" class="btn btn-warning">Kembali</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>
<?= $this->endSection() ?>