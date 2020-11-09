<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div>
                <a href="/user/create" class="btn btn-sm btn-primary">Tambah Data User</a>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar User</h3>
                    <div class="card-tools">
                        <form action="" method="post">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>No HP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                            <?php foreach ($user as $u) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $u['nis']; ?></td>
                                    <td><?= $u['nama']; ?></td>
                                    <td><?= $u['kelas']; ?></td>
                                    <td><?= $u['hp']; ?></td>
                                    <td><?= $u['status']; ?></td>
                                    <td>
                                        <a href="/user/ubah/<?= $u['id']; ?>" class="btn btn-sm btn-success">Ubah</a>
                                        <a href="/user/delete/<?= $u['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin?');">Hapus</a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('user', 'user_pagination'); ?>
                </div>
                <!-- /.card-body -->
                <!-- <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div> -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>


<?= $this->endSection(); ?>