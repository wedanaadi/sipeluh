<?php include("view/layouts/bag1.php") ?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Data User</h3>
            <div class="box-tools">
                <a href="<?php echo BASE_URL."?p=tambah&m=user" ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"><span> Tambah</span></i></a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">No.</th>
                            <th>Username</th>
                            <th>Hak Akses</th>
                            <th style="width: 50px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            foreach ($user as $key => $row) {
                        ?>
                        <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['nama_hak_akses'] ?></td>
                                <td align="center">
                                    <a href="<?php echo BASE_URL.'?p=ubah&m=user&id='.$row['id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="" id-K="<?php echo $row['id'] ?>" class="delete btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                </td>
                        </tr>
                        <?php
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include("view/layouts/bag2.php") ?>
<script>
    $('#table').DataTable();

    $('.delete').on('click',function(e){
        id = $(this).attr('id-K');
        if(!e.isDefaultPrevented())
        {
            swal({
            title: "Apakah Kamu Yakin?",
            text: "Non Aktifkan User!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm) {
            if(isConfirm) {
                let _data = {
                    module: 'user',
                    type: 'hapus',
                    id: id,
                };

                $.ajax({
                    url: "aksi.php",
                    type: "POST",
                    method: "POST",
                    data: _data,
                    success: function(data)
                    {
                        obj = JSON.parse(data);
                        swal({
                            title: obj.title,
                            text: obj.message,
                            type: obj.type,
                            showConfirmButton: true
                        }, function(){
                                window.location.href = "<?php echo BASE_URL. '?m=user' ?>";
                        });
                    }
                });
            } else {
                swal({
                    title: "Dibatalkan!",
                    text: "Aksi dibatalkan..",
                    type: "error",
                    showConfirmButton: false,
                    timer: 1000
                    });
            }
            });
        }
        return false;
    });
</script>
