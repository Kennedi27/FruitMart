<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Fruit Mart | Masuk</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css" />
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/admin.css">

</head>
<body class="skin-blue sidebar-mini">

    <div class="content-wrapper">
      <div class="row"></div>
      <div class="col-md-4 col-md-offset-4 form-login">
        <div class="outter-form-login ">
          <form method="post" class="inner-login" action="cek_login.php">
            <h3 class="title-login">Login</h3>
            <table>
              <div class="form-group ">
                <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" class="form-control"  id="username" name="username" placeholder="Username"></td>
                </tr>
              </div>
              <div class="form-group">
               <tr>
                <td><label for="password">Password</label></td>
               <td> <input type="password" class="form-control" id="password" name="password" placeholder="Password"></td>
                  </tr>
              </div>
              <div class="form-group">
                <tr>
                  <td></td>
                  <td><button type="submit" class="btn btn-primary">Masuk</button></td>
                </tr>
              </div>              
            </table>
          </form>
        </div>
      </div>
    </div>

  <!-- jQuery 2.1.3 -->
  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- SlimScroll -->
  <script src="plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='plugins/fastclick/fastclick.min.js'></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js" type="text/javascript"></script>
</body>

</html>
<style type="text/css">
  table {
    margin-left: -80px;
  }
  td {
    padding: 5px; ;
  }
  .form-login {
    margin-top: 15%;
  }
</style>
