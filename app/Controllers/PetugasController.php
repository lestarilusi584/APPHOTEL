<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Petugas;
use App\Models\Kamar;
use App\Models\TipeKamar;

class PetugasController extends BaseController
{
    public function index()
    {
        return view('login');
    }
    public function login()
    {
        $Datapetugas =  new Petugas;
        $syarat = [
            'username' =>
            $this->request->getPost('txtUsername'),
            'password' =>
            md5($this->request->getPost('txtPassword'))
        ];
        $Userpetugas =
            $Datapetugas->where($syarat)->find();
        if (count($Userpetugas) == 1) {
            $session_data = [
                'username' => $Userpetugas[0]['username'],
                'id_petugas' => $Userpetugas[0]['id_petugas'],
                'level' => $Userpetugas[0]['level'],
                'sudahkahLogin' => TRUE
            ];
            session()->set($session_data);
            return redirect()->to('/petugas/dashboard');
        } else {
            return redirect()->to('/petugas');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/petugas');
    }
    public function tampilKamar()
    {
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }
        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }
        $Datakamar = new Kamar;
        $data['ListKamar'] = $Datakamar
        ->join('tipe_kamar', 'tipe_kamar.id_tipe_kamar = kamar.id_tipe_kamar')
        ->get()
        ->getResult('array');
        return view('Kamar/tampil-kamar', $data);
    } 
    public function tambahKamar()
    {
        // ambil data tipe kamar
        $tipe_kamar = (new TipeKamar)
            ->findAll();
        $data['tipe_kamar'] = $tipe_kamar;
        return view('Kamar/tambah-kamar', $data);
    }
    public function simpanKamar(){
        helper(['form']);
        $dataKamar = new Kamar;
        $upload = $this->request->getFile('txtInputFoto');
        $upload->move(WRITEPATH . '../public/gambar/');
        $datanya = [
            'id_kamar' => $this->request->getPost('txtIdKamar'),
            'nomor_kamar' => $this->request->getPost('txtNoKamar'),
            'id_tipe_kamar' => $this->request->getPost('txtInputTipeKamar'),
            'deskripsi' => $this->request->getPost('txtInputDeskripsi'),
            'foto' => $upload->getName()
        ];
        $dataKamar->insert($datanya);
        return redirect()->to('/kamar');
    }
    public function editKamar($idKamar)
    {
        $tipe_kamar = (new TipeKamar)
            ->findAll();
        $data['tipe_kamar'] = $tipe_kamar;
        $dataKamar = new Kamar;
        $dataKamar->join('tipe_kamar', 'tipe_kamar.id_tipe_kamar=kamar.id_tipe_kamar' );
        $data['detailKamar'] = $dataKamar->where('id_kamar', $idKamar)->findAll();
        return view('Kamar/edit-kamar', $data);
    }
    public function editFoto($idKamar)
    {
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }
        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }
        $dataKamar = new Kamar;
        $data['detailKamar'] = $dataKamar->where('id_kamar', $idKamar)->findAll();
        return view('Kamar/update-foto', $data);
    }
    public function updateKamar()
    {
        // cek apakah sudah login
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }
        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }
        helper(['form']);
        $dataKamar = new Kamar;
        $data = [
            'id_tipe_kamar' => $this->request->getPost('txtInputTipeKamar'),
            'deskripsi' => $this->request->getPost('txtInputDeskripsi')
        ];
        $dataKamar
        ->where('id_kamar',$this->request->getPost('txtId'))
        ->set($data)
        ->update();
        return redirect()->to('/kamar');
    }
    public function updateFoto()
    {
        
        $DataKamar = new Kamar;
        helper(['form']);
        $syarat = $this->request->getPost('foto');
        unlink('gambar/' . $syarat);

        $upload = $this->request->getFile('txtFoto');
        $upload->move(WRITEPATH . '../public/gambar/');
        
        $data = ['foto' => $upload->getName()];
        $DataKamar
        ->where('id_kamar',$this->request->getPost('txtId'))
        ->set($data)
        ->update();

        return redirect()->to('/kamar')->with('berhasil','Data Berhasil di Update');
    }
    public function hapusKamar($idKamar)
    {
        $kamar = new Kamar();
        $syarat = ['id_kamar' => $idKamar];
        $infoFile = $kamar->where($syarat)->find();
        //hapus foto
        if(file_exists('gambar/'. $infoFile[0]['foto'])){
            
            unlink('gambar/' . $infoFile[0]['foto']);
        }
        //hapus data didatabase
        $kamar->where('id_kamar', $idKamar)->delete();
        return redirect()->to('/kamar')->with('berhasil', 'Data Berhasil di Hapus');
    }
}