<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>SPK KELOMPOK 6</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon" />
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
		    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.php" class="logo d-flex align-items-center">
                    <img src="assets/img/logo.png" alt="" />
                    <span class="d-none d-lg-block">SPK KELOMPOK 6</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>
            <!-- End Logo -->

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle" />
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="list-profile.php">
                                    <i class="bi bi-person-circle"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a onclick="return confirm ('Apakah anda yakin ingin logout?')" class="dropdown-item d-flex align-items-center" href="logout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul>
                        <!-- End Profile Dropdown Items -->
                    </li>
                    <!-- End Profile Nav -->
                </ul>
            </nav>
            <!-- End Icons Navigation -->
        </header>
        <!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="<?php if($page == "Dashboard"){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="index.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-heading">Master Data</li>
				
                <?php
                $user_role = get_role();
                if($user_role == 'admin') {
                ?>
                <li class="nav-item">
                    <a class="<?php if($page=='Kriteria'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="list-kriteria.php">
                        <i class="bi bi-diagram-2"></i>
                        <span>Data Kriteria</span>
                    </a>
                </li>
                <?php
                  $q = mysqli_query($koneksi,"SELECT COUNT(ada_pilihan) as banyak FROM kriteria WHERE ada_pilihan='1'");
                  $krit = mysqli_fetch_array($q);
                  if ($krit['banyak'] > 0) {
                  ?>
                <li class="nav-item">
                    <a class="<?php if($page=='Sub Kriteria'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="list-sub-kriteria.php">
                        <i class="bi bi-diagram-3"></i>
                        <span>Data Sub Kriteria</span>
                    </a>
                </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="<?php if($page=='Alternatif'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="list-alternatif.php">
                        <i class="bi bi-person"></i>
                        <span>Data Alternatif</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="<?php if($page=='Penilaian'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="list-penilaian.php">
                        <i class="bi bi-person-check"></i>
                        <span>Data Penilaian</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="<?php if($page=='Perhitungan'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="perhitungan.php">
                        <i class="bi bi-calculator"></i>
                        <span>Data Perhitungan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="<?php if($page=='Hasil'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="hasil.php">
                        <i class="bi bi-bar-chart"></i>
                        <span>Data Hasil Akhir</span>
                    </a>
                </li>
				
				
	  <?php
	  }elseif($user_role == 'user') {
	  ?>
				<li class="nav-item">
                    <a class="<?php if($page=='Hasil'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="hasil.php">
                        <i class="bi bi-bar-chart"></i>
                        <span>Data Hasil Akhir</span>
                    </a>
                </li>
                </li>
				<?php } ?>
				
				<li class="nav-heading">Master User</li>
				<?php if($user_role == 'admin') { ?>
                <li class="nav-item">
                    <a class="<?php if($page=='User'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="list-user.php">
                        <i class="bi bi-person-square"></i>
                        <span>Data User</span>
                    </a>
                </li>
				<?php } ?>
				
				<li class="nav-item">
                    <a class="<?php if($page=='Profile'){echo 'nav-link';}else{echo 'nav-link collapsed';}?>" href="list-profile.php">
                        <i class="bi bi-person-circle"></i>
                        <span>Data Profile</span>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- End Sidebar-->

        <main id="main" class="main">


