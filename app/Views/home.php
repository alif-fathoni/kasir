<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1" onclick="window.location.href='<?= base_url("produk") ?>'">
                <div class="card-block-small">
                    <i class="icofont icofont-pie-chart bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Produk</span>
                    <h4><?= $count_produk ?></h4>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1" onclick="window.location.href='<?= base_url("beli") ?>'">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Pembelian</span>
                    <h4><?= $count_beli ?></h4>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1" onclick="window.location.href='<?= base_url("jual") ?>'">
                <div class="card-block-small">
                    <i class="icofont icofont-warning-alt bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Penjualan</span>
                    <h4><?= $count_jual ?></h4>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1" onclick="window.location.href='<?= base_url("kategori") ?>'">
                <div class="card-block-small">
                    <i class="icofont icofont-list bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Kategori</span>
                    <h4><?= $count_kategori ?></h4>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1" onclick="window.location.href='<?= base_url("satuan") ?>'">
                <div class="card-block-small">
                    <i class="icofont icofont-list bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Satuan</span>
                    <h4><?= $count_satuan ?></h4>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1" onclick="window.location.href='<?= base_url("admin") ?>'">
                <div class="card-block-small">
                    <i class="icofont icofont-user bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Admin</span>
                    <h4><?= $count_admin ?></h4>
                </div>
            </div>
        </div>

</div>

<?= $this->endSection() ?>