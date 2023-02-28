<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
        <h1><?= $title; ?></h1>
        <form action="/buku/update/<?= $buku['id_buku'] ?>" method="post" class="mt-4" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="sampulLama" value="<?= old('sampul') ? old('sampul') : $buku['sampul']; ?>" id="customFile" />
            <div class="form-group row">
                <label for="inputJudul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-4">
                    <input type="text" name="judul" id="inputJudul"
                    class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>"
                    value="<?= old('judul') ? old('judul') : $buku['judul']; ?>"
                    >
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-4">
                    <input type="text" name="pengarang" id="inputPengarang"
                    class="form-control"
                    value="<?= old('pengarang') ? old('pengarang') : $buku['pengarang']; ?>"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPenerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-4">
                    <input type="text" name="penerbit" id="inputPenerbit"
                    class="form-control"
                    value="<?= old('penerbit') ? old('penerbit') : $buku['penerbit']; ?>"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputTahunTerbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-4">
                    <input type="text" name="tahun_terbit" id="inputTahunTerbit"
                    class="form-control"
                    value="<?= old('tahun_terbit') ? old('tahun_terbit') : $buku['tahun_terbit']; ?>"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputSampul" class="col-sm-2 col-form-label">Sampul</label>
                <div class="col-sm-4">
                    <div class="custom-file">
                        <input type="file" name="sampul" class="form-control-file <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="customFile">
                        <div class="invalid-feedback">
                            <?= $validation->getError('sampul'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
<?php $this->endSection(); ?>