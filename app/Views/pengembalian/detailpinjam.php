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
                    <h3 class="card-title">Daftar Alat Dipinjam</h3>
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
                                <th>Nama</th>
                                <th>HP</th>
                                <th>Alat</th>
                                <th>jumlah</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($alat as $a) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $a['user_nama']; ?></td>
                                    <td><?= $a['no_hp']; ?></td>
                                    <td><?= $a['detail']; ?></td>
                                    <td><?= $a['jumlah_p']; ?></td>
                                    <td><?= $a['pesan']; ?></td>
                                    <td><?= $a['updated_at']; ?></td>
                                    <td><?= $a['status']; ?></td>
                                    <td>
                                        <?php if ($a['status'] == 'sedang dipinjam') : ?>
                                            <?php if (session('nis') != $a['nis_user']) : ?>
                                                <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                            <?php else : ?>
                                                <a href="/pengembalian/proses/<?= $a['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if (session('level') == 1) : ?>
                                                <?php if ($a['status'] == 'proses ditolak') : ?>
                                                    <?php if (session('nis') == $a['nis_user']) : ?>
                                                        <a href="/pengembalian/proses/<?= $a['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                                    <?php else : ?>
                                                        <a href="#" class="btn btn-sm btn-success"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($a['status'] == 'proses pengembalian') : ?>

                                                    <a href="/pengembalian/validasi/<?= $a['id'] . '/'; ?> <?= $a['jumlah_p']; ?>" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i></a>
                                                    <a href="/pengembalian/tolak/<?= $a['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                                <?php endif; ?>

                                            <?php else : ?>
                                                <?php if ($a['status'] == 'proses ditolak') : ?>
                                                    <a href="/pengembalian/proses/<?= $a['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                                <?php else : ?>
                                                    <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>


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
</div>
<?= $this->endSection(); ?>