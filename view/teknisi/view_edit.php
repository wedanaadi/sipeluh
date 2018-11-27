<?php
    include("view/layouts/bag1.php");
?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Edit Teknisi</h3>
        </div>
        <div class="box-body">
            <form id="form" action="" method="post" data-toggle="validator">
                <input type="hidden" name="module" value="teknisi">
                <input type="hidden" name="type" value="ubah">
                <div class="form-group">
                    <label for="id" class="control-label">Id</label>
                    <input type="text" name="id" value="<?php  echo $data['id'] ?>" id="id" class="form-control" readonly required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="nama" class="control-label">Nama Teknisi</label>
                    <input type="text" name="nama" id="nama" value="<?php  echo $data['nama_teknisi']; ?>" class="form-control" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="alamat" class="control-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required><?php  echo $data['alamat'] ?></textarea>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="telepon" class="control-label">Telepon</label>
                    <input type="text" name="telepon" value="<?php  echo $data['no_telepon'] ?>" id="telepon" class="form-control" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" value="<?php  echo $data['email'] ?>" id="email" class="form-control" required>
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
<?php include("view/layouts/bag2.php") ?>

<script>
    $('#form').on('submit',function(e){
        if(!e.isDefaultPrevented())
        {
          var nama = $("input[name=nama]").val().replace(/^\s+|\s+$/g, "").length;
          var alamat = $("textarea[name=alamat]").val().replace(/^\s+|\s+$/g, "").length;
          var telepon = $("input[name=telepon]").val().replace(/^\s+|\s+$/g, "").length;
          if(!nama || !alamat || !telepon)
          {
            swal({
              title: 'Oops..!',
              text: 'form masih ada yang kosong',
              type: 'error',
              showConfirmButton: true
            });
          }
          else
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
                  window.location.href = "<?php echo BASE_URL. '?m=teknisi' ?>";
                });
              }
            });
          }
        }
        return false;
    });
</script>
