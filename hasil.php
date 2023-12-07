<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {

$page = "Hasil";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between">
    <div class="pagetitle m-0">
		<h1>Data Hasil</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data Hasil</li>
			</ol>
		</nav>
	</div>

	<a href="cetak.php" class="btn btn-primary">Cetak Data </a>
</div>

<div class="card">
    <div class="card-body">
		<h5 class="card-title"></h5>
		<div class="table-responsive">
			<table class="table" width="100%" cellspacing="0">
				<thead>
					<tr align="center">
						<th>Nama Alternatif</th>
						<th>Nilai</th>
						<th width="15%">Rank</th>
				</thead>
				<tbody>
					<?php 
						$no=0;
						$query = mysqli_query($koneksi,"SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif ORDER BY hasil.nilai DESC");
						while($data = mysqli_fetch_array($query)){
						$no++;
					?>
					<tr align="center">
						<td align="left"><?= $data['nama'] ?></td>
						<td><?= $data['nilai'] ?></td>
						<td><?= $no; ?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('template/footer.php');
}
else {
	header('Location: login.php');
}
?>