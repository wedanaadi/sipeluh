<?php include("view/layouts/bag1.php") ?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Edit User</h3>
        </div>
        <div class="box-body">
            <form id="form" action="aksi.php" method="post" data-toggle="validator">
                <input type="hidden" name="module" value="user">
                <input type="hidden" name="type" value="edit">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <div class="form-group">
                    <label for="nama" class="control-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $data['username'] ?>" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="alamat" class="control-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo $data['password'] ?>" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $data['email'] ?>" required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="telepon" class="control-label">Hak Akses</label>
                    <select name="hk" id="hk" class="form-control" required style="width:100%">
                        <option value="" selected disabled>--- PILIH HAK AKSES ---</option>
                    <?php 
                        foreach ($hk_list as $r) {
                            if($data['hak_akses'] == $r['id'])
                            {
                     ?>
                        <option selected value="<?php echo $r['id'] ?>"><?php echo $r['nama_hak_akses'] ?></option>
                    <?php   
                            } else { 
                    ?> 
                        <option value="<?php echo $r['id'] ?>"><?php echo $r['nama_hak_akses'] ?></option>
                     <?php
                            }
                        }
                     ?>
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="row"></div>
                <div id="teknisi" hidden="hidden">
                    <div class="form-group">
                        <label for="" class="control-label">Teknisi</label>
                        <select name="id_tek" id="id_tek" class="form-control" style="width:100%">
                        <option value="" selected disabled>Pilih Teknisi</option>
                        <?php 
                            foreach ($teknisi as $p) {
                                if($data['id_biodata'] == $p['id']) {
                        ?>
                            <option selected value="<?php echo $p['id'] ?>"><?php echo $p['nama_teknisi'] ?></option>
                        <?php 
                                } else {
                        ?>
                                <option value="<?php echo $p['id'] ?>"><?php echo $p['nama_teknisi'] ?></option>
                        <?php 
                                }
                            }
                        ?>
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
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
    $('#hk').select2();
    $('#id_tek').select2();

    $('#hk').on("select2:select",function(e){
        const id = $(this).val();
        if(id == '2')
        {
            $('#teknisi').fadeTo(0,3000);
            $('select[name=id_tek]').prop('required',true);
        }
        else
        {
            $('#teknisi').fadeOut(0,3000);
            $('select[name=id_tek]').prop('required',false);
        }
    });

    var id_hk = $('#hk').val();
    if(id_hk == '2')
    {
        $('#teknisi').fadeTo(0,3000);
        $('select[name=id_tek]').prop('required',true);
    }
    else
    {
        $('#teknisi').fadeOut(0,3000);
        $('select[name=id_tek]').prop('required',false);
    }

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
                        if(obj.aksi == true)
                        {
                            window.location.href = "<?php echo BASE_URL. '?m=user' ?>";
                        }
                    });
                }
            });
        }
        return false;
    });
</script>