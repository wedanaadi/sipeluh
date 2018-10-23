<?php 
    include("view/layouts/bag1.php");
?>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Data Teknisi</h3>
            <div class="box-tools">
                <a href="<?php echo BASE_URL."?p=tambah&m=teknisi" ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"><span> Tambah</span></i></a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">No.</th>
                            <th>Nama Teknisi</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th style="width: 70px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i=1;
                            foreach ($teknisi as $key => $row) {
                        ?>
                        <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['nama_teknisi'] ?></td>
                                <td><?php echo $row['alamat'] ?></td>
                                <td><?php echo $row['no_telepon'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td align="center">
                                    <a href="<?php echo '?page=ubah&module=teknisi&id=' ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo '?page=hapus&module=teknisi&id=' ?>" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                </td>
                        </tr>
                        <?php
                                $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php 
    include("view/layouts/bag2.php");
?>