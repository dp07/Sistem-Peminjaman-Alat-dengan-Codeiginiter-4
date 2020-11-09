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
                                <th>NIS</th>
                                <th>HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($alat as $a) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $a['nis_user']; ?></td>
                                    <td><?= $a['user_nama']; ?></td>
                                    <td><?= $a['no_hp']; ?></td>

                                    <td>
                                        <a href="/pengembalian/detailpinjam/<?= $a['nis_user']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-folder-open"></i></a>


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