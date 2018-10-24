<?php
    include("view/layouts/bag1.php");
?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Tambah Kategori Keluhan</h3>
        </div>
        <div class="box-body">
            <form id="form" action="aksi.php" method="post" data-toggle="validator">
                <input type="hidden" name="module" value="kategori_keluhan">
                <input type="hidden" name="type" value="ubah">
                <div class="form-group">
                    <label for="id" class="control-label">Id</label>
                    <input type="text" name="id" value="<?php echo $data['id'] ?>" id="id" class="form-control" readonly required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="nama" class="control-label">Kategori Keluhan</label>
                    <input type="text" name="kategori" value="<?php echo $data['kategori'] ?>" id="kategori" class="form-control" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <button type="submit" name="tambah" class="btn btn-primary btn-sm">
                        <i class="fa fa-check"></i><span> Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
    include("view/layouts/bag2.php");
?>

<script>
    $('#form').on('submit',function(e){
        if(!e.isDefaultPrevented())
        {
            $.ajax({
                url: "aksi.php",
                type: "POST",
                method: "POST",
                contentType: false,
                processData: false,
                data: new FormData($("form")[0]),
                success: function(data)
                {
                    obj = JSON.parse(data);
                    swal({
                        title: obj.title,
                        text: obj.message,
                        type: obj.type,
                        showConfirmButton: true
                    }, function(){
                        window.location.href = "<?php echo BASE_URL. '?m=kategorikeluhan' ?>";
                    });
                }
            });
        }
        return false;
    });
</script>