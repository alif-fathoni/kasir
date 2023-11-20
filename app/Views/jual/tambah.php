<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
        <form action="" method="post">
            <div class="card">
                <div class="card-header">
                    <h5>Penjualan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= rand(1000000000,9999999999); ?>" name="nota">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= date('Y-m-d') ?>" name="date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pelanggan</label>
                                <div class="col-sm-9">
                                    <select onchange="selectPelanggan(this.value)" class="form-control bg-light" name="pelanggan_id">
                                        <option value="-">[Pelanggan Baru]</option>
                                        <?php foreach ($data_pelanggan as $key => $value): ?>
                                        <option value="<?= $value->id ?>"><?= $value->nama ?> - <?= $value->no_telp ?></option> 
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div id="result-pelanggan">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pelanggan_nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No HP/WA</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pelanggan_no_telp">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Detail Produk</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Barcode / Kode</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="produk_code" id="produk_code">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-success btn-sm" id="tambah-produk">Cari</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-row-bordered my-3">
                                <thead>
                                    <tr>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="result-detail">
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th><input type="text" class="form-control" id="total" readonly name="total"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('jual') ?>" class="btn btn-warning">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
	</div>
</div>

<div class="d-none" id="satuan-option">
    <?php foreach ($data_satuan as $key => $value): ?>
        <option value="">-- Pilih --</option>
        <option value="<?= $value->id ?>"><?= $value->nama ?></option>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="pelanggan_id"]').select2();
    })
</script>

<script type="text/javascript">
    $("#tambah-produk").bind('click', function(e) {
        e.preventDefault();
        add_product();
    });

    function add_product(){
        var produk_code = $("#produk_code").val();
        var option_satuan = $('#satuan-option').html();

        $.ajax({
            url: "<?= base_url('jual/produk') ?>",
            type: "GET",
            dataType: 'JSON',
            data: {produk_code:produk_code},
            success: function(resp) {
                if (resp) {

                    var result_html = `<tr class="row-tr">
                                        <td><input required="" type="hidden" class="form-control trigger" name="produk_id[]" value="${resp.id}"><input type="hidden" class="form-control trigger" name="code[]" value="${produk_code}">${resp.code}</td>
                                        <td><input required="" type="hidden" class="form-control trigger" name="nama[]" value="${resp.nama}">${resp.nama}</td>
                                        <td><input required="" value="1" class="form-control trigger" type="number" name="jumlah[]"></td>
                                        <td><input required="" type="hidden" class="form-control trigger" name="satuan_id[]" value="${resp.satuan_id}">${resp.nama_satuan}</td>
                                        <td><input required="" type="number" class="form-control trigger" name="harga[]" value="${resp.harga_jual}"></td>
                                        <td><input required="" class="form-control trigger" readonly name="subtotal[]" value="${resp.harga_jual}"></td>
                                        <td><button type="button" class="btn btn-danger delete-tr">Hapus</button></td>
                                      </tr>
                                    `;

                    $("#result-detail").append(result_html);
                    $("#produk_code").val('');
                    sum();
                } else {
                    alert('Data Tidak Ditemukan')  
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
            // error: function(xhr, status, error) {
            //     alert('Error, please try again');
            // }
        })
    }

    $(document).on('keyup', '.trigger', function(){
        sum()
    })

    $(document).on('click', '.delete-tr', function(){
        $(this).parents('.row-tr').remove();
    })


     function sum() {
        var total = 0;

        $("tr.row-tr").each(function(key, val) {
            var quantity = $(val).find('input[name="jumlah[]"]').val();
            var price = $(val).find('input[name="harga[]"]').val();

            var subtotal = parseFloat(quantity) * parseFloat(price);

            total = parseFloat(total) + parseFloat(subtotal);

            $(val).find('input[name="subtotal[]"]').val(subtotal);
        })

        $("#total").val(Math.round(parseFloat(total)));
    }


    function selectPelanggan(value){
        
        if (value == '-') {
            $('#result-pelanggan').removeClass('d-none');
        }else{
            $('#result-pelanggan').addClass('d-none');
            $('input[name="pelanggan_nama"]').val('');
            $('input[name="pelanggan_no_telp"]').val('');

        }

    }


</script>
<?= $this->endSection() ?>
