<?php include("view/layouts/bag1.php") ?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Data Keluhan</h3>
            <div class="box-tools">
                <a href="<?php echo BASE_URL."?p=tambah&m=keluhan" ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"><span> Tambah</span></i></a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">No.</th>
                            <th>Pelanggan</th>
                            <th>Kategori Keluhan</th>
                            <th>Nama Keluhan</th>
                            <th style="width: 70px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i=1;
                            foreach ($keluhan as $key => $value) {
                        ?>
                        <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $value['nama'] ?></td>
                                <td><?php echo $value['kategori'] ?></td>
                                <td><?php echo $value['nama_keluhan'] ?></td>
                                <td align="center">
                                    <a href="<?php echo BASE_URL.'?p=ubah&m=keluhan&id='.$value['id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="" id-K="<?php echo $value['id'] ?>" class="berikan btn btn-success btn-xs"><i class="fa fa-hand-o-right"></i></a>
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

<div class="modal fade" id="modalForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" autocomplete="off" action="" method="post">
            <input type="hidden" name="id" id="id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center">Title</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="control-label">Teknisi</label>
                    <select name="teknisi" style="width:100%;" class="form-control"></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i><span> Save</span></button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include("view/layouts/bag2.php") ?>

<script>
    $("#table").DataTable();
    $('select[name=teknisi]').select2();
    $('.berikan').on('click',function(e){
        if(!e.isDefaultPrevented())
        {
            var id = $(this).attr('id-K');
            $.ajax({
                url: "aksi.php",
                type: "POST",
                method: "POST",
                data: {module: 'keluhan', type: 'manajemen'},
                success: function(data)
                {
                    $('#modalForm form')[0].reset();
                    $('input[name=id]').val(id);
                    $('.modal-title').text('Manajemen Keluhan');
                    var options = '';
                    var obj = JSON.parse(data);
                    for (let i = 0; i < obj.length; i++) {
                        options += "<option value='"+obj[i].id+"'>"+obj[i].nama_teknisi+"</option>";                      
                    }
                    $('select[name=teknisi]').append(options);
                    $('#modalForm').modal('show');
                }
            });
        }
        return false;
    });

    $('#modalForm form').on('submit',function(e){
        if(!e.isDefaultPrevented())
        {
            alert('oke');
        }
        return false;
    });
</script>