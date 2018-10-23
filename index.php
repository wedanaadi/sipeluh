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
                // $id = $_GET['id'];
                // $teknisi->edit($id);
                echo "ubah";
            }
            else if($page==="delete")
            {
                // $id = $_POST['id_pelanggan'];
                // $teknisi->destroy($id);
            }
            else
            {
                $teknisi->index();
                // echo "aa";
            }
            break;
        
        default:
            echo "oke";
            break;
    }
?>