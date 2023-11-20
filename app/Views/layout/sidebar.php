 <nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item mt-4">
            <li class="<?= (@$menu == 'home')? "active" : "" ?>">
                <a href="<?= base_url('home') ?>">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Master</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= (@$menu == 'satuan')? "active" : "" ?>">
                <a href="<?= base_url('satuan') ?>">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Satuan</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="<?= (@$menu == 'kategori')? "active" : "" ?>">
                <a href="<?= base_url('kategori') ?>">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Kategori</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>   
            <li class="<?= (@$menu == 'produk')? "active" : "" ?>">
                <a href="<?= base_url('produk') ?>">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Produk</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Transaksi</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= (@$menu == 'jual')? "active" : "" ?>">
                <a href="<?= base_url('jual') ?>">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Penjualan</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

    </div>
</nav>