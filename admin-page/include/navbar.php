</head>
<body>
<ul id="user-dropdown" class="dropdown-content">
  <li><a href="action/logout.php">Logout</a></li>
</ul>
  <nav crole="navigation">
    <div class="nav-wrapper container-fluid cyan darken-1">
      <div class="row">
        <div class="col s12 m10 offset-m2">
          <a id="logo-container" href="index.php" class="brand-logo">Logo</a>
          <ul class="right hide-on-med-and-down">
            <li><a class="dropdown-trigger" href="#!" data-target="user-dropdown"><?php echo $_COOKIE['nama']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>

          <ul id="nav-mobile" class="sidenav sidenav-fixed">
            <li>
              <div class="user-view">
              <div class="background">
                <img src="http://www.seekgif.com/uploads/2017/06/polygon-background-1-jpg-1.jpeg">
              </div>
              <span class="black-text name"><?php echo $_COOKIE['nama']; ?></span></a>
              <span class="black-text email"><?php echo $_COOKIE['email']; ?></span></a>
            </div>
          </li>
          <li><a href="index.php"><i class="material-icons">dashboard</i>Dashboard</a></li>
          <li><a href="covid.php"><i class="material-icons">local_hospital</i>Manajemn Data Covid-19</a></li>
          <li><a href="berita.php"><i class="material-icons">forum</i>Berita</a></li>
          <div class="hide-on-large-only"><li><a href="action/logout.php"><i class="material-icons">power_settings_new</i>Logout</a></li></div>
          </ul>
          <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
      </div>
    </div>
  </nav>