<?php
namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
    }

    public function index()
    {
        $current = $this->request->getVar('page_buku') ? $this->request->getVar('page_buku') : 1;
        
        $cari = $this->request->getVar('cari');

        if ($cari) {
            $buku = $this->BukuModel->findBuku($cari);
        } else {
            $buku = $this->BukuModel;
        }
        
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $buku->paginate(2, 'buku'),
            'pager' => $this->BukuModel->pager,
            'current' => $current
        ];

        return view('buku/index', $data);
    }

    public function detail($idBuku)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->BukuModel->getBuku($idBuku)
        ];

        return view('buku/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Data Buku',
            'validation' => \Config\Services::validation()
        ];

        return view('buku/tambah', $data);
    }

    public function ubah($idBuku)
    {
        $data = [
            'title' => 'Form Ubah Data Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->BukuModel->getBuku($idBuku),
        ];

        return view('buku/ubah', $data);
    }

    /**
     * prosess simpan data ke db
     */
    public function simpan()
    {
        // validasi
        if (!$this->validate(
            [
                'judul' => [
                    'rules' => 'required',
                    'errors' => ['required' => '(field) harus diisi']
                ],
                'sampul' => [
                    'rules' => 'uploaded[sampul]|max_size[sampul,10000]|is_image[sampul]|mime_in[sampul, image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Gambar wajib dipilih',
                        'max_size' => 'Ukuran Gambar terlalu besar',
                        'is_image' => 'File Wajib Gambar',
                        'mime_in' => 'Tipe File gambar tidak sesuai'
                    ]
                ]
            ]
        )) {
            return redirect()->to('/buku/tambah')->withInput();
        }

        $filesampul = $this->request->getFile('sampul');
        $filesampul->move('img');
        $nmsampul = $filesampul->getName();

        // simpan
        $this->BukuModel->save(
            [
                'judul' => $this->request->getVar('judul'),
                'pengarang' => $this->request->getVar('pengarang'),
                'penerbit' => $this->request->getVar('penerbit'),
                'tahun_terbit' => $this->request->getVar('tahun_terbit'),
                'sampul' => $nmsampul,
            ]
        );

        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('/buku');
    }

    /**
     * proses update data buku ke db
     */
    public function update($idBuku)
    {
        // validasi
        if (!$this->validate(
            [
                'judul' => [
                    'rules' => 'required',
                    'errors' => ['required' => '(field) harus diisi']
                ],
                'sampul' => [
                    'rules' => 'uploaded[sampul]|max_size[sampul,10000]|is_image[sampul]|mime_in[sampul, image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Gambar wajib dipilih',
                        'max_size' => 'Ukuran Gambar terlalu besar',
                        'is_image' => 'File Wajib Gambar',
                        'mime_in' => 'Tipe File gambar tidak sesuai'
                    ]
                ]
            ]
        )) {
            return redirect()->to('/buku/ubah/'.$idBuku)->withInput();
        }

        $filesampul = $this->request->getFile('sampul');

        if ($filesampul->getError() == 4) {
            $nmsampul = $this->request->getVar('sampulLama');
        } else {
            $nmsampul = $filesampul->getName();
            $filesampul->move('img', $nmsampul);
        }

        // simpan
        $this->BukuModel->save(
            [
                'id_buku' => $idBuku,
                'judul' => $this->request->getVar('judul'),
                'pengarang' => $this->request->getVar('pengarang'),
                'penerbit' => $this->request->getVar('penerbit'),
                'tahun_terbit' => $this->request->getVar('tahun_terbit'),
                'sampul' => $nmsampul,
            ]
        );

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/buku');
    }

    /**
     * proses hapus data dari db
     */
    public function hapus($idBuku)
    {
        $this->BukuModel->delete($idBuku);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/buku');
    }
}