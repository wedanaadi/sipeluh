<?php
include("model/Teknisi.php");
class teknisiController
{
    public $model;

    public function __construct()
    {
        $this->model = new Teknisi();
    }

    public function index()
    {
        $teknisi = $this->model->selectAll();
        include('view/teknisi/view.php');
    }

    public function create()
    {
        $idOtomatis = $this->model->selectMaxKode();
        include("view/teknisi/view_add.php");
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
        $result = $this->model->get('m_teknisi',"id= '$id'");
        $data = $result[0];
        include("view/teknisi/view_edit.php");
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

    public function destroy($id)
    {
        $execute = $this->model->update('m_teknisi',['status' => 0], "id='$id'");
        if($execute == 'true')
        {
            echo json_encode(['aksi' => true, 'message' => 'Berhasil Menghapus', 'title' => 'Ye... Berhasil', 'type' => 'success']);
        }
        else
        {
            echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
        }
    }

    function __destruct(){
    }
}
?>