<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="/alat/save" method="post">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kalat">Kode Alat</label>
                            <input type="text" class="form-control <?= ($validation->hasError('kalat') ? 'is-invalid' : '');  ?>" id="kalat" placeholder="Masukan kode barang" name="kalat">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kalat'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nalat">Nama Alat</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nalat') ? 'is-invalid' : '');  ?>" id="nalat" placeholder="Masukan nama alat" name="nalat">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nalat'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control <?= ($validation->hasError('jumlah') ? 'is-invalid' : '');  ?>" id="jumlah" placeholder="Masukan jumlah" name="jumlah">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jumlah'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Tambah Data</button>
                        <!-- <input type="submit" class="btn btn-danger" value="Kirim"> -->
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>