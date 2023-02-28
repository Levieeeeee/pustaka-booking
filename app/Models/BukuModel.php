<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $allowedFields = ['judul', 'pengarang', 'penerbit', 'tahun_terbit', 'sampul'];

    public function getBuku($idBuku = false)
    {
        if (!$idBuku) {
            return $this->findAll();
        }

        return $this->where(['id_buku' => $idBuku])->first();
    }

    public function findBuku($cari)
    {
        return $this->table('buku')->like('judul', $cari);
    }
}