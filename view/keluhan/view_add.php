<?php include("view/layouts/bag1.php") ?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Keluhan</h3>
        </div>
        <div class="box-body">
            <form id="form" action="aksi.php" method="post" data-toggle="validator">
                <input type="hidden" name="module" value="keluhan">
                <input type="hidden" name="type" value="tambah">
                <div class="form-group">
                    <label for="pelanggan" class="control-label">Pelanggan</label>
                    <select name="pelanggan" id="pelanggan" class="form-control" required style="width:100%">
                        <option value="" selected disabled>--- PILIH PELANGGAN ---</option>
                    <?php
                        foreach ($pelanggan as $r) {
                     ?>
                        <option value="<?php echo $r['id'] ?>"><?php echo $r['nama'] ?></option>
                     <?php
                        }
                     ?>
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="kategori" class="control-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required style="width:100%">
                        <option value="" selected disabled>--- PILIH KATEGORI ---</option>
                    <?php
                        foreach ($kategori as $r) {
                     ?>
                        <option value="<?php echo $r['id'] ?>"><?php echo $r['kategori'] ?></option>
                     <?php
                        }
                     ?>
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="keluhan" class="control-label">Keluhan</label>
                    <textarea name="keluhan" rows="5" id="alamat" class="form-control" required></textarea>
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
    $('#pelanggan').select2();
    $('#kategori').select2();
    $("#form").on('submit',function(e){
        if(!e.isDefaultPrevented())
        {
          var keluhan = $("textarea[name=keluhan]").val().replace(/^\s+|\s+$/g, "").length;
          if(!keluhan)
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
                  window.location.href = "<?php echo BASE_URL. '?m=keluhan' ?>";
                });
              }
            });
          }
        }
        return false;
    });
</script>
