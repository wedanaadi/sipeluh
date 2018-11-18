<?php include("view/layouts/bag1.php") ?>
<section class="content">
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List Tugas Keluhan</h3>
                <div class="box-tools">
                <a href="" class="Tanggapi btn btn-success btn-sm"><span>Aksi Tugas </span><i class="fa fa-hand-o-right"></i></a>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Tugas</th>
                                <th>Keluhan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach ($list_belum as $value) { 
                            ?>
                            <tr>
                                <td width='20px'><?php echo $no; ?></td>
                                <td width='130px'><?php echo $value['date']; ?></td>
                                <td><?php echo $value['nama_keluhan']; ?></td>
                                <td width='20px' align="center">
                                    <input type="checkbox" name="aksi[]" id="checked" value="<?php echo $value['id'] ?>">
                                </td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Keluhan Selesai & Pending</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="table2" class="table table-bordered table-striped">
                       <thead>
                            <tr>
                                <td>No.</td>
                                <td>Keluhan</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                       </thead>
                       <tbody>
                            <?php 
                                $no = 1;
                                foreach ($list_sudah as $value) { 
                            if($value['status'] == 1){
                            ?>
                            <tr style="background:#00a65a; color:#fff">
                                <td width='20px'><?php echo $no; ?></td>
                                <td><?php echo $value['nama_keluhan']; ?></td>
                                <td><?php echo $value['status'] == 1?'Selesai':'Pending' ?></td>
                                <td width='20px' align="center">
                                    <a class="btn btn-danger btn-xs"><span></span><i class="fa fa-check-square-o"></i></a>
                                </td>
                            </tr>
                            <?php
                            } else{
                            ?>
                            <tr style="background:#f7bf66; color:#fff">
                                <td width='20px'><?php echo $no; ?></td>
                                <td><?php echo $value['nama_keluhan']; ?></td>
                                <td><?php echo $value['status'] == 1?'Selesai':'Pending' ?></td>
                                <td width='20px' align="center">
                                    <a href="" id-pk="<?php echo $value['id'] ?>" class="UbahStatus btn btn-success btn-xs"><span></span><i class="fa fa-check"></i></a>
                                </td>
                            </tr>
                            <?php 
                            }
                            $no++; } ?>
                       </tbody> 
                    </table>
                </div>
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
                    <label for="" class="control-label">Aksi Tugas</label>
                    <select name="aksiTugas" style="width:100%;" class="form-control">
                        <option value="1">Selesai</option>
                        <option value="2">Pending</option>
                    </select>
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
    $('#table').DataTable({
        paging: false,
        "sDom": "<'row'<'col-sm-12'<'form-group'<f>>>>tr<'row'<'col-sm-12'<'pull-left'i><'pull-right'p><'clearfix'>>>"
    });
    $('#table2').DataTable({
        // paging: false,
        // "sDom": "<'row'<'col-sm-12'<'form-group'<f>>>>tr<'row'<'col-sm-12'<'pull-left'i><'pull-right'p><'clearfix'>>>"
    });

    var checkbox = $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('.Tanggapi').addClass('disabled');

    $('input').on('ifChecked ifUnchecked', function(){
        let jumlah = $('input[name="aksi[]"]:checked').length;
        if(jumlah > 0)
        {
            $('.Tanggapi').removeClass('disabled');
        }
        else
        {
            $('.Tanggapi').addClass('disabled');
        }
    });

    $('.Tanggapi').on('click',function(e){
        if(!e.isDefaultPrevented())
        {
            $('#modalForm form')[0].reset();
            $('.modal-title').text('Tanggapi Manajemen Keluhan');
            $('#modalForm').modal('show');
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
                type: 'for_teknisi', 
                id: pilihan,
                tanggapi: $('select[name=aksiTugas]').val()
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
                            window.location.href = "<?php echo BASE_URL. '?m=keluhan&p=list' ?>";
                    });
                }
            });
        }
        return false;
    });

    $('.UbahStatus').on('click',function(e){
        if(!e.isDefaultPrevented())
        {
            let id = $(this).attr('id-pk');
            swal({
            title: "Apakah Kamu Yakin?",
            text: "Status Data Keluhan ini akan diubah!",
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
                    module: 'keluhan', 
                    type: 'for_keluhan_pending', 
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
                                window.location.href = "<?php echo BASE_URL. '?m=keluhan&p=list' ?>";
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