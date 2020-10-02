<header class="main-header">
  <a href="index.php" class="logo"><b>Fruit Mart</b></a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php echo "<img src='images/".$_SESSION['foto']."'width='25' class='img-circle' height='25'>";?>
            <span class="hidden-xs"><?php echo $akses ;?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <?php echo "<img src='images/".$_SESSION['foto']."'width='30' height='30'>";?>
              <p>
                <?php echo $_SESSION['name'] ;?>
                <small> <?php echo $_SESSION['address'];?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-right">
                <a href="cek_logout.php" class="btn btn-default btn-flat">Keluar</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>