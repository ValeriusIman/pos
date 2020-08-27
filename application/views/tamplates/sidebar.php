<li class="nav-item">
    <a href="<?= site_url('user/dashboard') ?>" class="nav-link">
        <i class="fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

<?php if ($this->session->userdata('level') == 1) { ?>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="fas fa-folder-open"></i>
            <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('user') ?>" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('pelanggan') ?>" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Pelanggan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('supplier') ?>" class="nav-link">
                    <i class="nav-icon fas fa-people-carry"></i>
                    <p>
                        Supplier
                    </p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="fas fa-boxes"></i>
            <p>
                Produk
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= site_url('JenisBarang') ?>" class="nav-link">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>
                        Kategori Barang
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('satuan') ?>" class="nav-link">
                    <i class="nav-icon fas fa-balance-scale"></i>
                    <p>
                        Satuan Barang
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('barang') ?>" class="nav-link">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        Barang
                    </p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="<?= site_url('stock/stockIn') ?>" class="nav-link">
                    <i class="nav-icon fas fa-dolly"></i>
                    <p>
                        Stock In
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('stock/stockOut') ?>" class="nav-link">
                    <i class="nav-icon fas fa-truck-loading"></i>
                    <p>
                        Stock Out
                    </p>
                </a>
            </li> -->
        </ul>
    </li>
<?php } ?>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="fas fa-donate"></i>
        <p>
            Transaksi
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= site_url('transaksi') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>
                    Data Penjualan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('pembelian/list') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>
                    Data Pembelian
                </p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="fas fa-box-open"></i>
        <?php if ($this->fungsi->notifikasi() != 0) { ?>
            <span class="badge badge-danger right"><?= $this->fungsi->notifikasi() ?></span>
        <?php } ?>
        <p>
            Stock
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= site_url('stock/stockIn') ?>" class="nav-link">
                <i class="far fa-file-alt nav-icon"></i>
                <p>
                    Data Stock In
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('stock/stockOut') ?>" class="nav-link">
                <i class="far fa-file-alt nav-icon"></i>
                <p>
                    Data Stock Out
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('stock/stockMinimum') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-contract"></i>
                <p>
                    Data Barang Minimum
                    <?php if ($this->fungsi->notifikasi() != 0) { ?>
                        <span class="badge badge-danger right"><?= $this->fungsi->notifikasi() ?></span>
                    <?php } ?>
                </p>
            </a>
        </li>
    </ul>
</li>
<?php if ($this->session->userdata('level') == 1) { ?>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= site_url('barang/reportBarang') ?>" class="nav-link">
                    <i class="far fa-file-alt nav-icon"></i>
                    <p>
                        Laporan Barang
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('transaksi/report') ?>" class="nav-link">
                    <i class="far fa-file-alt nav-icon"></i>
                    <p>
                        Laporan Penjualan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('pembelian/report') ?>" class="nav-link">
                    <i class="far fa-file-alt nav-icon"></i>
                    <p>
                        Laporan Pembelian
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('transaksi/laba') ?>" class="nav-link">
                    <i class="far fa-file-alt nav-icon"></i>
                    <p>
                        Laporan Laba Rugi
                    </p>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>
<li class="nav-header">APLIKASI</li>
<li class="nav-item">
    <a href="<?= site_url('app') ?>" class="nav-link">
        <i class="fas fa-desktop"></i>
        <p>
            Kasir
        </p>
    </a>
</li>
<?php if ($this->session->userdata('level') == 1) { ?>
    <li class="nav-item">
        <a href="<?= base_url('pembelian') ?>" class="nav-link">
            <i class="fas fa-hand-holding-usd"></i>
            <p>
                Pembelian
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('stock/appStock') ?>" class="nav-link">
            <i class="fas fa-dolly"></i>
            <p>
                Stock In/Out
            </p>
        </a>
    </li>
<?php } ?>
<li class="nav-header">SETING</li>
<?php if ($this->session->userdata('level') == 1) { ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-recycle"></i>
            <p>
                Recycle Bin
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('RecycleBin/hapusPelanggan') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Pelanggan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('RecycleBin/hapusSupplier') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Supplier
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('RecycleBin/hapusKategori') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Kategori Barang
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('RecycleBin/hapusSatuan') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Satuan Barang
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('RecycleBin/hapusBarang') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Barang
                    </p>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>
<li class="nav-item">
    <a href="#" class="nav-link" data-toggle="modal" data-target="#staticBackdrop">
        <i class="fas fa-sign-out-alt"></i>
        <p>
            Loguot
        </p>
    </a>
</li>