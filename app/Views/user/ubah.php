<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="/user/update/<?= $user['id']; ?>" method="post">
                    <?= csrf_field(); ?>



                    <div class="card-body">
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nis') ? 'is-invalid' : '');  ?>" id="nis" placeholder="Masukan NIS" name="nis" value="<?= $user['nis']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nis'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '');  ?>" id="nama" placeholder="Masukan nama" name="nama" value="<?= $user['nama']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">

                                <option value="Siswa" <?= ($user['status'] == 'Siswa') ? 'selected' : ''; ?>>Siswa</option>

                                <option value="Guru" <?= ($user['status'] == 'Guru') ? 'selected' : ''; ?>>Guru</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level">
                                <option value="1" <?= ($user['level'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?= ($user['level'] == 2) ? 'selected' : ''; ?>>2</option>
                            </select>
                        </div>
                        <input type="hidden" name="username" value="user">
                        <input type="hidden" name="password" value="user">
                        <input type="hidden" name="kelas" value="-">
                        <input type="hidden" name="hp" value="-">
                        <input type="hidden" name="foto" value="profil.jpg">
                    </div>

                    <!-- /.card-body -->


                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Ubah Data</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>