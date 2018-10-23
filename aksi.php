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
        
        default:
            echo "404";
            break;
    }
?>