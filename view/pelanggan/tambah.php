<?php
    include("view/layouts/bag1.php");
    include("libraries/Fungsi.php");
    $Fungsi = new Fungsi();
?>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Tambah Pelanggan</h3>
        </div>
        <div class="box-body">
            <form id="form" action="" method="post" data-toggle="validator">
                <input type="hidden" name="module" value="pelanggan">
                <input type="hidden" name="type" value="tambah">
                <div class="form-group">
                    <label for="id" class="control-label">Id</label>
                    <input type="text" name="id" value="<?php  echo $Fungsi->KodeGenerate($idOtomatis,5,0); ?>" id="id" class="form-control" readonly required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="nama" class="control-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="alamat" class="control-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="telepon" class="control-label">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
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
    $("#form").on('submit',function(e){
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
                        window.location.href = "<?php echo BASE_URL. '?m=pelanggan' ?>";
                    });
                }
            });
        }
        return false;
    });
</script>