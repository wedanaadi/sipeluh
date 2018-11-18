<?php include("view/layouts/bag1.php") ?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Data Keluhan</h3>
            <div class="box-tools">
            <?php if($_SESSION['login_hk'] == 3) { ?> 
                <a href="<?php echo BASE_URL."?p=tambah&m=keluhan" ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"><span> Tambah</span></i></a>
            <?php } ?>
            <?php if($_SESSION['login_hk'] == 1) { ?>
                <a href="" id="save_manajemen" class="berikan btn btn-success btn-sm"><span>Tugaskan </span><i class="fa fa-hand-o-down"></i></a>
            <?php } ?>
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
                                <?php if($_SESSION['login_hk'] == 3) { ?>
                                    <a href="<?php echo BASE_URL.'?p=ubah&m=keluhan&id='.$value['id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php } ?>

                                <?php if($_SESSION['login_hk'] == 1) { ?>
                                    <input type="checkbox" name="aksi[]" id="checked" value="<?php echo $value['id'] ?>">
                                <?php } ?>
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
    $('#save_manajemen').addClass('disabled');
    $("#table").DataTable();
    $('select[name=teknisi]').select2();
    $('.berikan').on('click',function(e){
        if(!e.isDefaultPrevented())
        {
            // var id = $(this).attr('id-K');
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
                    if(obj.length > 0)
                    {
                        $('select[name=teknisi]').val(obj[0].id).trigger('change');
                        for (let i = 0; i < obj.length; i++) {
                            options += "<option value='"+obj[i].id+"'>"+obj[i].nama_teknisi+"</option>";                      
                        }
                        $('select[name=teknisi]').append(options);
                        $('#modalForm').modal('show');
                    }
                    else
                    {
                        swal({
                            title: "Oops",
                            text: "Semua Teknisi sudah mempunyai Tugas",
                            type: "error",
                            showConfirmButton: true
                        });
                    }
                }
            });
        }
        return false;
    });

    $('#modalForm form').on('submit',function(e){
        if(!e.isDefaultPrevented())
        {
            $('#modalForm').modal('hide');
            let pilihan = $('input[name="aksi[]"]:checked').map(function(){
                return this.value;
            }).get();
            
            var _data = {
                module: 'keluhan', 
                type: 'manajemen_keluhan', 
                id: pilihan,
                teknisi_id: $('select[name=teknisi]').val()
            };

            console.log(_data);

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
                        var _dataAksi = {
                            module: 'keluhan', 
                            type: 'update_status_teknisi',
                            id_teknisi: obj.teknisi
                        };
                        $.ajax({
                            url: "aksi.php",
                            type: "POST",
                            method: "POST",
                            data: _dataAksi,
                            success: function(msg)
                            {
                                window.location.href = "<?php echo BASE_URL. '?m=keluhan' ?>";
                            }
                        });
                    });
                }
            });
        }
        return false;
    });

    var checkbox = $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('input').on('ifChecked ifUnchecked', function(){
        let jumlah = $('input[name="aksi[]"]:checked').length;
        if(jumlah > 0)
        {
            $('.berikan').removeClass('disabled');
        }
        else
        {
            $('.berikan').addClass('disabled');
        }
    });
</script>