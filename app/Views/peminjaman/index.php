<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div>
                <a href="/alat/create" class="btn btn-sm btn-primary">Tambah Data Alat</a>
            </div>
        </div>
    </div> -->
    <div class="row mt-3">
        <div class="col-12">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('p_pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('p_pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Alat</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <?php if (session('level') == 1) : ?>
                                    <th>Kode Alat</th>
                                <?php endif; ?>
                                <th>Nama Alat</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($alat as $a) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <?php if (session('level') == 1) : ?>
                                        <td><?= $a['kode_alat']; ?></td>
                                    <?php endif; ?>
                                    <td><?= $a['nama_alat']; ?></td>
                                    <td><?= $a['jumlah']; ?></td>
                                    <td>
                                        <a href="/peminjaman/create/<?= $a['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-cart-arrow-down"></i></a>
                                        <!-- <a href="/alat/delete/<?= $a['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</a> -->
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

    <?php if ($k_alat) : ?>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Keranjang Alat</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 33px;">
                                <div class="">
                                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-arrow-alt-circle-up"> </i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <?php if (session('level') == 1) : ?>
                                        <th>Kode Alat</th>
                                    <?php endif; ?>
                                    <th>Nama Alat</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($k_alat as $pa) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <?php if (session('level') == 1) : ?>
                                            <td><?= $pa['pk_alat']; ?></td>
                                        <?php endif; ?>
                                        <td><?= $pa['pn_alat']; ?></td>
                                        <td><?= $pa['p_jumlah']; ?></td>
                                        <td>
                                            <a href="/pengembalian/save/<?= $pa['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-arrow-alt-circle-up"></i></a>
                                            <a href="/peminjaman/delete/<?= $pa['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?');"><i class="fas fa-trash-alt"></i></a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>