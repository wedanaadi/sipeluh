<?php
    $module = $_POST['module'];
    $type = $_POST['type'];

    switch ($module) {
        case 'pelanggan':
            include("controller/pelangganController.php");
            $pelanggan = new pelangganController();

            if($type == 'tambah')
            {
                $data = [
                    'id' => @$_POST['id'],
                    'nama' => @$_POST['nama'],
                    'alamat' => @$_POST['alamat'],
                    'no_telp' => @$_POST['telepon'],
                    'email' => @$_POST['email'],
                ];

                $pelanggan->store($data);
            }
            else if($type == 'ubah')
            {
                $data = [
                    'nama' => @$_POST['nama'],
                    'alamat' => @$_POST['alamat'],
                    'no_telp' => @$_POST['telepon'],
                    'email' => @$_POST['email']
                ];
                $id = $_POST['id'];

                $pelanggan->update($id,$data);
            }
            break;
        
        case 'teknisi':
            include("controller/teknisiController.php");
            $teknisi = new teknisiController();

            if($type == 'tambah')
            {
                $data = [
                    'id' => @$_POST['id'],
                    'nama_teknisi' => @$_POST['nama'],
                    'alamat' => @$_POST['alamat'],
                    'no_telepon' => @$_POST['telepon'],
                    'email' => @$_POST['email'],
                ];

                $teknisi->store($data);
            }
            else if($type == 'ubah')
            {
                $data = [
                    'nama_teknisi' => @$_POST['nama'],
                    'alamat' => @$_POST['alamat'],
                    'no_telepon' => @$_POST['telepon'],
                    'email' => @$_POST['email'],
                ];
                $id = $_POST['id'];

                $teknisi->update($data,$id);
            }

            break;
        
        case 'kategori_keluhan':
            include("controller/kategoriKeluhanController.php");
            $katkel = new kategoriKeluhanController();

            if($type == 'tambah')
            {
                $data = [
                    'kategori' => @$_POST['kategori'],
                ];

                $katkel->store($data);
            }
            else if($type == 'ubah')
            {
                $data = [
                    'kategori' => @$_POST['kategori'],
                ];
                
                $id = $_POST['id'];

                $katkel->update($data,$id);
            }

            break;
        
        default:
            echo "404";
            break;
    }
?>