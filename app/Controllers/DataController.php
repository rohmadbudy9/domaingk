<?php

namespace App\Controllers;

use App\Models\DataModel;

class DataController extends BaseController
{
    protected $dataModel;

    public function __construct()
    {
        $this->dataModel = new DataModel();
    }

    // 🔹 Halaman tambah data
    public function add()
    {
        $data = [
            'username' => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];
        return view('data/add_data', $data);
    }

    // 🔹 Proses tambah data
    public function insert()
    {
        $this->dataModel->save([
            'nama_opd'   => $this->request->getPost('nama_opd'),
            'alamat_web' => $this->request->getPost('alamat_web'),
            'kategori'   => $this->request->getPost('kategori')
        ]);

        return redirect()->to('/data/add')->with('success', 'Data berhasil ditambahkan!');
    }

    // 🔹 Halaman edit data
    public function edit($id)
    {
        $website = $this->dataModel->find($id);

        if (!$website) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan!');
        }

        $data = [
            'website'   => $website,
            'username'  => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];

        return view('data/edit_data', $data);
    }

    // 🔹 Proses update data
    public function update($id)
    {
        $kategori = $this->request->getPost('kategori');

        $this->dataModel->update($id, [
            'nama_opd'   => $this->request->getPost('nama_opd'),
            'alamat_web' => $this->request->getPost('alamat_web'),
            'kategori'   => $kategori
        ]);

        return redirect()->to('/dashboard/kategori/' . $kategori)
            ->with('success', 'Data berhasil diperbarui!');
    }

    // 🔹 Hapus data
    public function delete($id)
    {
        $website = $this->dataModel->find($id);

        if ($website) {
            $this->dataModel->delete($id);
            return redirect()->to('/dashboard/kategori/' . $website['kategori'])
                ->with('success', 'Data berhasil dihapus!');
        }

        return redirect()->to('/data/add')->with('error', 'Data tidak ditemukan!');
    }

    // 🔹 Halaman untuk kategori Ping
    public function pingList()
    {
        $data = [
            'websites'  => $this->dataModel->where('kategori', 'Ping')->findAll(),
            'username'  => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];
        return view('data/ping', $data);
    }

    // 🔹 Halaman edit data
    public function editping($id)
    {
        $website = $this->dataModel->find($id);

        if (!$website) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan!');
        }

        $data = [
            'website'   => $website,
            'username'  => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];

        return view('data/edit_ping', $data);
    }

    // 🔹 Proses update ping
    public function updateping($id)
    {
        $kategori = $this->request->getPost('kategori');

        $this->dataModel->update($id, [
            'nama_opd'   => $this->request->getPost('nama_opd'),
            'alamat_web' => $this->request->getPost('alamat_web'),
            'kategori'   => $kategori
        ]);

        return redirect()->to('/ping-page')
            ->with('success', 'Data berhasil diperbarui!');
    }

    // 🔹 Hapus ping
    public function deleteping($id)
    {
        $website = $this->dataModel->find($id);

        if ($website) {
            $this->dataModel->delete($id);
            return redirect()->to('/ping-page')
                ->with('success', 'Data berhasil dihapus!');
        }

        return redirect()->to('/ping-page')->with('error', 'Data tidak ditemukan!');
    }


    // 🔹 Fungsi untuk melakukan ping
    public function ping($id)
    {
        $website = $this->dataModel->find($id);

        if (!$website) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Website tidak ditemukan'
            ]);
        }

        $host = escapeshellarg($website['alamat_web']);

        // ✅ Tentukan perintah ping sesuai sistem operasi
        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
        $pingCommand = $isWindows
            ? "ping -n 4 $host"
            : "ping -c 4 $host 2>&1";

        // Jalankan perintah ping (dibatasi untuk keamanan)
        $pingResult = @shell_exec($pingCommand);

        if (!$pingResult) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Ping gagal dijalankan.'
            ]);
        }

        // Ubah hasil ping ke array baris
        $pingLines = explode("\n", trim($pingResult));

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => $pingLines
        ]);
    }
}
