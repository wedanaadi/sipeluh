<?php
include("model/KategoriKeluhan.php");
class kategoriKeluhanController
{
    public $model;

    public function __construct()
    {
        $this->model = new KategoriKeluhan();
        session_start();
        if(!isset($_SESSION['login_id']))
        {
            header("Location: index.php");
        }
    }

    public function index()
    {
        $katkel = $this->model->get('m_kategori_keluhan');
        include("view/kategori_keluhan/view.php");
    }

    public function create()
    {
        include("view/kategori_keluhan/view_add.php");
    }

    public function store($data)
    {
        $execute = $this->model->insertDB($data);
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
        $result = $this->model->get('m_kategori_keluhan',"id = '$id'");
        $data = $result[0];
        include("view/kategori_keluhan/view_edit.php");
    }

    public function update($data,$id)
    {
        $execute = $this->model->updateDB($data,$id);
        if($execute == 'true')
        {
            echo json_encode(['aksi' => true, 'message' => 'Berhasil Mengubah', 'title' => 'Ye... Berhasil', 'type' => 'success']);
        }
        else
        {
            echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
        }
    }
}
?>