<!DOCTYPE html>
<html>
<head>
<?php
    include("view/layouts/css.php");
?>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a><b>SIPE</b>LUH</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Daftar Anggota Baru</p>
    <hr style="margin-top: 0px">

    <form class="form" action="#" method="post" data-toggle="validator">
      <div class="form-group has-feedback for-username">
        <input type="text" pattern=".*\S+.*" title="test" class="form-control user" name="username" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span class="help-block hb-user with-errors"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control email" name="email" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="help-block with-errors"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" pattern=".*\S+.*" class="form-control pass" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block with-errors"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" pattern=".*\S+.*" class="form-control conpass" name="confirm" placeholder="Retype password" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <span class="help-block with-errors"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn register btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <div id="error" style="margin-top: 10px"></div>
    <hr style="margin-botton: 17px">
    <a href="<?php echo BASE_URL; ?>" class="text-center"> <i class="fa fa-users"></i> Sudah Menjadi Anggota</a>
  </div>
  <!-- /.form-box -->
</div>
</body>
</html>
<?php include("view/layouts/js.php") ?>
<script>
    var username_sama = null;
    $('.user').on('input',function(e){
        if(!e.isDefaultPrevented())
        {
            let _data = {
                username: $('input[name=username]').val(),
                module: 'auth',
                type: 'reg_already'
            };
            $.ajax({
                url: "aksi.php",
                type: "POST",
                method: "POST",
                data:  _data,
                success: function(data)
                {
                    if(data == 1)
                    {
                        $('.hb-user').text('Username Sudah Digunakan!');
                        $('.for-username').removeClass('has-success').addClass('has-error');
                        $('.register').prop('disabled',true);
                        username_sama = 1;
                    }
                    else
                    {
                        $('.hb-user').text('');
                        $('.for-username').removeClass('has-error').addClass('has-success');
                        $('.register').prop('disabled',false);
                        username_sama = null;
                    }
                }
            });
        }
        return false;
    });

    $('.email, .pass, .conpass').on('focus',function(e){
        if(!e.isDefaultPrevented())
        {
            if($('input[name=username]').val() != '')
            {
                if(username_sama != null)
                {
                    $('.hb-user').text('Username Sudah Digunakan!');
                    $('.for-username').removeClass('has-success').addClass('has-error');
                    $('.register').prop('disabled',true);
                }
                else
                {
                    $('.hb-user').text('');
                    $('.for-username').removeClass('has-error').addClass('has-success');
                    $('.register').prop('disabled',false);
                }
            }
        }
        return false;
    });

    $('.conpass').on('input',function(e){
        if(!e.isDefaultPrevented())
        {
            var pass = $('.pass').val();
            var conpass = $(this).val();
            if(pass != conpass)
            {
                $("#error").fadeIn(1000, function(){
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; password tidak sesuai!.</div>');
                    // $('input[name=confirm]').val('');
                    $('input[name=confirm]').focus();
                    $('.register').prop('disabled',true);
                });
            }
            else
            {
                $("#error").fadeOut(300, function(){
                    $('.register').prop('disabled',false);
                    $('.register').removeClass('disabled');
                });
            }
        }
        return false;
    });

    $('.form').on('submit',function(e){
        if(!e.isDefaultPrevented())
        {
            var _data = {
                module: 'auth',
                type: 'add_pelanggan',
                username: $('input[name=username]').val(),
                password: $('input[name=password]').val(),
                email: $('input[name=email]').val()
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
                        if(obj.aksi == true)
                        {
                            window.location.href = "<?php echo BASE_URL. '?m=dashboard' ?>";
                        }
                    });
                }
            });
        }
        return false;
    });
</script>
