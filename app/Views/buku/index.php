<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="col-6 pl-0">
                <h1><?= $title; ?></h1>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="cari" class="form-control" placeholder="Masukkan Pencarian Data Buku" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <a href="/buku/tambah" class="btn btn-primary">Tambah Data Buku</a>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (2 * ($current - 1));
                    foreach ($buku as $b):
                    ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $b['sampul']; ?>" alt="" /></td>
                            <td><?= $b['judul']; ?></td>
                            <td><a href="/buku/<?= $b['id_buku'] ?> " class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('buku', 'page_buku'); ?>
<?php $this->endSection(); ?>