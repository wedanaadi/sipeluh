<?php
include("model/Keluhan.php");
class keluhanController
{
    public $model;

    public function __construct()
    {
        $this->model = new Keluhan();
    }

    public function index()
    {
        $keluhan = $this->model->selectAll();
        include("view/keluhan/view.php");
    }

    public function create()
    {
        $pelanggan = $this->model->get('m_pelanggan');
        $kategori = $this->model->get('m_kategori_keluhan');
        include("view/keluhan/view_add.php");
    }

    public function store()
    {
       $data = [
           'id_user' => '1',
           'id_pelanggan' => $_POST['pelanggan'],
           'id_kategori' => $_POST['kategori'],
           'nama_keluhan' => $_POST['keluhan'],
           'tanggal_pencatatan' => date('Y-m-d'),
       ];

       $execute = $this->model->insert('t_keluhan',$data);
       if($execute == 'true')
       {
           echo json_encode(['aksi' => true, 'message' => 'Berhasil Menambah', 'title' => 'Ye... Berhasil', 'type' => 'success']);
       }
       else
       {
           echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
       }
    }

    public function edit($id)
    {
        $pelanggan = $this->model->get('m_pelanggan');
        $kategori = $this->model->get('m_kategori_keluhan');
        $keluhan = $this->model->getEdit($id);
        include("view/keluhan/view_edit.php");
    }

    public function update($id)
    {
        $data = [
            'id_user' => '1',
            'id_pelanggan' => $_POST['pelanggan'],
            'id_kategori' => $_POST['kategori'],
            'nama_keluhan' => $_POST['keluhan']
        ];

        $execute = $this->model->updateDB($id,$data);
        if($execute == 'true')
        {
            echo json_encode(['aksi' => true, 'message' => 'Berhasil Mengubah', 'title' => 'Ye... Berhasil', 'type' => 'success']);
        }
        else
        {
            echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
        }
    }

    public function getActiveTeknisi()
    {
        $result = $this->model->selectteknisi();
        echo json_encode($result);
    }

    public function __destruct(){
    }
}
?>