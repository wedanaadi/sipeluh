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

        case 'user':
            include("controller/userController.php");
            $user = new userController();
            if($type == 'tambah_karyawan')
            {
                $user->store("for_karyawan");
            }
            else
            {
                $id = $_POST['id'];
                $user->update($id);
            }
            break;

        case 'auth': 
            include("controller/userController.php");
            $user = new userController();
            if($type == 'auth')
            {
                $user->auth();
            }
            else if($type == 'reg_already')
            {
                echo $user->cek_username_already($_POST['username']);
            }
            else if($type == 'add_pelanggan')
            {
                $user->userPelanggan();
            }
            break;

        case 'keluhan':
            include("controller/keluhanController.php");
            $keluhan = new keluhanController();
            if($type == 'tambah')
            {
                $keluhan->store();
            }
            else if($type == 'ubah')
            {
                $id = $_POST['id'];
                $keluhan->update($id);
            }
            else if($type == 'manajemen')
            {
               $keluhan->getActiveTeknisi();
            }
            break;
        
        default:
            echo "404";
            break;
    }
?>