<?php
    include("model/Pelanggan.php");
    class pelangganController
    {
        public $model;

        public function __construct()
        {
            $this->model = new Pelanggan();
            session_start();
            if(!isset($_SESSION['login_id']))
            {
                header("Location: index.php");
            }
        }

        public function index()
        {
          if($_SESSION['login_hk'] != 1)
          {
            header("Location: index.php?m=403");
          }

            $pelanggan =  $this->model->selectAll();
            include("view/pelanggan/index.php");
        }

        public function create()
        {
          if($_SESSION['login_hk'] != 1)
          {
            header("Location: index.php?m=403");
          }
            $idOtomatis = $this->model->selectMaxKode();
            include("view/pelanggan/tambah.php");
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
          if($_SESSION['login_hk'] != 1)
          {
            header("Location: index.php?m=403");
          }

            $result = $this->model->get("m_pelanggan","id = '$id'");
            $data = $result[0];
            include("view/pelanggan/edit.php");
        }

        public function update($id,$data)
        {
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

        public function destroy($id)
        {
            $execute = $this->model->update('m_pelanggan',['flag_status' => 0], "id='$id'");
            if($execute == 'true')
            {
                echo json_encode(['aksi' => true, 'message' => 'Berhasil Menghapus', 'title' => 'Ye... Berhasil', 'type' => 'success']);
            }
            else
            {
                echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
            }
        }

        public function cetak()
        {
          if($_SESSION['login_hk'] != 4)
          {
            header("Location: index.php?m=403");
          }
          $pelanggan =  $this->model->selectAll();
          include("view/pelanggan/laporan.php");
        }

        function __destruct(){
        }
    }
?>
