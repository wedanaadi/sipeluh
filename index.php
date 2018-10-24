<?php
    error_reporting(0);

    $page = $_GET['p'];
    $modul = $_GET['m'];

    $base_url = define('BASE_URL', 'http://localhost/sipeluh/index.php');

    switch ($modul) {
        case 'pelanggan':
            include("controller/pelangganController.php");
            $pelanggan = new pelangganController();
            if($page==="tambah")
            {
                $pelanggan->create();
            }
            else if($page==="ubah")
            {
                $id = $_GET['id'];
                $pelanggan->edit($id);
            }
            else if($page==="delete")
            {
                $id = $_POST['id_pelanggan'];
                $pelanggan->destroy($id);
            }
            else
            {
                $pelanggan->index();
            }
            break;

        case 'teknisi':
            include("controller/teknisiController.php");
            $teknisi = new teknisiController();
            if($page==="tambah")
            {
                $teknisi->create();
            }
            else if($page==="ubah")
            {
                $id = $_GET['id'];
                $teknisi->edit($id);
            }
            else if($page==="delete")
            {
                $id = $_POST['id_teknisi'];
                $teknisi->destroy($id);
            }
            else
            {
                $teknisi->index();
                // echo "aa";
            }
            break;
        
        case 'kategorikeluhan': 
            include("controller/kategoriKeluhanController.php");
            $katkel = new kategoriKeluhanController();
            if($page==="tambah")
            {
                $katkel->create();
            }
            else if($page==="ubah")
            {
                $id = $_GET['id'];
                $katkel->edit($id);
            }
            else if($page==="delete")
            {
                // $id = $_POST['id_teknisi'];
                // $teknisi->destroy($id);
            }
            else
            {
                $katkel->index();
            }
            break;
        
        case 'user': 
            include("controller/userController.php");
            $user = new userController();
            $user->index();
            break;

        default:
            echo "oke";
            break;
    }
?>