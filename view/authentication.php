<?php
  session_start();
  if(isset($_SESSION['login_id']))
  {
      header("Location: index.php?m=dashboard");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
      include("view/layouts/css.php");
    ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>SIPE</b>LUH</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form class="loginForm" method="POST" data-toggle="validator">
      <div class="form-group has-feedback">
        <input type="username" class="form-control" name="username" placeholder="Username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="help-block with-errors"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block with-errors"></span>
      </div>
      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Login</button>
        </div>
        <div class="col-xs-4"></div>
        <div class="col-xs-4">
          <a href="<?php echo BASE_URL."?m=user&p=user_pelanggan"; ?>" class="btn btn-primary btn-block btn-flat"><i class="fa fa-user-plus"></i> Daftar</a>
        </div>
        
      </div>
    </form>
    <div id="error" style="margin-top: 10px"></div>
  </div>
  <!-- /.login-box-body -->
</div>
<?php include("layouts/js.php") ?>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.loginForm').on('submit',function(e){
          var data = $(".loginForm").serialize();
            if(!e.isDefaultPrevented())
            {
                let _data = {
                    username: $('input[name=username]').val(),
                    password: $('input[name=password]').val(),
                    module: 'auth',
                    type: 'auth'
                };
                
                $.ajax({
                    url: "aksi.php",
                    type: "POST",
                    method: "POST",
                    data:  _data,
                    success: function(data)
                    {
                      obj = JSON.parse(data)
                        if(obj.sukses == false)
                        {
                          $("#error").fadeIn(1000, function(){   
                          $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; username atau password salah!.</div>');
                          $('input[name=password]').val('');
                          $('input[name=password]').focus();
                          });
                        }

                        if(obj.sukses == true)
                        {
                          $("#error").fadeIn(1000, function(){   
                            $("#error").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Berhasil Login!.</div>');
                            window.location.href = "?m=dashboard";
                          });
                        }
                    }
                });
            }
            return false;
        });
    });
</script>