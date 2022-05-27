<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FasilitasHotel;

class FasilitasHotelController extends BaseController
{
    public function index()
    {
        //
    }
    public function tampilfasilitashotel()
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
        $Datafasilitashotel = new FasilitasHotel;
        $data['ListFasilitasHotel'] = $Datafasilitashotel->findAll();
        return view('Fasilitas_Hotel/tampil-fasilitas-hotel', $data);
    }
    public function tambahfasilitashotel()
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
        return view('Fasilitas_Hotel/tambah-fasilitas-hotel',);
    }
    public function simpanfasilitashotel()
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
        helper(['form']);
        $DataFasilitasHotel = new FasilitasHotel();
        $upload= $this->request->getFile('txtInputFoto');
        $upload->move(WRITEPATH . '../public/gambar/');
        $datanya = [
            'nama_fasilitas_umum' => $this->request->getPost('txtnamafasilitas'),
            'foto'=> $upload->getName(),
            'deskripsi' => $this->request->getPost('txtinputdeskripsi')
        ];
        $DataFasilitasHotel->insert($datanya);
        return redirect()->to('/fasilitas-hotel/tampil');
    }
    public function editfasilitashotel($id_fasilitas_umum)
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
        $datafasilitashotel = new FasilitasHotel();
        $data['detailFasilitasHotel'] = $datafasilitashotel->where('id_fasilitas_umum', $id_fasilitas_umum)->findAll();
        return view('Fasilitas_Hotel/edit-fasilitas-hotel', $data);
    }
    public function editFoto($id_fasilitas_umum)
{
    // cek apakah sudah login ?
    if (!session()->get('sudahkahLogin')) {
        return redirect()->to('/petugas');
        exit;
    }
    // cek apakah yang login bukan admin ?
    if (session()->get('level') != 'admin') {
        return redirect()->to('/petugas/dashboard');
        exit;
}
    $dataFasilitasHotel = new FasilitasHotel;
    $data['detailFasilitasHotel'] = $dataFasilitasHotel->where('id_fasilitas_umum', $id_fasilitas_umum)->findAll();
    return view('Fasilitas_Hotel/update-foto', $data);
}
    public function updatefasilitashotel()
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
        helper(['form']);
        $data = [
            
            'nama_fasilitas_umum' => $this->request->getPost('txtnamafasilitas'),
            'deskripsi'=> $this->request->getPost('txtInputDeskripsi')
        ];
        $fasilitashotel = new FasilitasHotel();
        // $fasilitashotel->update($this->request->getPost('txtidfasilitas'), $data);
        $fasilitashotel->update($this->request->getPost('txtnamafasilitas'), $data);
        return redirect()->to('/fasilitas-hotel/tampil')->with('berhasil', 'Data Berhasil di Update');
    }
    public function updateFoto(){
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
    }
    // cek apakah yang login bukan admin ?
    if (session()->get('level') != 'admin') {
        return redirect()->to('/petugas/dashboard');
        exit; 
    }
        helper(['from']);
        $syarat=$this->request->getPost('tfoto');
        unlink('gambar/'.$syarat);
        $upload = $this->request->getFile('txtInputFoto');
        $upload->move(WRITEPATH . '../public/gambar/');
        $data=['foto' => $upload->getName()];
        $dataFasilitasHotel = new FasilitasHotel();
        $dataFasilitasHotel->update($this->request->getPost('txtnamafasilitas'),$data);
        return redirect()->to('/fasilitas-hotel/tampil')->with('berhasil', 'Data Berhasil di Update');
}
    public function hapusfasilitashotel($id_fasilitas_umum)
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
        $fasilitashotel = new FasilitasHotel();
        $syarat = ['id_fasilitas_umum' => $id_fasilitas_umum];
        $infoFile = $fasilitashotel->where($syarat)->find();
        //hapus data didatabase
        $fasilitashotel->where('id_fasilitas_umum', $id_fasilitas_umum)->delete();
        return redirect()->to('/fasilitas-hotel/tampil')->with('berhasil', 'Data Berhasil di Hapus');
    }
}
