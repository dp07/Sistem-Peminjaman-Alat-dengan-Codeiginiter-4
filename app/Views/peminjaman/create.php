<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="/peminjaman/save" method="post">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kalat">Nama Alat</label>
                            <input type="text" class="form-control" id="kalat" placeholder="Masukan kode barang" value="<?= $alat['nama_alat']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nalat">Jumlah Tersedia</label>
                            <input type="text" class="form-control" id="nalat" placeholder="Masukan nama alat" name="j_sebelumnya" value="<?= $alat['jumlah']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="p_jumlah">Jumlah</label>
                            <input type="number" class="form-control <?= ($validation->hasError('p_jumlah') ? 'is-invalid' : '');  ?>" id="p_jumlah" placeholder="Masukan jumlah" name="p_jumlah">
                            <div class="invalid-feedback">
                                <?= $validation->getError('p_jumlah'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="j_sebelum" value="<?= $alat['jumlah']; ?>">
                        <input type="hidden" name="id" value="<?= $alat['id']; ?>">
                        <input type="hidden" name="pn_alat" value="<?= $alat['nama_alat']; ?>">
                        <?php $nis = session('nis'); ?>
                        <input type="hidden" name="user_nis" value="<?= $nis; ?>">
                        <input type="hidden" name="pk_alat" value="<?= $alat['kode_alat']; ?>">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Masukan Keranjang</button>
                        <!-- <input type="submit" class="btn btn-danger" value="Kirim"> -->
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>