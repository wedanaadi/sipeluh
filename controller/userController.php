<?php
session_start();
include("model/User.php");
class userController
{
    public $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $user = $this->model->selectAll();
        include("view/user/view.php");
    }

    public function create()
    {
        $hk_list = $this->model->getHakAkses("id != 3 AND id != 4");
        $teknisi = $this->model->getTeknisi();
        include("view/user/view_add.php");
    }

    public function store($aksi)
    {
        if($aksi == 'for_karyawan')
        {
            $idBiodata = null;
            if($_POST['hk'] == 1)
            {
                $idBiodata = '-';
            }
            else
            {
                $idBiodata = $_POST['id_tek'];
            }

            $username_already = $this->model->cek_same_username($_POST['username']);
            if($username_already > 0)
            {
                echo json_encode(['aksi' => false, 'message' => 'Username Sudah digunakan!', 'title' => 'OOPS...', 'type' => 'error']);
            }
            else
            {
                $id_already = $this->model->cek_idbiodata_teknisi($idBiodata);
                if($id_already > 0)
                {
                    echo json_encode(['aksi' => false, 'message' => 'Teknisi Sudah memiliki Akun!', 'title' => 'OOPS...', 'type' => 'error']);
                }
                else
                {
                    $data = [
                        'username' => $_POST['username'],
                        'password' => $_POST['password'],
                        'hak_akses' => $_POST['hk'],
                        'email' => $_POST['email'],
                        'id_biodata' => $idBiodata,
                    ];
                    $this->model->insertDB($data);
                    echo json_encode(['aksi' => true, 'message' => 'Berhasil Menambah!', 'title' => 'Ye...', 'type' => 'success']);
                }
            }
        }
        else
        {
            echo "pel";
        }
    }

    public function edit($id)
    {
        $hk_list = $this->model->getHakAkses();
        $teknisi = $this->model->getTeknisi();
        $result = $this->model->findBy("id='$id'");
        $data = $result[0];
        include("view/user/view_edit.php");
    }

    public function update($id)
    {
        $idBiodata = null;
        if($_POST['hk'] == 1)
        {
            $idBiodata = '-';
        }
        else if($_POST['hk'] == 3)
        {
            $idBiodata = '0';
        }
        else
        {
        $idBiodata = $_POST['id_tek'];
        }

        $username_already = count($this->model->get('m_user', 'username = "'.$_POST['username'].'" AND id != "'.$_POST['id'].'"'));
        if($username_already > 0)
        {
            echo json_encode(['aksi' => false, 'message' => 'Username Sudah digunakan!', 'title' => 'OOPS...', 'type' => 'error']);
        }
        else
        {
            $id_already = count($this->model->get('m_user','id_biodata = "'.$idBiodata.'" AND id != "'.$_POST['id'].'"'));
            if($id_already > 0)
            {
                echo json_encode(['aksi' => false, 'message' => 'Teknisi Sudah memiliki Akun!', 'title' => 'OOPS...', 'type' => 'error']);
            }
            else
            {
                $data = [
                    'username' => @$_POST['username'],
                    'password' => @$_POST['password'],
                    'hak_akses' => @$_POST['hk'],
                    'email' => @$_POST['email'],
                    'id_biodata' => $idBiodata,
                ];
                $this->model->updateDB($data,$id);
                echo json_encode(['aksi' => true, 'message' => 'Berhasil Mengubah!', 'title' => 'Ye...', 'type' => 'success']);
            }
        }
    }

    public function auth()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username != '' and $password != '')
        {
            $result = $this->model->get('m_user',"username = '$username' AND password = '$password' AND isAktif = '1'");
            $rownum = count($result);
            if($rownum > 0)
            {
                $data = [
                    'sukses' => true
                ];

                $_SESSION['login_id'] = $result[0]['id'];
                $_SESSION['login_hk'] = $result[0]['hak_akses'];
                echo json_encode($data);
            }
            else
            {
                $data = [
                    'sukses' => false
                ];

                echo json_encode($data);
            }
        }
    }

    public function userAuth($id)
    {
        $data = $this->model->get("m_user","id='$id'");
        return $userAuth = $data[0];
    }

    public function getTeknisiById($id)
    {
        $data = $this->model->get("m_teknisi","id='$id'");
        return $data[0];
    }

    public function cek_username_already($username)
    {
        return $data = $this->model->cek_same_username($username);
    }

    public function userPelanggan()
    {
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'hak_akses' => '3',
            'email' => $_POST['email'],
            'id_biodata' => '0',
        ];
        $this->model->insertDB($data);
        $result = $this->model->findBy("username = '".$_POST['username']."' ");
        $_SESSION['login_id'] = $result[0]['id'];
        $_SESSION['login_hk'] = $result[0]['hak_akses'];
        echo json_encode(['aksi' => true, 'message' => 'Berhasil Terdaftar!', 'title' => 'Ye...', 'type' => 'success']);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $execute = $this->model->update('m_user',['isAktif' => 0],"id='$id'");
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
