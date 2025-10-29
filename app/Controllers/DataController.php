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
            'username'   => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];
        return view('data/add_data', $data);
    }

    // 🔹 Proses tambah data
    public function insert()
    {
        $this->dataModel->createData([
            'nama_opd'   => $this->request->getPost('nama_opd'),
            'alamat_web' => $this->request->getPost('alamat_web'),
            'kategori'   => $this->request->getPost('kategori')
        ]);

        return redirect()->to('/data/add')->with('success', 'Data berhasil ditambahkan!');
    }

    // 🔹 Halaman edit data
    public function edit($id, $view = 'data/edit_data')
    {
        $website = $this->dataModel->getById($id);

        if (!$website) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan!');
        }

        $data = [
            'website'    => $website,
            'username'   => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];

        return view($view, $data);
    }

    // 🔹 Proses update data
    public function update($id)
    {
        $kategori = $this->request->getPost('kategori');

        $this->dataModel->updateData($id, [
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
        $website = $this->dataModel->getById($id);

        if ($website) {
            $this->dataModel->deleteData($id);
            return redirect()->to('/dashboard/kategori/' . $website['kategori'])
                ->with('success', 'Data berhasil dihapus!');
        }

        return redirect()->to('/data/add')->with('error', 'Data tidak ditemukan!');
    }

    // 🔹 Halaman untuk kategori Ping
    public function pingList()
    {
        $data = [
            'websites'   => $this->dataModel->getByCategory('Ping'),
            'username'   => session()->get('username'),
            'level_user' => session()->get('level_user')
        ];
        return view('data/ping', $data);
    }

    // 🔹 Halaman edit ping
    public function editping($id)
    {
        return $this->edit($id, 'data/edit_ping');
    }

    // 🔹 Proses update ping
    public function updateping($id)
    {
        $this->update($id);
        return redirect()->to('/ping-page')
            ->with('success', 'Data berhasil diperbarui!');
    }

    // 🔹 Hapus ping
    public function deleteping($id)
    {
        $website = $this->dataModel->getById($id);

        if ($website) {
            $this->dataModel->deleteData($id);
            return redirect()->to('/ping-page')
                ->with('success', 'Data berhasil dihapus!');
        }

        return redirect()->to('/ping-page')->with('error', 'Data tidak ditemukan!');
    }

    // 🔹 Fungsi untuk melakukan ping (tetap di controller)
    public function ping($id)
    {
        $website = $this->dataModel->getById($id);

        if (!$website) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Website tidak ditemukan'
            ]);
        }

        $host = escapeshellarg($website['alamat_web']);

        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
        $pingCommand = $isWindows
            ? "ping -n 4 $host"
            : "ping -c 4 $host 2>&1";

        $pingResult = @shell_exec($pingCommand);

        if (!$pingResult) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Ping gagal dijalankan.'
            ]);
        }

        $pingLines = explode("\n", trim($pingResult));

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => $pingLines
        ]);
    }
}
