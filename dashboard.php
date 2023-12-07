<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
$page = "Dashboard";
require_once('template/header.php');

?>


<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<?php
	if($user_role == 'admin') {
	?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    Selamat datang <span class="text-uppercase"><b><?php echo $_SESSION['username']; ?>!</b></span> Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<section class="section dashboard">
	<div class="mb-4">
		<div class="row">
			<div class="col-xl-4 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data Kriteria</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-diagram-2"></i>
							</div>
							<div class="ps-3">
								<a href="list-kriteria.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>

            <?php
		  $q = mysqli_query($koneksi,"SELECT COUNT(ada_pilihan) as banyak FROM kriteria WHERE ada_pilihan='1'");
		  $krit = mysqli_fetch_array($q);
		  if ($krit['banyak'] > 0) {
		?>
			
			<div class="col-xl-4 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data Sub Kriteria</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-diagram-3"></i>
							</div>
							<div class="ps-3">
								<a href="list-sub-kriteria.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>

            <?php } ?>
			
			<div class="col-xl-4 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data Alternatif</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-person"></i>
							</div>
							<div class="ps-3">
								<a href="list-alternatif.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-4 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data Penilaian</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-person-check"></i>
							</div>
							<div class="ps-3">
								<a href="list-penilaian.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-4 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data Perhitungan</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-calculator"></i>
							</div>
							<div class="ps-3">
								<a href="perhitungan.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-4 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data Hasil Akhir</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-bar-chart"></i>
							</div>
							<div class="ps-3">
								<a href="hasil.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>

            <?php
		  $q = mysqli_query($koneksi,"SELECT COUNT(ada_pilihan) as banyak FROM kriteria WHERE ada_pilihan='1'");
		  $krit = mysqli_fetch_array($q);
		  if ($krit['banyak'] == 0) {
		?>
			
			<div class="col-xl-4 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data User</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-person-square"></i>
							</div>
							<div class="ps-3">
								<a href="list-user.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>

            <?php } ?>
		</div>
	</div>
</section>



	<?php
	}elseif($user_role == 'user') {
	?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    Selamat datang <span class="text-uppercase"><b><?php echo $_SESSION['username']; ?>!</b></span> Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<section class="section dashboard">
	<div class="mb-4">
		<div class="row">
			
			<div class="col-xl-6 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Data Hasil Akhir</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-bar-chart"></i>
							</div>
							<div class="ps-3">
								<a href="hasil.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-6 col-md-6">
				<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Profile</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-person-circle"></i>
							</div>
							<div class="ps-3">
								<a href="list-profile.php" class="text-muted small pt-2 ps-1">Detail data..</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
}
?>

<?php
require_once('template/footer.php');
}else {
	header('Location: login.php');
}
?>
