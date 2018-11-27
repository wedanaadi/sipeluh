<?php
session_start();
if(!isset($_SESSION['login_id']))
{
    header("Location: index.php");
}
else
{
    include("controller/userController.php");
    $authentication = new userController();
    $session_data = $authentication->userAuth($_SESSION['login_id']);
    $hak_akses = $session_data['hak_akses'];
    $id_bio = $session_data['id_biodata'];
    if($hak_akses == '1')
    {
        $nama = "Admin";
    }
    else if($hak_akses == '2')
    {
        $data = $authentication->getTeknisiById($session_data['id_biodata']);
        $nama = $data['nama_teknisi'];
    }
    elseif ($hak_akses == '4') {
      $nama = "Pemilik";
    }
    else
    {
        $nama = "Pelanggan";
    }
    // print_r($data); exit();
}
include('view/layouts/bag1.php');
?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Dashboard</h3>
        </div>
        <div class="box-body">
        Hello, Selamat datang <?php echo $nama ?>
        </div>
    </div>
</section>
<?php include('view/layouts/bag2.php'); ?>
