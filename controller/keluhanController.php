<?php
include("model/Keluhan.php");
class keluhanController
{
    public $model;

    public function __construct()
    {
        $this->model = new Keluhan();
        session_start();
        if(!isset($_SESSION['login_id']))
        {
            header("Location: index.php");
        }
    }

    public function index()
    {
        $keluhan = $this->model->selectAll($_SESSION['login_hk'], $_SESSION['login_id']);
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
           'id_user' => $_SESSION['login_id'],
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
            'id_user' => $_SESSION['login_id'],
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

    public function save_manajemen()
    {

        for ($i=0; $i < count($_POST['id']); $i++) {
            $data = [
                'id_keluhan' => $_POST['id'][$i],
                'id_teknisi' => $_POST['teknisi_id'],
                'tanggal_manajemen' => date('Y-m-d H:i:s'),
            ];

            $id = $_POST['id'][$i];
            $this->model->update('t_keluhan',['status_keluhan' => '1'],"id='$id'");
            $execute = $this->model->insert('t_keluhan_manajemen',$data);
        }

        if($execute == 'true')
        {
            echo json_encode(['aksi' => true, 'message' => 'Berhasil Ms', 'title' => 'Ye... Berhasil', 'type' => 'success', 'teknisi' => $_POST['teknisi_id']]);
        }
        else
        {
            echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
        }
    }

    public function update_teknisi()
    {
        $id = $_POST['id_teknisi'];
        $sql = "UPDATE m_teknisi SET status = 2 WHERE id = '$id'";
        $this->model->db_query($sql);
    }

    public function listBy()
    {
        $id_user = $_SESSION['login_id'];
        $sql = "SELECT id_biodata FROM m_user WHERE id = '$id_user'";
        $result = $this->model->db_query($sql);
        $id_teknisi = $result[0]['id_biodata'];
        $sql_list = "SELECT `t_keluhan_manajemen`.*, DATE_FORMAT(`tanggal_manajemen`, '%Y-%m-%d') AS 'date',
                    m_teknisi.`nama_teknisi`, `t_keluhan`.`nama_keluhan`, m_kategori_keluhan.`kategori`
                    FROM `t_keluhan_manajemen`
                    INNER JOIN m_teknisi ON `m_teknisi`.`id` = `t_keluhan_manajemen`.`id_teknisi`
                    INNER JOIN t_keluhan ON `t_keluhan`.`id` = `t_keluhan_manajemen`.`id_keluhan`
                    INNER JOIN m_kategori_keluhan ON m_kategori_keluhan.`id` = `t_keluhan`.`id_kategori`
                    WHERE `t_keluhan_manajemen`.`status` = '0' AND id_teknisi = '$id_teknisi'";

        $sql_list2 = "SELECT `t_keluhan_manajemen`.*, DATE_FORMAT(`tanggal_manajemen`, '%Y-%m-%d') AS 'date',
                    m_teknisi.`nama_teknisi`, `t_keluhan`.`nama_keluhan`, m_kategori_keluhan.`kategori`
                    FROM `t_keluhan_manajemen`
                    INNER JOIN m_teknisi ON `m_teknisi`.`id` = `t_keluhan_manajemen`.`id_teknisi`
                    INNER JOIN t_keluhan ON `t_keluhan`.`id` = `t_keluhan_manajemen`.`id_keluhan`
                    INNER JOIN m_kategori_keluhan ON m_kategori_keluhan.`id` = `t_keluhan`.`id_kategori`
                    WHERE `t_keluhan_manajemen`.`status` != '0' AND id_teknisi = '$id_teknisi'
                    ORDER BY `t_keluhan_manajemen`.`status` DESC";

        $list_belum = $this->model->db_query($sql_list);
        $list_sudah = $this->model->db_query($sql_list2);
        include('view/keluhan/forteknisi.php');
    }

    public function for_teknisi()
    {
      // print_r(count($_POST['id'])); exit();
        for ($i=0; $i < count($_POST['id']); $i++)
        {
            $id = $_POST['id'][$i];
            $status = $_POST['tanggapi'];
            $sql = "UPDATE t_keluhan_manajemen SET status = '$status' WHERE id = '$id'";
            $execute = $this->model->execute($sql);
        }

        if($execute == 'true')
        {
            echo json_encode(['aksi' => true, 'message' => 'Berhasil Menanggapi', 'title' => 'Ye... Berhasil', 'type' => 'success']);
        }
        else
        {
            echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
        }
    }

    public function for_keluhan_pending()
    {
        $id = $_POST['id'];
        $execute = $this->model->update('t_keluhan_manajemen',['status' => 1],"id='$id'");
        if($execute == 'true')
        {
            echo json_encode(['aksi' => true, 'message' => 'Berhasil Mengubah', 'title' => 'Ye... Berhasil', 'type' => 'success']);
        }
        else
        {
            echo json_encode(['aksi' => false, 'message' => $execute, 'title' => 'Oops... Gagal', 'type' => 'error']);
        }
    }

    public function cetak()
    {
      $keluhan = $this->model->laporandata();
      include('view/keluhan/laporan.php');
    }

    public function __destruct(){
    }
}
?>
